<?php
// get_elections.php (robust version)
// Returns JSON array of elections with normalized partyListKeys for matching

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$dbHost = '127.0.0.1';
$dbName = 'eboto_db';
$dbUser = 'root';
$dbPass = '';
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $ex) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'DB connection failed', 'error' => $ex->getMessage()]);
    exit;
}

/* ---------- helpers ---------- */
function fetchAll($pdo, $sql, $params = []) {
    $s = $pdo->prepare($sql);
    $s->execute($params);
    return $s->fetchAll(PDO::FETCH_ASSOC);
}
function columnExists($pdo, $schema, $table, $col) {
    $s = $pdo->prepare("SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = :schema AND table_name = :table AND column_name = :col");
    $s->execute([':schema'=>$schema, ':table'=>$table, ':col'=>$col]);
    return (bool)$s->fetchColumn();
}
function pickAnyCol($pdo, $schema, $table, $variants) {
    foreach ($variants as $v) {
        if (columnExists($pdo, $schema, $table, $v)) return $v;
    }
    return null;
}
function isoUtc($value) {
    if (!$value) return null;
    $ts = strtotime($value);
    if ($ts === false) return null;
    return gmdate('c', $ts);
}
function computeStatusFromDates($startIso, $endIso) {
    if (!$startIso && !$endIso) return 'upcoming';
    $now = time();
    $startTs = $startIso ? strtotime($startIso) : null;
    $endTs = $endIso ? strtotime($endIso) : null;
    if ($startTs && $endTs) {
        if ($now < $startTs) return 'upcoming';
        if ($now >= $startTs && $now <= $endTs) return 'active';
        return 'completed';
    } elseif ($startTs && !$endTs) {
        return ($now >= $startTs) ? 'active' : 'upcoming';
    } elseif (!$startTs && $endTs) {
        return ($now <= $endTs) ? 'active' : 'completed';
    }
    return 'upcoming';
}

/* ---------- choose schema/table ---------- */
$table = null;
try {
    $stmt = $pdo->prepare("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = :schema AND TABLE_NAME IN ('election','elections') LIMIT 1");
    $stmt->execute([':schema' => $dbName]);
    $table = $stmt->fetchColumn() ?: 'elections';
} catch (Exception $e) {
    $table = 'elections';
}

/* ---------- resolve column names (robust to variants) ---------- */
$cols = [];
try {
    $cstmt = $pdo->prepare("SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema = :schema AND table_name = :table");
    $cstmt->execute([':schema'=>$dbName, ':table'=>$table]);
    $cols = $cstmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
} catch (Exception $e) {
    $cols = [];
}

$idCol     = pickAnyCol($pdo, $dbName, $table, ['Election_ID','id','ID','election_id','electionId']);
$titleCol  = pickAnyCol($pdo, $dbName, $table, ['Title','title','name','Name']);
$orgCol    = pickAnyCol($pdo, $dbName, $table, ['Organization','organization','organization_name','Organization_Name']);
$startCol  = pickAnyCol($pdo, $dbName, $table, ['Start_Date','start_date','startDate','start']);
$endCol    = pickAnyCol($pdo, $dbName, $table, ['End_Date','end_date','endDate','end']);
$statusCol = pickAnyCol($pdo, $dbName, $table, ['Status','status']);
$totalCol  = pickAnyCol($pdo, $dbName, $table, ['Total_Voters','total_voters','totalVoters']);
$partyCsv  = pickAnyCol($pdo, $dbName, $table, ['party_lists','partyLists','party_lists_csv','party_lists_json']);

/* ---------- fetch elections ---------- */
$results = [];

