<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>eBOTO | ESM Candidates</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- NOTE: No inline CSS included per request -->
</head>
<body>

  <!-- SIDEBAR -->
  <nav class="sidebar" id="sidebar">
    <div class="logo-container">
      <div class="logo"><img src="../assests/suffage.png" alt="Logo"></div>
    </div>

    <ul class="nav-menu">
      <li class="nav-item"><i class="fas fa-home"></i><a href="admin_dashboard.html">Dashboard</a></li>
      <li class="nav-item"><i class="fas fa-user-graduate"></i><a href="register-voters.php">Voters</a></li>
      <li class="nav-item"><i class="fas fa-user-tie"></i><a href="register-officers.php">Officers</a></li>
      <li class="nav-item active"><i class="fas fa-user-tag"></i><a href="candidates.php">Candidates</a></li>
      <li class="nav-item"><i class="fas fa-check-circle"></i><a href="validate-elections.php">Elections</a></li>
      <li class="nav-item"><i class="fas fa-chart-line"></i><a href="monitoring.php">Monitoring</a></li>
      <li class="nav-item"><i class="fas fa-file-alt"></i><a href="audit-reports.php">Reports</a></li>
      <li class="nav-item"><i class="fas fa-cog"></i><a href="settings.php">Settings</a></li>
    </ul>

    <div class="user-profile" id="userProfile">
      <img src="../assests/default-avatar.jpg" class="user-avatar" />
      <div class="user-info">
        <h4>Gamaliel Valcorza</h4>
        <p>Administrator</p>
      </div>
      <div class="user-dropdown" id="dropdown">
        <a href="../login.html" id="logoutBtn">Logout</a>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <div class="main-content" id="mainContent">
    <div class="header">
      <h1>Candidate Management - ESM Department</h1>
      <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
    </div>

    <div class="content">
      <div class="department-header">
        <img src="esm.jpg" class="department-logo" alt="ESM Department Logo">
        <div class="department-info">
          <h2>Energy Solution Management Department</h2>
          <p>Department of Energy Solution Management</p>
        </div>
      </div>

      <div class="candidate-header">
        <h2 class="candidate-title">ESM Department Candidates</h2>
        <div class="search-box">
          <input type="text" class="search-input" placeholder="Search candidates..." id="searchInput">
          <button class="search-btn"><i class="fas fa-search"></i></button>
          <div class="action-buttons">
            <button class="add-party-btn" id="addPartyBtn">
              <i class="fas fa-plus"></i> Add Party
            </button>
            <button class="add-candidate-btn" id="addCandidateBtn">
              <i class="fas fa-plus"></i> Add Candidate
            </button>
          </div>
        </div>
      </div>

      <!-- Party Cards -->
      <div class="party-container" id="partyContainer">
        <!-- Party cards will be dynamically generated here -->
      </div>
    </div>
  </div>

  <!-- Add Party Modal -->
  <div class="modal" id="addPartyModal" style="display:none;">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Add New Party</h2>
        <button class="close-modal" id="closePartyModal">&times;</button>
      </div>
      <form id="partyForm">
        <div class="form-group">
          <label class="form-label" for="partyName">Party Name</label>
          <input type="text" class="form-input" id="partyName" placeholder="e.g., SOCE Progressive Party" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="partySlogan">Slogan</label>
          <input type="text" class="form-input" id="partySlogan" placeholder="e.g., Advancing Technology, Empowering Students">
        </div>
        <div class="form-group">
          <label class="form-label" for="partyEstablished">Established Year</label>
          <input type="number" class="form-input" id="partyEstablished" placeholder="e.g., 2023" min="2000" max="2030">
        </div>
        <div class="form-group">
          <label class="form-label">Party Logo</label>
          <div class="file-upload-container">
            <label for="partyLogo" class="file-upload-label">
              <i class="fas fa-upload"></i> Choose Logo
            </label>
            <input type="file" id="partyLogo" class="file-upload-input" accept="image/*">
            <img id="partyLogoPreview" class="file-preview" alt="Logo Preview" style="display:none;max-width:80px;"/>
          </div>
        </div>
        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelPartyBtn">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Party</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Add Candidate Modal -->
  <div class="modal" id="addCandidateModal" style="display:none;">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h2>Add New Candidate</h2>
        <button class="close-modal" id="closeCandidateModal">&times;</button>
      </div>
      <form id="candidateForm">
        <div class="form-group">
          <label class="form-label" for="candidateId">Student ID</label>
          <input type="text" class="form-input" id="candidateId" placeholder="e.g., 2021-00123" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="candidateName">Full Name</label>
          <input type="text" class="form-input" id="candidateName" placeholder="e.g., Juan Dela Cruz" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="candidateEmail">Email</label>
          <input type="email" class="form-input" id="candidateEmail" placeholder="e.g., juan@example.com" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="candidateProgram">Program / Course</label>
          <select class="form-select" id="candidateProgram" required>
            <option value="">Select Program / Course</option>
            <!-- populated from fixed list -->
          </select>
        </div>

        <input type="hidden" id="candidateStatus" value="Active">

        <div class="form-group">
          <label class="form-label" for="candidateParty">Party</label>
          <select class="form-select" id="candidateParty" required>
            <option value="">Select Party</option>
            <!-- Options will be dynamically populated -->
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="candidatePosition">Position</label>
          <select class="form-select" id="candidatePosition" required>
            <option value="">Select Position</option>
            <!-- populated from server -->
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="candidateYear">Year Level</label>
          <select class="form-select" id="candidateYear" required>
            <option value="">Select Year Level</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Candidate Photo</label>
          <div class="file-upload-container">
            <label for="candidatePhoto" class="file-upload-label">
              <i class="fas fa-upload"></i> Choose Photo
            </label>
            <input type="file" id="candidatePhoto" class="file-upload-input" accept="image/*">
            <img id="photoPreview" class="file-preview" alt="Photo Preview" style="display:none;max-width:120px;"/>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Platform</label>
          <div id="addPlatformItems"></div>
          <button type="button" class="add-item-btn" id="addPlatformItem">
            <i class="fas fa-plus"></i> Add Platform Item
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">Key Achievements</label>
          <div id="addAchievementItems"></div>
          <button type="button" class="add-item-btn" id="addAchievementItem">
            <i class="fas fa-plus"></i> Add Achievement
          </button>
        </div>

        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelCandidateBtn">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Candidate</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit Candidate Modal -->
  <div class="modal" id="editCandidateModal" style="display:none;">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h2>Edit Candidate</h2>
        <button class="close-modal" id="closeEditCandidateModal">&times;</button>
      </div>
      <form id="editCandidateForm">
        <input type="hidden" id="editCandidateId">
        <div class="form-group">
          <label class="form-label" for="editCandidateName">Full Name</label>
          <input type="text" class="form-input" id="editCandidateName" required>
        </div>

        <div class="form-group">
          <select class="form-select" id="editCandidateProgram" required>
            <option value="">Select Program / Course</option>
            <!-- populated from fixed list -->
          </select>
        </div>

        <input type="hidden" id="editCandidateStatus" value="Active">

        <div class="form-group">
          <label class="form-label" for="editCandidateParty">Party</label>
          <select class="form-select" id="editCandidateParty" required>
            <option value="">Select Party</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="editCandidatePosition">Position</label>
          <select class="form-select" id="editCandidatePosition" required>
            <option value="">Select Position</option>
            <!-- populated from server -->
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="editCandidateYear">Year Level</label>
          <select class="form-select" id="editCandidateYear" required>
            <option value="">Select Year Level</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Candidate Photo</label>
          <div class="file-upload-container">
            <label for="editCandidatePhoto" class="file-upload-label">
              <i class="fas fa-upload"></i> Change Photo
            </label>
            <input type="file" id="editCandidatePhoto" class="file-upload-input" accept="image/*">
            <img id="editPhotoPreview" class="file-preview" alt="Photo Preview" style="display:none;max-width:120px;"/>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Platform</label>
          <div id="platformItems"></div>
          <button type="button" class="add-item-btn" id="addPlatformItemEdit">
            <i class="fas fa-plus"></i> Add Platform Item
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">Key Achievements</label>
          <div id="achievementItems"></div>
          <button type="button" class="add-item-btn" id="addAchievementItemEdit">
            <i class="fas fa-plus"></i> Add Achievement
          </button>
        </div>

        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelEditCandidateBtn">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Candidate</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal confirmation-modal" id="confirmationModal" style="display:none;">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Confirm Action</h2>
        <button class="close-modal" id="closeConfirmationModal">&times;</button>
      </div>
      <div class="confirmation-message" id="confirmationMessage"></div>
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" id="cancelConfirmationBtn">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmActionBtn">Confirm</button>
      </div>
    </div>
  </div>

  <!-- Toast notification -->
  <div class="toast" id="toast" style="display:none;"></div>

  <script>