try {
    $select = [];
    if ($idCol) $select[] = "`$idCol` AS id";
    if ($titleCol) $select[] = "`$titleCol` AS title";
    if ($orgCol) $select[] = "`$orgCol` AS organization";
    if ($startCol) $select[] = "`$startCol` AS start_date";
    if ($endCol) $select[] = "`$endCol` AS end_date";
    if ($statusCol) $select[] = "`$statusCol` AS status";
    if ($totalCol) $select[] = "`$totalCol` AS total_voters";

    if (count($select) === 0) {
        $rows = fetchAll($pdo, "SELECT * FROM `$table` ORDER BY 1 DESC LIMIT 100");
    } else {
        $orderBy = ($startCol ? "`$startCol` DESC" : "1");
        $sql = "SELECT " . implode(', ', $select) . " FROM `$table` ORDER BY $orderBy";
        $rows = fetchAll($pdo, $sql);
    }

    foreach ($rows as $row) {
        $electionId = $row['id'] ?? null;
        if ($electionId === null) continue;

        $partyLists = [];

        // Strategy 1: relation table election_party_list -> party_lists
        $relationFound = false;
        try {
            $epl_table = 'election_party_list';
            $stmtEpl = $pdo->prepare("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = :schema AND table_name = :table");
            $stmtEpl->execute([':schema'=>$dbName, ':table'=>$epl_table]);
            if ((int)$stmtEpl->fetchColumn() > 0) {
                $eplColsStmt = $pdo->prepare("SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema = :schema AND table_name = :table");
                $eplColsStmt->execute([':schema'=>$dbName, ':table'=>$epl_table]);
                $eplCols = $eplColsStmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
                $fkCandidates = ['election_id','Election_ID','electionId','election'];
                $plFkCandidates = ['party_list_id','party_list','party_list_id','partyListId','party_list_id','PartyList_ID'];
                $eplFk = null;
                foreach ($fkCandidates as $c) if (in_array($c, $eplCols, true)) { $eplFk = $c; break; }
                $eplPlFk = null;
                foreach ($plFkCandidates as $c) if (in_array($c, $eplCols, true)) { $eplPlFk = $c; break; }

                if ($eplFk && $eplPlFk) {
                    $plTable = 'party_lists';
                    $plCountStmt = $pdo->prepare("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = :schema AND table_name = :table");
                    $plCountStmt->execute([':schema'=>$dbName, ':table'=>$plTable]);
                    if ((int)$plCountStmt->fetchColumn() > 0) {
                        $plColsStmt = $pdo->prepare("SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema = :schema AND table_name = :table");
                        $plColsStmt->execute([':schema'=>$dbName, ':table'=>$plTable]);
                        $plCols = $plColsStmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
                        $plIdCol = null;
                        foreach (['id','ID','Party_List_ID','party_list_id','partyListId'] as $c) if (in_array($c, $plCols, true)) { $plIdCol = $c; break; }
                        $plShort = null;
                        foreach (['short_code','shortcode','code','short','Short_Code','short_code'] as $c) if (in_array($c, $plCols, true)) { $plShort = $c; break; }
                        $plName = null;
                        foreach (['name','Name','party_name','Party_Name'] as $c) if (in_array($c, $plCols, true)) { $plName = $c; break; }

                        if ($plIdCol && ($plShort || $plName)) {
                            $q = "SELECT pl.`" . ($plShort ?: $plName) . "` AS display
                                  FROM `$epl_table` epl
                                  JOIN `$plTable` pl ON pl.`$plIdCol` = epl.`$eplPlFk`
                                  WHERE epl.`$eplFk` = :eid";
                            $plRows = fetchAll($pdo, $q, [':eid' => $electionId]);
                            foreach ($plRows as $pr) {
                                $display = $pr['display'] ?? null;
                                if ($display !== null) $partyLists[] = $display;
                            }
                            $relationFound = true;
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            $relationFound = false;
        }

        // Strategy 2: party lists directly from election row (CSV / JSON)
        if (!$relationFound) {
            foreach (['party_lists_json','partyListsJson','party_lists','partyLists','party_lists_csv'] as $cand) {
                if (array_key_exists($cand, $row) && !empty($row[$cand])) {
                    $raw = $row[$cand];
                    $arr = json_decode($raw, true);
                    if (is_array($arr)) {
                        foreach ($arr as $x) $partyLists[] = $x;
                        break;
                    } else {
                        $pieces = array_filter(array_map('trim', explode(',', $raw)));
                        if ($pieces) { foreach ($pieces as $x) $partyLists[] = $x; break; }
                    }
                }
            }
        }

        // Ensure unique display names
        $partyLists = array_values(array_unique(array_filter($partyLists, function($v){ return $v !== ''; })));

        // Build normalized key list
        $normalizedPartyLists = [];
        foreach ($partyLists as $pl) {
            $key = mb_strtolower(trim((string)$pl), 'UTF-8');
            $key = preg_replace('/\b(party|alliance|coalition)\b/ui', '', $key);
            $key = preg_replace('/\s+/', ' ', $key);
            $key = trim($key);
            if ($key === '') $key = 'independent';
            $normalizedPartyLists[] = ['display' => $pl, 'key' => $key];
        }

        // Positions (best-effort)
        $positions = [];
        try {
            $posTable = 'election_position';
            $posCount = (int)fetchAll($pdo, "SELECT COUNT(*) AS c FROM information_schema.tables WHERE table_schema = :schema AND table_name = :table", [':schema'=>$dbName, ':table'=>$posTable])[0]['c'];
            if ($posCount) {
                $posRows = fetchAll($pdo, "
                    SELECT COALESCE(pos.Position_Name, pos.position_name, pos.name) AS posname
                    FROM election_position ep
                    JOIN position pos ON pos.Position_ID = ep.position_id
                    WHERE ep.election_id = :eid
                    ORDER BY COALESCE(ep.sort_order,0), pos.Position_ID
                ", [':eid' => $electionId]);
                foreach ($posRows as $pr) {
                    if (!empty($pr['posname'])) $positions[] = $pr['posname'];
                }
            }
        } catch (Exception $ex) {
        }

        // Votes (best-effort)
        $votesArr = [];
        $votesCast = 0;
        try {
            $voteCandidates = ['Election_ID','election_id','electionId','election'];
            $foundVote = false;
            foreach ($voteCandidates as $vc) {
                if (columnExists($pdo, $dbName, 'vote', $vc)) {
                    $vrows = fetchAll($pdo, "SELECT * FROM `vote` WHERE `$vc` = :eid", [':eid' => $electionId]);
                    foreach ($vrows as $vr) { $votesArr[] = $vr; $votesCast++; }
                    $foundVote = true;
                    break;
                }
            }
            if (!$foundVote) {
                // try vote_master or other tables commonly used (optional)
                if (columnExists($pdo, $dbName, 'vote_master', 'election_id')) {
                    $vrows = fetchAll($pdo, "SELECT * FROM `vote_master` WHERE `election_id` = :eid", [':eid' => $electionId]);
                    foreach ($vrows as $vr) { $votesArr[] = $vr; $votesCast++; }
                }
            }
        } catch (Exception $ex) {}

        // partyResults init
        $partyResults = [];
        foreach ($partyLists as $pl) $partyResults[$pl] = ['votes' => 0];

        // aggregate votes
        if (!empty($votesArr)) {
            foreach ($votesArr as $vr) {
                if (!empty($vr['party'])) {
                    $p = $vr['party'];
                    if (!isset($partyResults[$p])) $partyResults[$p] = ['votes' => 0];
                    $partyResults[$p]['votes']++;
                } elseif (!empty($vr['candidate_id'])) {
                    $cid = (int)$vr['candidate_id'];
                    try {
                        $cres = $pdo->prepare("SELECT PartyList AS party FROM candidate WHERE Candidate_ID = :cid LIMIT 1");
                        $cres->execute([':cid' => $cid]);
                        $crow = $cres->fetch(PDO::FETCH_ASSOC);
                        $p = ($crow['party'] ?? 'Independent');
                        if (!isset($partyResults[$p])) $partyResults[$p] = ['votes' => 0];
                        $partyResults[$p]['votes']++;
                    } catch (Exception $ex) {}
                } elseif (!empty($vr['selections'])) {
                    $sel = json_decode($vr['selections'], true);
                    if (is_array($sel)) {
                        foreach ($sel as $selCid) {
                            $selCidInt = (int)$selCid;
                            try {
                                $cres = $pdo->prepare("SELECT PartyList AS party FROM candidate WHERE Candidate_ID = :cid LIMIT 1");
                                $cres->execute([':cid' => $selCidInt]);
                                $crow = $cres->fetch(PDO::FETCH_ASSOC);
                                $p = ($crow['party'] ?? 'Independent');
                                if (!isset($partyResults[$p])) $partyResults[$p] = ['votes' => 0];
                                $partyResults[$p]['votes']++;
                            } catch (Exception $ex) {}
                        }
                    }
                }
            }
            foreach ($partyLists as $pl) if (!isset($partyResults[$pl])) $partyResults[$pl] = ['votes' => 0];
        }

        // status resolution
        $rawStatus = $row['status'] ?? '';
        $startIso = isset($row['start_date']) ? isoUtc($row['start_date']) : null;
        $endIso   = isset($row['end_date']) ? isoUtc($row['end_date']) : null;

        $statusJs = 'upcoming';
        if (!empty($rawStatus)) {
            $r = strtolower($rawStatus);
            if (strpos($r, 'ongoing') !== false || strpos($r, 'active') !== false) $statusJs = 'active';
            elseif (strpos($r, 'end') !== false || strpos($r, 'complete') !== false) $statusJs = 'completed';
            else $statusJs = computeStatusFromDates($startIso, $endIso);
        } else {
            $statusJs = computeStatusFromDates($startIso, $endIso);
        }

        // compose output
        $results[] = [
            'id' => is_numeric($electionId) ? (int)$electionId : $electionId,
            'name' => $row['title'] ?? $row['Title'] ?? '',
            'organization' => $row['organization'] ?? 'Unknown',
            'partyLists' => $partyLists,
            'partyListKeys' => array_map(function($x){ return $x['key']; }, $normalizedPartyLists),
            'partyListDisplayPairs' => $normalizedPartyLists,
            'startDate' => $startIso,
            'endDate' => $endIso,
            'totalVoters' => isset($row['total_voters']) ? (int)$row['total_voters'] : (isset($row['Total_Voters']) ? (int)$row['Total_Voters'] : 0),
            'votesCast' => $votesCast,
            'votes' => $votesArr,
            'status' => $statusJs,
            'partyResults' => $partyResults,
            'positions' => $positions
        ];
    }

    echo json_encode($results);
    exit;

} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to load elections', 'error' => $ex->getMessage()]);
    exit;
}