/* =====================
   CONFIG / ENDPOINTS
   ===================== */
const GET_PARTIES = './get_parties.php';
const GET_CANDIDATES = '/eBotoni/eBotoni/student%20org/get_candidates.php';
const ADD_PARTY = './add_party.php';
const ADD_CANDIDATE = './add_candidate.php';
const UPDATE_CANDIDATE = './update_candidate.php';
const DELETE_CANDIDATE = './delete_candidate.php';

/* FIXED PROGRAM LIST (exact list) */
const FIXED_PROGRAMS = [
  'Information Technology',
  'Naval Architecture and Marine Engineering',
  'Energy Systems and Management',
  'Manufacturing Engineering Technology',
  'Technology Communication Management'
];

/* fallback candidate program/position endpoints (tries these in order) */
const GET_PROGRAMS_FALLBACKS = [
  './get_programs.php',
  'get_programs.php',
  './admin/get_programs.php',
  '/eBotoni/eBotoni/admin/get_programs.php',
  '/eBotoni/eBotoni/get_programs.php'
];
const GET_POSITIONS_FALLBACKS = [
  './get_positions.php',
  'get_positions.php',
  './admin/get_positions.php',
  '/eBotoni/eBotoni/admin/get_positions.php',
  '/eBotoni/eBotoni/get_positions.php'
];

/* Program alias lists (DB variants) */
const ESM_PROGRAM_ALIAS = [
  'Energy Systems and Management','Energy Systems & Management','Energy Management','ESM','BS ESM',
  'BS ENERGY MANAGEMENT','BS ENERGY ENGINEERING','BS ENERGY TECHNOLOGY','BS ENERGY SYSTEMS AND MANAGEMENT',
  'BS ENGR ENERGY MANAGEMENT','B.S. ENERGY MANAGEMENT','B.S. ESM','Energy Systems Management','Energy Technology','Energy Engineering',
  'Naval Architecture and Marine Engineering','BS Naval Architecture and Marine Engineering','NAME','BS NAME',
  'Technology Communication Management','BS Technology Communication Management','BS TCM','TCM',
  'Mechanical Engineering Technology','Manufacturing Engineering Technology','BS Mechanical Engineering Technology','BS Manufacturing Engineering Technology','MET','BS MET'
];

/* ===================== DOM refs ===================== */
const searchInput = document.getElementById('searchInput');
const partyContainer = document.getElementById('partyContainer');
const addCandidateBtn = document.getElementById('addCandidateBtn');
const addPartyBtn = document.getElementById('addPartyBtn');
const addPartyModal = document.getElementById('addPartyModal');
const addCandidateModal = document.getElementById('addCandidateModal');
const editCandidateModal = document.getElementById('editCandidateModal');
const confirmationModal = document.getElementById('confirmationModal');
const confirmationMessage = document.getElementById('confirmationMessage');
const confirmActionBtn = document.getElementById('confirmActionBtn');
const cancelConfirmationBtn = document.getElementById('cancelConfirmationBtn');
const toastEl = document.getElementById('toast');

const partyForm = document.getElementById('partyForm');
const partyLogo = document.getElementById('partyLogo');
const partyLogoPreview = document.getElementById('partyLogoPreview');

const candidateForm = document.getElementById('candidateForm');
const candidatePhoto = document.getElementById('candidatePhoto');
const photoPreview = document.getElementById('photoPreview');

const candidatePartySelect = document.getElementById('candidateParty');
const candidateProgramSelect = document.getElementById('candidateProgram');
const candidatePositionSelect = document.getElementById('candidatePosition');

const editCandidateForm = document.getElementById('editCandidateForm');
const editCandidatePhoto = document.getElementById('editCandidatePhoto');
const editPhotoPreview = document.getElementById('editPhotoPreview');
const editCandidatePartySelect = document.getElementById('editCandidateParty');
const editCandidateProgramSelect = document.getElementById('editCandidateProgram');
const editCandidatePositionSelect = document.getElementById('editCandidatePosition');

const addPlatformItems = document.getElementById('addPlatformItems');
const addAchievementItems = document.getElementById('addAchievementItems');
const addPlatformItem = document.getElementById('addPlatformItem');
const addAchievementItem = document.getElementById('addAchievementItem');

const platformItems = document.getElementById('platformItems');
const achievementItems = document.getElementById('achievementItems');
const addPlatformItemEdit = document.getElementById('addPlatformItemEdit');
const addAchievementItemEdit = document.getElementById('addAchievementItemEdit');

/* ===================== STATE ===================== */
let currentSearch = '';
let partyData = [];
let rawCandidates = [];
let pendingAction = null;
let currentEditingCandidate = null;
let programsFromServer = [];
let positionsFromServer = [];
let acceptedEsms = new Set();

/* ===================== UTILS ===================== */
function showToast(msg, t = 3000) {
  if (!toastEl) return;
  toastEl.textContent = msg;
  toastEl.style.display = 'block';
  clearTimeout(toastEl._t);
  toastEl._t = setTimeout(()=> toastEl.style.display='none', t);
}
function createListItemInput(value='') {
  const wrapper = document.createElement('div');
  wrapper.className = 'list-item';
  const input = document.createElement('input');
  input.type = 'text';
  input.className = 'form-input list-item-input';
  input.value = value;
  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className = 'remove-item';
  btn.innerHTML = '<i class="fas fa-times"></i>';
  btn.addEventListener('click', ()=> wrapper.remove());
  wrapper.appendChild(input);
  wrapper.appendChild(btn);
  return wrapper;
}
function escapeHtml(s) {
  if (!s) return '';
  return String(s).replace(/[&<>"']/g, (m)=> ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'})[m]);
}

/* ===================== File previews ===================== */
if (partyLogo) partyLogo.addEventListener('change', (e)=>{
  const f = e.target.files[0];
  if (!f) { if (partyLogoPreview) partyLogoPreview.style.display='none'; return; }
  const r = new FileReader();
  r.onload = ev => { if (partyLogoPreview) { partyLogoPreview.src = ev.target.result; partyLogoPreview.style.display='block'; } };
  r.readAsDataURL(f);
});
if (candidatePhoto) candidatePhoto.addEventListener('change', (e)=>{
  const f = e.target.files[0];
  if (!f) { if (photoPreview) photoPreview.style.display='none'; return; }
  const r = new FileReader();
  r.onload = ev => { if (photoPreview) { photoPreview.src = ev.target.result; photoPreview.style.display='block'; } };
  r.readAsDataURL(f);
});
if (editCandidatePhoto) editCandidatePhoto.addEventListener('change', (e)=>{
  const f = e.target.files[0];
  if (!f) { if (editPhotoPreview) editPhotoPreview.style.display='none'; return; }
  const r = new FileReader();
  r.onload = ev => { if (editPhotoPreview) { editPhotoPreview.src = ev.target.result; editPhotoPreview.style.display='block'; } };
  r.readAsDataURL(f);
});

if (addPlatformItem) addPlatformItem.addEventListener('click', ()=> addPlatformItems.appendChild(createListItemInput('')));
if (addAchievementItem) addAchievementItem.addEventListener('click', ()=> addAchievementItems.appendChild(createListItemInput('')));
if (addPlatformItemEdit) addPlatformItemEdit.addEventListener('click', ()=> platformItems.appendChild(createListItemInput('')));
if (addAchievementItemEdit) addAchievementItemEdit.addEventListener('click', ()=> achievementItems.appendChild(createListItemInput('')));

/* ===================== Fetch helper: try multiple URLs until JSON ===================== */
async function tryUrlsForJson(urls, opts = {}) {
  for (const url of urls) {
    try {
      const res = await fetch(url, opts);
      const txt = await res.text();
      const ct = (res.headers.get('content-type') || '').toLowerCase();

      if (!res.ok) {
        console.warn('tryUrlsForJson: non-ok status', res.status, url);
        continue;
      }

      if (ct.includes('application/json')) {
        try {
          const json = JSON.parse(txt);
          if (Array.isArray(json)) return json;
          if (json && Array.isArray(json.data)) return json.data;
          return [];
        } catch (parseErr) {
          console.warn('tryUrlsForJson: JSON parse failed for', url, parseErr);
          continue;
        }
      }

      // fallback: try parse even if content-type missing
      try {
        const json = JSON.parse(txt);
        if (Array.isArray(json)) return json;
        if (json && Array.isArray(json.data)) return json.data;
        return [];
      } catch (parseErr) {
        console.warn('tryUrlsForJson: expected JSON but got non-JSON from', url);
        continue;
      }
    } catch (err) {
      console.warn('tryUrlsForJson: fetch error for', url, err);
      continue;
    }
  }
  console.error('tryUrlsForJson: no urls returned JSON. Tried:', urls);
  return [];
}

/* ===================== fetch wrappers that use the fallback lists ===================== */
async function fetchParties() { return await safeFetchJson(GET_PARTIES); }
async function fetchCandidates() {
  const url = `${GET_CANDIDATES}?department=ESM`;
  return await safeFetchJson(url);
}
async function fetchPrograms() { return await tryUrlsForJson(GET_PROGRAMS_FALLBACKS); }
async function fetchPositions() { return await tryUrlsForJson(GET_POSITIONS_FALLBACKS); }

/* safeFetchJson (keeps original defensive behavior) */
async function safeFetchJson(url) {
  try {
    const res = await fetch(url);
    const ct = (res.headers.get('content-type') || '').toLowerCase();
    if (!res.ok) {
      const txt = await res.text().catch(()=>'<no-body>');
      console.error('safeFetchJson: HTTP error', res.status, url, txt.slice(0,400));
      return [];
    }
    if (!ct.includes('application/json')) {
      const txt = await res.text().catch(()=>'<no-body>');
      console.error('safeFetchJson: expected JSON but got:', ct || 'no-content-type', 'response preview:', txt.slice(0,400));
      return [];
    }
    const json = await res.json();
    if (Array.isArray(json)) return json;
    if (json && Array.isArray(json.data)) return json.data;
    return [];
  } catch (err) {
    console.error('safeFetchJson', url, err);
    return [];
  }
}

/* ===================== Data transform & UI builders ===================== */
function parseMaybeJson(value) {
  if (!value) return [];
  if (Array.isArray(value)) return value;
  try { return JSON.parse(value); } catch (e) {
    if (typeof value === 'string') return value.split(/\r?\n|,|;/).map(s => s.trim()).filter(Boolean);
    return [];
  }
}

function buildUI(partiesRaw, candidatesRaw) {
  const byKey = new Map();
  function normStr(v){ return v === undefined || v === null ? '' : String(v).trim(); }

  (partiesRaw || []).forEach(p=>{
    const rawId = p.id !== undefined && p.id !== null ? String(p.id) : '';
    const short = normStr(p.short_code || p.short || p.shortcode || '');
    const name = normStr(p.name || p.party_name || '');
    const key = short || rawId || (name?name.toLowerCase().replace(/\s+/g,'-'):'') || name || ('party-' + Math.random());
    if (!byKey.has(key)) {
      byKey.set(key, {
        keyId: key,
        id: rawId,
        name: name || key,
        slogan: p.slogan || '',
        logo: p.logo || p.color || '../assets/default-logo.jpg',
        candidatesCount: 0,
        established: p.established || '',
        department: p.department || p.dept || '',
        short_code: short,
        raw: p,
        candidates: []
      });
    }
  });

  if (!byKey.has('independent')) {
    byKey.set('independent', {
      keyId:'independent', id:'', name:'Independent', slogan:'', logo:'../assets/default-logo.jpg',
      candidatesCount:0, established:'', department:'', short_code:'', raw:{}, candidates:[]
    });
  }

  const parties = Array.from(byKey.values());

  (candidatesRaw || []).forEach(c=>{
    const candId = normStr(c.Candidate_ID || c.id || c.Student_ID) || (Date.now()+Math.random()).toString();
    const candidateObj = {
      id: candId,
      name: normStr(c.FullName || c.Fullname || c.name || ''),
      position: normStr(c.Position_Name || c.Position || c.position || ''),
      position_id: normStr(c.Position_ID || c.PositionId || ''),
      course: normStr(c.Program || c.course || c.program || ''),
      yearLevel: normStr(c.YearLevel || c.yearLevel || ''),
      image: normStr(c.Avatar || c.avatar || c.image || c.Photo || '../assets/default-avatar.jpg'),
      platform: parseMaybeJson(c.Platform || c.platform || c.Platforms || ''),
      achievements: parseMaybeJson(c.Experience || c.experience || c.Achievements || ''),
      raw: c
    };

    let matched = null;
    const tokens = [];
    ['PartyList','party','Org_ID','Org_Name','short_code','OrgName','Org_Name'].forEach(k=>{
      if (c[k]) tokens.push(String(c[k]));
    });
    if (typeof c.PartyList === 'string' && c.PartyList.includes(' - ')) {
      c.PartyList.split(' - ').forEach(t => tokens.push(t.trim()));
    }
    for (const t of tokens) {
      const tt = String(t).toLowerCase();
      matched = parties.find(p => (p.keyId && p.keyId.toLowerCase()===tt) || (p.id && String(p.id)===tt) || (p.short_code && p.short_code.toLowerCase()===tt) || (p.name && p.name.toLowerCase()===tt) );
      if (matched) break;
    }
    if (!matched) matched = parties.find(p=>p.keyId==='independent');
    if (!matched) matched = parties[0];
    matched.candidates.push(candidateObj);
  });

  parties.forEach(p=> p.candidatesCount = p.candidates.length);
  partyData = parties;
  rawCandidates = candidatesRaw || [];
}

function renderPartyCards() {
  if (!partyContainer) return;
  partyContainer.innerHTML = '';
  const search = (currentSearch || '').trim().toLowerCase();

  partyData.forEach(party => {
    if (!party.candidates || party.candidates.length === 0) return;
    const filteredCandidates = !search ? party.candidates : party.candidates.filter(c =>
      (c.name||'').toLowerCase().includes(search) ||
      (c.position||'').toLowerCase().includes(search) ||
      (c.course||'').toLowerCase().includes(search)
    );
    if (search && filteredCandidates.length === 0) return;

    const partyCard = document.createElement('div');
    partyCard.className = 'party-card';
    partyCard.innerHTML = `
      <div class="party-header">
        <img src="${party.logo}" class="party-logo" alt="${escapeHtml(party.name)} Logo">
        <div class="party-info">
          <h2>${escapeHtml(party.name)}</h2>
          <p>"${escapeHtml(party.slogan || '')}"</p>
          <div class="party-stats">
            <div class="party-stat">
              <div class="party-stat-value">${party.candidatesCount} Candidates</div>
              <div class="party-stat-label">Total</div>
            </div>
            <div class="party-stat">
              <div class="party-stat-value">Est. ${party.established || '—'}</div>
              <div class="party-stat-label">Established</div>
            </div>
          </div>
          <div class="party-tag">${escapeHtml(party.department || '')}</div>
        </div>
      </div>
      <div class="candidates-grid"></div>
    `;
    const grid = partyCard.querySelector('.candidates-grid');

    filteredCandidates.forEach(candidate => {
      const candidateCard = document.createElement('div');
      candidateCard.className = 'candidate-card';
      candidateCard.innerHTML = `
        <div class="candidate-actions">
          <button class="btn-action btn-edit" data-id="${candidate.id}">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn-action btn-delete" data-id="${candidate.id}">
            <i class="fas fa-trash"></i>
          </button>
        </div>
        <div class="candidate-header-card">
          <img src="${candidate.image}" class="candidate-avatar" alt="${escapeHtml(candidate.name)}">
          <div class="candidate-basic-info">
            <h3>${escapeHtml(candidate.name)}</h3>
            <p>${escapeHtml(candidate.course)}</p>
            <div class="candidate-position">${escapeHtml(candidate.position)}</div>
          </div>
        </div>
        <div class="candidate-details">
          <div class="candidate-section">
            <h4>Education</h4>
            <div class="candidate-info-item">
              <div class="info-label">Course:</div>
              <div class="info-value">${escapeHtml(candidate.course)}</div>
            </div>
            <div class="candidate-info-item">
              <div class="info-label">Year Level:</div>
              <div class="info-value">${escapeHtml(candidate.yearLevel || '—')}</div>
            </div>
          </div>
          <div class="candidate-section">
            <h4>Platform</h4>
            <ul class="platform-list">
              ${(candidate.platform||[]).map(it=>`<li>${escapeHtml(it)}</li>`).join('')}
            </ul>
          </div>
          <div class="candidate-section">
            <h4>Key Achievements</h4>
            <ul class="achievement-list">
              ${(candidate.achievements||[]).map(it=>`<li>${escapeHtml(it)}</li>`).join('')}
            </ul>
          </div>
        </div>
      `;
      grid.appendChild(candidateCard);
    });

    partyContainer.appendChild(partyCard);
  });

  if (partyContainer.children.length === 0) {
    partyContainer.innerHTML = `
      <div style="text-align:center;padding:40px;background:white;border-radius:10px;">
        <i class="fas fa-user-tag" style="font-size:48px;color:#ccc;"></i>
        <h3>No candidates found</h3>
        <p>Try changing your search term or add a new candidate.</p>
      </div>
    `;
  }

  // attach listeners
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.getAttribute('data-id');
      openEditCandidateModal(id);
    });
  });
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.getAttribute('data-id');
      showConfirmation('Delete Candidate', 'Are you sure you want to delete this candidate? This action cannot be undone.', async () => {
        await performDeleteCandidate(id);
      });
    });
  });
}

/* Populate party selects */
function populatePartySelects() {
  if (!candidatePartySelect) return;
  candidatePartySelect.innerHTML = '<option value="">Select Party</option>';
  if (editCandidatePartySelect) editCandidatePartySelect.innerHTML = '<option value="">Select Party</option>';

  const seen = new Set();
  partyData.forEach(p => {
    const partyValue = (p.id && String(p.id).trim()) ? String(p.id) : (p.keyId || p.name);
    const label = p.name || p.keyId || partyValue;
    const dedupeKey = `${partyValue}||${label}`;
    if (seen.has(dedupeKey)) return;
    seen.add(dedupeKey);

    const opt = document.createElement('option');
    opt.value = partyValue;
    opt.textContent = label;
    candidatePartySelect.appendChild(opt);

    if (editCandidatePartySelect) {
      const opt2 = opt.cloneNode(true);
      editCandidatePartySelect.appendChild(opt2);
    }
  });
}

/* Populate programs (force fixed list) */
function populatePrograms(programsIgnored) {
  const finalPrograms = FIXED_PROGRAMS.slice();

  if (candidateProgramSelect) {
    candidateProgramSelect.innerHTML = '<option value="">Select Program / Course</option>';
    finalPrograms.forEach(p => {
      const opt = document.createElement('option');
      opt.value = p;
      opt.textContent = p;
      candidateProgramSelect.appendChild(opt);
    });
  }
  if (editCandidateProgramSelect) {
    editCandidateProgramSelect.innerHTML = '<option value="">Select Program / Course</option>';
    finalPrograms.forEach(p => {
      const opt = document.createElement('option');
      opt.value = p;
      opt.textContent = p;
      editCandidateProgramSelect.appendChild(opt);
    });
  }

  acceptedEsms.clear();
  const combinedEsms = new Set();
  finalPrograms.forEach(name => { if (name) combinedEsms.add(name.trim()); });
  ESM_PROGRAM_ALIAS.forEach(name => { if (name) combinedEsms.add(name.trim()); });

  combinedEsms.forEach(name => {
    const normalized = String(name).trim().toUpperCase();
    if (normalized) acceptedEsms.add(normalized);
  });
}

/* Populate positions */
function populatePositions(positions) {
  function toObj(p) {
    if (!p) return null;
    if (typeof p === 'string') return { id: p, name: p };
    if (p.name) return { id: (p.id !== undefined ? p.id : p.name), name: p.name };
    if (p.position_name) return { id: (p.id !== undefined ? p.id : p.position_name), name: p.position_name };
    return { id: p.id || p.name || String(p), name: String(p) };
  }
  const items = (positions || []).map(toObj).filter(Boolean);
  const finalItems = items.length ? items : [
    { id: '1', name: 'President' },
    { id: '2', name: 'Vice President' },
    { id: '3', name: 'Secretary' },
    { id: '4', name: 'Treasurer' },
    { id: '5', name: 'Auditor' },
    { id: '6', name: 'Public Relations Officer' },
    { id: '7', name: 'Representative' },
    { id: '8', name: 'Board Member' }
  ];

  if (candidatePositionSelect) {
    candidatePositionSelect.innerHTML = '<option value="">Select Position</option>';
    finalItems.forEach(it => {
      const opt = document.createElement('option');
      opt.value = it.id;
      opt.textContent = it.name;
      candidatePositionSelect.appendChild(opt);
    });
  }
  if (editCandidatePositionSelect) {
    editCandidatePositionSelect.innerHTML = '<option value="">Select Position</option>';
    finalItems.forEach(it => {
      const opt = document.createElement('option');
      opt.value = it.id;
      opt.textContent = it.name;
      editCandidatePositionSelect.appendChild(opt);
    });
  }
}

/* Filter only ESM candidates */
function filterForDepartment() {
  partyData.forEach(p => {
    p.candidates = (p.candidates || []).filter(c => {
      const programRaw = (c.course || '').trim();
      const programNorm = programRaw.toUpperCase();
      const partyDept = (p.department || '').trim().toLowerCase();

      if (partyDept && (partyDept.includes('energy') || partyDept.includes('esm'))) return true;
      if (acceptedEsms.has(programNorm)) return true;
      if (programNorm.includes('ENERGY') || programNorm.includes('ESM')) return true;

      return false;
    });
    p.candidatesCount = p.candidates.length;
  });

  partyData = partyData.filter(p => (p.candidatesCount || 0) > 0);
}

/* ===================== Add / Update / Delete Candidate & Party (AJAX) ===================== */
if (partyForm) {
  partyForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const name = document.getElementById('partyName').value.trim();
    if (!name) { showToast('Party name is required'); return; }

    const fd = new FormData();
    fd.append('name', name);
    fd.append('slogan', document.getElementById('partySlogan').value.trim());
    fd.append('established', document.getElementById('partyEstablished').value.trim());
    fd.append('short_code', name.toLowerCase().replace(/\s+/g,'-'));
    if (partyLogo && partyLogo.files[0]) fd.append('logo', partyLogo.files[0]);

    try {
      const res = await fetch(ADD_PARTY, { method: 'POST', body: fd });
      const json = await res.json();
      if (json.success) {
        showToast('Party added successfully');
        partyForm.reset();
        if (partyLogoPreview) partyLogoPreview.style.display = 'none';
        addPartyModal.style.display = 'none';
        await loadData();
      } else {
        console.error('add_party', json);
        showToast(json.message || 'Failed to add party');
      }
    } catch (err) {
      console.error(err);
      showToast('Network error while adding party');
    }
  });
}

if (candidateForm) {
  candidateForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const studentId = document.getElementById('candidateId').value.trim();
    const fullname = document.getElementById('candidateName').value.trim();
    const email = document.getElementById('candidateEmail').value.trim();
    const program = (candidateProgramSelect && candidateProgramSelect.value) ? candidateProgramSelect.value.trim() : '';
    const party = document.getElementById('candidateParty').value;
    const positionId = (candidatePositionSelect && candidatePositionSelect.value) ? candidatePositionSelect.value : '';
    const year = document.getElementById('candidateYear').value;
    const status = document.getElementById('candidateStatus') ? document.getElementById('candidateStatus').value : 'Active';

    if (!studentId || !fullname) { showToast('Student ID and Name required'); return; }
    if (!program) { showToast('Program / Course is required'); return; }
    if (!positionId) { showToast('Please select a Position'); return; }
    if (!party) { showToast('Please select a Party'); return; }

    const platforms = Array.from(addPlatformItems.querySelectorAll('.list-item-input')).map(i=>i.value).filter(Boolean);
    const achievements = Array.from(addAchievementItems.querySelectorAll('.list-item-input')).map(i=>i.value).filter(Boolean);

    const fd = new FormData();
    fd.append('Student_ID', studentId);
    fd.append('FullName', fullname);
    fd.append('Email', email);
    fd.append('Program', program);
    fd.append('Status', status);

    const selectedPartyText = (function(){
      const opt = candidatePartySelect.options[candidatePartySelect.selectedIndex];
      return opt ? opt.textContent : '';
    })();
    fd.append('PartyList', selectedPartyText);
    fd.append('Org_ID', party);
    fd.append('Position_ID', positionId);
    fd.append('YearLevel', year);
    fd.append('Platform', JSON.stringify(platforms));
    fd.append('Experience', JSON.stringify(achievements));
    if (candidatePhoto && candidatePhoto.files[0]) fd.append('Avatar', candidatePhoto.files[0]);

    try {
      const res = await fetch(ADD_CANDIDATE, { method: 'POST', body: fd });
      const json = await res.json();
      if (json.success) {
        showToast('Candidate added');
        candidateForm.reset();
        if (photoPreview) photoPreview.style.display = 'none';
        addPlatformItems.innerHTML = '';
        addAchievementItems.innerHTML = '';
        addCandidateModal.style.display = 'none';
        await loadData();
      } else {
        console.error('add_candidate', json);
        showToast(json.message || 'Failed to add candidate');
      }
    } catch (err) {
      console.error(err);
      showToast('Network error while adding candidate');
    }
  });
}

if (editCandidateForm) {
  editCandidateForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('editCandidateId').value;
    const fullname = document.getElementById('editCandidateName').value.trim();
    const program = (editCandidateProgramSelect && editCandidateProgramSelect.value) ? editCandidateProgramSelect.value.trim() : '';
    const party = document.getElementById('editCandidateParty').value;
    const positionId = (editCandidatePositionSelect && editCandidatePositionSelect.value) ? editCandidatePositionSelect.value : '';
    const year = document.getElementById('editCandidateYear').value;
    const status = document.getElementById('editCandidateStatus') ? document.getElementById('editCandidateStatus').value : 'Active';

    if (!program) { showToast('Program / Course is required'); return; }
    if (!positionId) { showToast('Please select a Position'); return; }
    if (!party) { showToast('Please select a Party'); return; }

    const platforms = Array.from(platformItems.querySelectorAll('.list-item-input')).map(i=>i.value).filter(Boolean);
    const achievements = Array.from(achievementItems.querySelectorAll('.list-item-input')).map(i=>i.value).filter(Boolean);

    const fd = new FormData();
    fd.append('id', id);
    fd.append('FullName', fullname);
    fd.append('Program', program);
    fd.append('Status', status);

    const selectedPartyText = (function(){
      const opt = editCandidatePartySelect.options[editCandidatePartySelect.selectedIndex];
      return opt ? opt.textContent : '';
    })();
    fd.append('PartyList', selectedPartyText);
    fd.append('Org_ID', party);
    fd.append('Position_ID', positionId);
    fd.append('YearLevel', year);
    fd.append('Platform', JSON.stringify(platforms));
    fd.append('Experience', JSON.stringify(achievements));
    if (editCandidatePhoto && editCandidatePhoto.files[0]) fd.append('Avatar', editCandidatePhoto.files[0]);

    try {
      const res = await fetch(UPDATE_CANDIDATE, { method: 'POST', body: fd });
      const json = await res.json();
      if (json.success) {
        showToast('Candidate updated');
        editCandidateForm.reset();
        if (editPhotoPreview) editPhotoPreview.style.display = 'none';
        editCandidateModal.style.display = 'none';
        await loadData();
      } else {
        console.error('update_candidate', json);
        showToast(json.message || 'Failed to update candidate');
      }
    } catch (err) {
      console.error(err);
      showToast('Network error while updating candidate');
    }
  });
}

async function performDeleteCandidate(id) {
  if (!id) return;
  try {
    const fd = new FormData();
    fd.append('id', id);
    const res = await fetch(DELETE_CANDIDATE, { method: 'POST', body: fd });
    const json = await res.json();
    if (json.success) {
      showToast('Candidate deleted');
      await loadData();
    } else {
      console.error('delete_candidate', json);
      showToast(json.message || 'Failed to delete');
    }
  } catch (err) {
    console.error(err);
    showToast('Network error while deleting candidate');
  }
}

/* ===================== Edit modal utilities ===================== */
function findPositionIdFromName(name) {
  if (!name) return '';
  const lower = name.toLowerCase();
  for (const opt of Array.from(candidatePositionSelect.options)) {
    if (!opt.value) continue;
    if ((opt.text || '').toLowerCase() === lower) return opt.value;
    if (lower.includes((opt.text || '').toLowerCase()) || (opt.text || '').toLowerCase().includes(lower)) return opt.value;
  }
  return '';
}

function openEditCandidateModal(candidateId) {
  let candidate = null;
  let partyKey = null;
  for (const p of partyData) {
    const found = p.candidates.find(c => c.id === candidateId);
    if (found) { candidate = found; partyKey = p.id || p.keyId || (p.name); break; }
  }
  if (!candidate) { showToast('Candidate not found'); return; }

  currentEditingCandidate = candidate;
  document.getElementById('editCandidateId').value = candidate.id;
  document.getElementById('editCandidateName').value = candidate.name || '';

  const programVal = candidate.course || (candidate.raw && (candidate.raw.Program || candidate.raw.course)) || '';
  if (editCandidateProgramSelect) editCandidateProgramSelect.value = programVal;

  const rawStatus = (candidate.raw && (candidate.raw.Status || candidate.raw.status)) ? (candidate.raw.Status || candidate.raw.status) : (document.getElementById('editCandidateStatus') ? document.getElementById('editCandidateStatus').value : 'Active');
  if (document.getElementById('editCandidateStatus')) document.getElementById('editCandidateStatus').value = rawStatus;

  if (editCandidatePartySelect) editCandidatePartySelect.value = partyKey || '';

  let positionId = candidate.position_id || (candidate.raw && (candidate.raw.Position_ID || candidate.raw.PositionId || candidate.raw.Position_ID)) || '';
  if (!positionId) positionId = findPositionIdFromName(candidate.position);
  if (editCandidatePositionSelect) editCandidatePositionSelect.value = positionId || '';

  if (document.getElementById('editCandidateYear')) document.getElementById('editCandidateYear').value = candidate.yearLevel || '';

  if (candidate.image && editPhotoPreview) { editPhotoPreview.src = candidate.image; editPhotoPreview.style.display='block'; } else if (editPhotoPreview) editPhotoPreview.style.display='none';

  if (platformItems) platformItems.innerHTML = '';
  if (achievementItems) achievementItems.innerHTML = '';
  (candidate.platform||[]).forEach(it => platformItems.appendChild(createListItemInput(it)));
  (candidate.achievements||[]).forEach(it => achievementItems.appendChild(createListItemInput(it)));

  if (editCandidateModal) editCandidateModal.style.display = 'flex';
}

/* ===================== Confirmation helper ===================== */
function showConfirmation(title, message, callback) {
  if (confirmationMessage) confirmationMessage.textContent = message;
  pendingAction = callback;
  if (confirmationModal) confirmationModal.style.display = 'flex';
}
if (confirmActionBtn) confirmActionBtn.addEventListener('click', () => {
  if (pendingAction) pendingAction();
  pendingAction = null;
  if (confirmationModal) confirmationModal.style.display = 'none';
});
if (cancelConfirmationBtn) cancelConfirmationBtn.addEventListener('click', () => { pendingAction = null; if (confirmationModal) confirmationModal.style.display='none'; });

/* ===================== Basic UI events ===================== */
if (addPartyBtn) addPartyBtn.addEventListener('click', () => addPartyModal.style.display = 'flex');
if (addCandidateBtn) addCandidateBtn.addEventListener('click', () => addCandidateModal.style.display = 'flex');

if (document.getElementById('closePartyModal')) document.getElementById('closePartyModal').addEventListener('click', ()=> { addPartyModal.style.display='none'; if (partyForm) partyForm.reset(); if (partyLogoPreview) partyLogoPreview.style.display='none'; });
if (document.getElementById('cancelPartyBtn')) document.getElementById('cancelPartyBtn').addEventListener('click', ()=> { addPartyModal.style.display='none'; if (partyForm) partyForm.reset(); if (partyLogoPreview) partyLogoPreview.style.display='none'; });

if (document.getElementById('closeCandidateModal')) document.getElementById('closeCandidateModal').addEventListener('click', ()=> { addCandidateModal.style.display='none'; if (candidateForm) candidateForm.reset(); if (photoPreview) photoPreview.style.display='none'; if (addPlatformItems) addPlatformItems.innerHTML=''; if (addAchievementItems) addAchievementItems.innerHTML=''; });
if (document.getElementById('cancelCandidateBtn')) document.getElementById('cancelCandidateBtn').addEventListener('click', ()=> { addCandidateModal.style.display='none'; if (candidateForm) candidateForm.reset(); if (photoPreview) photoPreview.style.display='none'; if (addPlatformItems) addPlatformItems.innerHTML=''; if (addAchievementItems) addAchievementItems.innerHTML=''; });

if (document.getElementById('closeEditCandidateModal')) document.getElementById('closeEditCandidateModal').addEventListener('click', ()=> { editCandidateModal.style.display='none'; if (editCandidateForm) editCandidateForm.reset(); if (editPhotoPreview) editPhotoPreview.style.display='none'; if (platformItems) platformItems.innerHTML=''; if (achievementItems) achievementItems.innerHTML=''; });
if (document.getElementById('cancelEditCandidateBtn')) document.getElementById('cancelEditCandidateBtn').addEventListener('click', ()=> { editCandidateModal.style.display='none'; if (editCandidateForm) editCandidateForm.reset(); if (editPhotoPreview) editPhotoPreview.style.display='none'; if (platformItems) platformItems.innerHTML=''; if (achievementItems) achievementItems.innerHTML=''; });

window.addEventListener('click', (e) => {
  if (e.target === addPartyModal) { addPartyModal.style.display='none'; if (partyForm) partyForm.reset(); if (partyLogoPreview) partyLogoPreview.style.display='none'; }
  if (e.target === addCandidateModal) { addCandidateModal.style.display='none'; if (candidateForm) candidateForm.reset(); if (photoPreview) photoPreview.style.display='none'; if (addPlatformItems) addPlatformItems.innerHTML=''; if (addAchievementItems) addAchievementItems.innerHTML=''; }
  if (e.target === editCandidateModal) { editCandidateModal.style.display='none'; if (editCandidateForm) editCandidateForm.reset(); if (editPhotoPreview) editPhotoPreview.style.display='none'; if (platformItems) platformItems.innerHTML=''; if (achievementItems) achievementItems.innerHTML=''; }
  if (e.target === confirmationModal) { confirmationModal.style.display='none'; pendingAction = null; }
});

if (searchInput) searchInput.addEventListener('input', (e) => { currentSearch = e.target.value; renderPartyCards(); });

/* ===================== Initialization / data load ===================== */
async function loadData() {
  try {
    const [pRaw, cRaw, progRaw, posRaw] = await Promise.all([
      fetchParties(),
      fetchCandidates(),
      fetchPrograms(),
      fetchPositions()
    ]);

    buildUI(pRaw || [], cRaw || []);
    programsFromServer = progRaw || [];
    positionsFromServer = posRaw || [];

    populatePrograms(programsFromServer);
    populatePositions(positionsFromServer);
    populatePartySelects();
    filterForDepartment();
    renderPartyCards();
  } catch (err) {
    console.error('loadData', err);
    populatePrograms(programsFromServer || []);
    populatePositions(positionsFromServer || []);
    populatePartySelects();
    filterForDepartment();
    renderPartyCards();
  }
}

document.addEventListener('DOMContentLoaded', () => {
  loadData();
});
  </script>
</body>
</html>


<style>
    /* All the same CSS styles from the IT page */
    :root {
      --ustp-blue: #003366;
      --ustp-light-blue: #0066cc;
      --ustp-gold: #ffcc00;
      --ustp-white: #ffffff;
      --ustp-light-gray: #f5f5f5;
      --ustp-dark-gray: #333333;
      --sidebar-width: 250px;
      --header-height: 60px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: var(--ustp-light-gray);
      color: var(--ustp-dark-gray);
    }

    .sidebar {
      width: var(--sidebar-width);
      background: linear-gradient(180deg, var(--ustp-blue) 0%, var(--ustp-light-blue) 100%);
      color: var(--ustp-white);
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
      z-index: 100;
      transition: 0.3s ease;
    }

    .logo-container {
      text-align: center;
      width: 100%;
      padding: 0 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 20px;
    }

    .logo {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 10px auto;
      border: 4px solid var(--ustp-gold);
      background-color: var(--ustp-white);
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .logo-container h2 {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--ustp-white);
    }

    /* NAVIGATION - EXACTLY THE SAME AS VOTERS PAGE */
    .nav-menu {
      flex: 1;
      list-style: none;
      padding: 0;
      width: 100%;
    }

    .nav-item {
      padding: 14px 25px;
      display: flex;
      align-items: center;
      gap: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 15px;
    }

    .nav-item:hover {
      background-color: #004b99;
    }

    .nav-item.active {
      background-color: var(--ustp-gold);
      color: var(--ustp-blue);
      font-weight: bold;
      border-left: 4px solid var(--ustp-gold);
    }

    .nav-item i {
      width: 20px;
      text-align: center;
    }

    .nav-item a {
      text-decoration: none;
      color: inherit;
      display: block;
      width: 100%;
    }

    /* USER PROFILE - EXACTLY THE SAME AS VOTERS PAGE */
    .user-profile {
      padding: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      gap: 12px;
      position: relative;
      cursor: pointer;
      width: 100%;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid var(--ustp-gold);
      object-fit: cover;
    }

    .user-info h4 {
      font-size: 0.95rem;
      margin-bottom: 2px;
    }

    .user-info p {
      font-size: 0.8rem;
      opacity: 0.8;
    }

    .user-dropdown {
      display: none;
      position: absolute;
      bottom: 70px;
      left: 20px;
      background: var(--ustp-blue);
      border: 1px solid var(--ustp-gold);
      border-radius: 8px;
      overflow: hidden;
      width: 150px;
      z-index: 10;
    }

    .user-dropdown a {
      display: block;
      padding: 10px 20px;
      color: var(--ustp-white);
      text-decoration: none;
    }

    .user-dropdown a:hover {
      background: var(--ustp-gold);
      color: var(--ustp-blue);
    }

    /* MAIN CONTENT - EXACTLY THE SAME AS VOTERS PAGE */
    .main-content {
      flex: 1;
      margin-left: var(--sidebar-width);
      display: flex;
      flex-direction: column;
      transition: margin-left 0.3s ease;
    }

    .header {
      height: var(--header-height);
      background: var(--ustp-white);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .header h1 {
      color: var(--ustp-blue);
      font-size: 22px;
      font-weight: 700;
    }

    .menu-toggle {
      display: none;
      font-size: 22px;
      color: var(--ustp-blue);
      cursor: pointer;
    }

    .content {
      padding: 30px;
      flex: 1;
    }

    /* Candidate Management Specific Styles */
    .candidate-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .candidate-title {
      color: var(--ustp-blue);
      font-size: 24px;
    }

    .search-box {
      display: flex;
      gap: 10px;
    }

    .search-input {
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      width: 300px;
      font-size: 14px;
    }

    .search-btn {
      background: var(--ustp-blue);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 0 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .search-btn:hover {
      background: var(--ustp-light-blue);
    }

    .add-candidate-btn, .add-party-btn {
      background: var(--ustp-gold);
      color: var(--ustp-blue);
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .add-candidate-btn:hover, .add-party-btn:hover {
      background: #e6b800;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
    }

    /* Department Header */
    .department-header {
      background: var(--ustp-white);
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 25px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .department-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid var(--ustp-gold);
      object-fit: cover;
      background-color: var(--ustp-white);
    }

    .department-info h2 {
      color: var(--ustp-blue);
      font-size: 28px;
      margin-bottom: 5px;
    }

    .department-info p {
      color: #666;
      font-size: 16px;
    }

    /* Party Cards */
    .party-container {
      display: flex;
      flex-direction: column;
      gap: 30px;
      margin-bottom: 30px;
    }

    .party-card {
      background: var(--ustp-white);
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .party-header {
      padding: 25px;
      background: linear-gradient(135deg, var(--ustp-blue) 0%, var(--ustp-light-blue) 100%);
      color: white;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .party-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid var(--ustp-gold);
      object-fit: cover;
      background-color: var(--ustp-white);
    }

    .party-info h2 {
      font-size: 24px;
      margin-bottom: 5px;
    }

    .party-info p {
      font-size: 14px;
      opacity: 0.9;
      margin-bottom: 5px;
    }

    .party-stats {
      display: flex;
      gap: 20px;
      margin-top: 10px;
    }

    .party-stat {
      display: flex;
      flex-direction: column;
    }

    .party-stat-value {
      font-size: 18px;
      font-weight: 700;
    }

    .party-stat-label {
      font-size: 12px;
      opacity: 0.8;
    }

    .party-tag {
      display: inline-block;
      background: var(--ustp-gold);
      color: var(--ustp-blue);
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      margin-top: 5px;
    }

    /* Candidate Grid */
    .candidates-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 25px;
      padding: 25px;
    }

    .candidate-card {
      background: #f9f9f9;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      position: relative;
    }

    .candidate-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .candidate-header-card {
      padding: 20px;
      background: var(--ustp-blue);
      color: white;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .candidate-avatar {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      border: 3px solid var(--ustp-gold);
      object-fit: cover;
      background-color: var(--ustp-white);
    }

    .candidate-basic-info h3 {
      font-size: 18px;
      margin-bottom: 5px;
    }

    .candidate-basic-info p {
      font-size: 14px;
      opacity: 0.9;
    }

    .candidate-position {
      display: inline-block;
      background: var(--ustp-gold);
      color: var(--ustp-blue);
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      margin-top: 5px;
    }

    .candidate-details {
      padding: 20px;
    }

    .candidate-section {
      margin-bottom: 20px;
    }

    .candidate-section:last-child {
      margin-bottom: 0;
    }

    .candidate-section h4 {
      color: var(--ustp-blue);
      font-size: 16px;
      margin-bottom: 10px;
      border-bottom: 1px solid #eee;
      padding-bottom: 5px;
    }

    .candidate-info-item {
      display: flex;
      margin-bottom: 8px;
    }

    .info-label {
      font-weight: 600;
      width: 120px;
      color: #555;
    }

    .info-value {
      flex: 1;
      color: #333;
    }

    .platform-list, .achievement-list {
      list-style-type: none;
      padding-left: 0;
    }

    .platform-list li, .achievement-list li {
      position: relative;
      padding-left: 15px;
      margin-bottom: 8px;
    }

    .platform-list li:before, .achievement-list li:before {
      content: "•";
      color: var(--ustp-blue);
      font-weight: bold;
      position: absolute;
      left: 0;
    }

    .candidate-actions {
      position: absolute;
      top: 10px;
      right: 10px;
      display: flex;
      gap: 5px;
    }

    .btn-action {
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 12px;
      font-weight: 600;
      transition: 0.3s;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .btn-edit {
      background: var(--ustp-blue);
      color: white;
    }

    .btn-edit:hover {
      background: var(--ustp-light-blue);
    }

    .btn-delete {
      background: #dc3545;
      color: white;
    }

    .btn-delete:hover {
      background: #c82333;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal-lg {
      max-width: 800px;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }

    .modal-header h2 {
      color: var(--ustp-blue);
      margin: 0;
    }

    .close-modal {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: var(--ustp-dark-gray);
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-primary {
      background: var(--ustp-blue);
      color: white;
    }

    .btn-primary:hover {
      background: var(--ustp-light-blue);
    }

    .btn-secondary {
      background: #6c757d;
      color: white;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .btn-danger {
      background: #dc3545;
      color: white;
    }

    .btn-danger:hover {
      background: #c82333;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--ustp-blue);
    }

    .form-input {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--ustp-blue);
    }

    .form-select {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      background-color: white;
    }

    .form-textarea {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      min-height: 100px;
      resize: vertical;
    }

    /* List Items with Remove Button */
    .list-item {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .list-item-input {
      flex: 1;
    }

    .remove-item {
      background: #dc3545;
      color: white;
      border: none;
      border-radius: 4px;
      width: 30px;
      height: 30px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .add-item-btn {
      background: var(--ustp-light-blue);
      color: white;
      border: none;
      border-radius: 4px;
      padding: 8px 15px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 14px;
    }

    .add-item-btn:hover {
      background: var(--ustp-blue);
    }

    /* File Upload Styles */
    .file-upload-container {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .file-upload-label {
      display: inline-block;
      padding: 10px 15px;
      background: var(--ustp-light-blue);
      color: white;
      border-radius: 6px;
      cursor: pointer;
      text-align: center;
      transition: 0.3s;
    }

    .file-upload-label:hover {
      background: var(--ustp-blue);
    }

    .file-upload-input {
      display: none;
    }

    .file-preview {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--ustp-gold);
      margin: 0 auto;
      display: none;
    }

    /* Confirmation Modal */
    .confirmation-modal .modal-content {
      max-width: 400px;
      text-align: center;
    }

    .confirmation-message {
      font-size: 16px;
      margin-bottom: 20px;
    }

    /* Toast notification */
    .toast {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 15px 25px;
      background-color: var(--ustp-blue);
      color: white;
      border-radius: 5px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      z-index: 1001;
      display: flex;
      align-items: center;
      gap: 10px;
      transform: translateY(100px);
      opacity: 0;
      transition: transform 0.3s, opacity 0.3s;
    }

    .toast.show {
      transform: translateY(0);
      opacity: 1;
    }

    .toast.success {
      background-color: #4caf50;
    }

    .toast.error {
      background-color: #f44336;
    }

    /* Responsive - EXACTLY THE SAME AS VOTERS PAGE */
    @media (max-width: 768px) {
      .sidebar { width: 70px; }
      .logo-container h2, .nav-item a { display: none; }
      .main-content { margin-left: 70px; }
      .menu-toggle { display: block; }
      .candidate-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      .search-box {
        width: 100%;
      }
      .search-input {
        width: 100%;
      }
      .department-header {
        flex-direction: column;
        text-align: center;
      }
      .party-header {
        flex-direction: column;
        text-align: center;
      }
      .candidates-grid {
        grid-template-columns: 1fr;
        padding: 15px;
      }
      .action-buttons {
        flex-direction: column;
        width: 100%;
      }
      .action-buttons button {
        width: 100%;
      }
    }
  </style>
</html>