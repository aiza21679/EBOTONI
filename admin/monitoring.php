<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eBOTO | Election Monitoring</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
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

    /* SIDEBAR - EXACTLY THE SAME AS OTHER PAGES */
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

    /* NAVIGATION - EXACTLY THE SAME AS OTHER PAGES */
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

    /* USER PROFILE - EXACTLY THE SAME AS OTHER PAGES */
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

    /* MAIN CONTENT - EXACTLY THE SAME AS OTHER PAGES */
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

    /* Monitoring Specific Styles */
    .monitoring-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .monitoring-title {
      color: var(--ustp-blue);
      font-size: 24px;
    }

    .filter-box {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .filter-select {
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      background-color: white;
    }

    .refresh-btn {
      background: var(--ustp-blue);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 15px;
      cursor: pointer;
      transition: 0.3s;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .refresh-btn:hover {
      background: var(--ustp-light-blue);
    }

    /* Stats Overview */
    .stats-overview {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: var(--ustp-white);
      border-radius: 10px;
      padding: 20px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s;
    }

    .stat-card:hover {
      transform: translateY(-4px);
    }

    .stat-icon {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      margin-right: 15px;
      font-size: 24px;
    }

    .stat-1 .stat-icon { background: rgba(1, 47, 107, 0.1); color: var(--ustp-blue); }
    .stat-2 .stat-icon { background: rgba(76, 175, 80, 0.1); color: #4caf50; }
    .stat-3 .stat-icon { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
    .stat-4 .stat-icon { background: rgba(156, 39, 176, 0.1); color: #9c27b0; }

    .stat-info h3 { margin: 0; font-size: 24px; font-weight: 700; }
    .stat-info p { font-size: 14px; color: #777; }

    /* Monitoring Boxes */
    .monitoring-boxes {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 25px;
      margin-bottom: 30px;
    }

    .monitoring-box {
      background: var(--ustp-white);
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      cursor: pointer;
    }

    .monitoring-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      border-color: var(--ustp-gold);
    }

    .monitoring-header-box {
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .monitoring-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 2px solid var(--ustp-gold);
      object-fit: cover;
      background-color: var(--ustp-white);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }

    .monitoring-info h3 {
      font-size: 18px;
      margin-bottom: 5px;
    }

    .monitoring-info p {
      font-size: 14px;
      opacity: 0.9;
    }

    .monitoring-stats {
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      background: rgba(0, 102, 204, 0.05);
    }

    .stat {
      text-align: center;
    }

    .stat-value {
      font-size: 20px;
      font-weight: 700;
      color: var(--ustp-blue);
    }

    .stat-label {
      font-size: 12px;
      color: #666;
    }

    .monitoring-details {
      padding: 15px 20px;
      border-top: 1px solid #eee;
    }

    .monitoring-detail {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .monitoring-detail-label {
      font-weight: 600;
      color: var(--ustp-blue);
    }

    .progress-bar {
      height: 8px;
      background: #e9ecef;
      border-radius: 4px;
      margin: 10px 0;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      border-radius: 4px;
      transition: width 0.5s ease;
    }

    .progress-active {
      background: var(--ustp-blue);
    }

    .progress-upcoming {
      background: #ffc107;
    }

    .progress-completed {
      background: #28a745;
    }

    .monitoring-actions {
      padding: 15px 20px;
      border-top: 1px solid #eee;
      text-align: center;
    }

    .btn-view-monitoring {
      background: var(--ustp-blue);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }

    .btn-view-monitoring:hover {
      background: var(--ustp-light-blue);
    }

    /* Status badges */
    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .status-active {
      background: #d4edda;
      color: #155724;
    }

    .status-upcoming {
      background: #fff3cd;
      color: #856404;
    }

    .status-completed {
      background: #d1ecf1;
      color: #0c5460;
    }

    .status-issues {
      background: #f8d7da;
      color: #721c24;
    }

    /* Real-time Activity */
    .activity-section {
      background: var(--ustp-white);
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      padding: 25px;
      margin-bottom: 30px;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }

    .section-title {
      color: var(--ustp-blue);
      font-size: 20px;
      font-weight: 600;
    }

    .activity-list {
      max-height: 300px;
      overflow-y: auto;
    }

    .activity-item {
      display: flex;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #f5f5f5;
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      font-size: 16px;
    }

    .activity-vote { background: rgba(76, 175, 80, 0.1); color: #4caf50; }
    .activity-user { background: rgba(0, 102, 204, 0.1); color: var(--ustp-blue); }
    .activity-system { background: rgba(158, 158, 158, 0.1); color: #9e9e9e; }
    .activity-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; }

    .activity-content {
      flex: 1;
    }

    .activity-text {
      font-size: 14px;
      margin-bottom: 4px;
    }

    .activity-time {
      font-size: 12px;
      color: #777;
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
      max-width: 800px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      max-height: 90vh;
      overflow-y: auto;
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

    /* View Details Modal Styles */
    .election-details {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    .detail-section {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 15px;
    }

    .detail-section h4 {
      color: var(--ustp-blue);
      margin-bottom: 10px;
      border-bottom: 1px solid #dee2e6;
      padding-bottom: 5px;
    }

    .detail-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .detail-label {
      font-weight: 600;
      color: var(--ustp-blue);
    }

    .detail-value {
      color: #333;
    }

    .candidate-list {
      margin-top: 10px;
    }

    .candidate-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #eee;
    }

    .candidate-item:last-child {
      border-bottom: none;
    }

    .vote-chart {
      margin-top: 10px;
      height: 10px;
      background: #e9ecef;
      border-radius: 5px;
      overflow: hidden;
    }

    .vote-fill {
      height: 100%;
      border-radius: 5px;
      transition: width 0.5s ease;
    }

    .issues-list {
      margin-top: 10px;
    }

    .issue-item {
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      border-radius: 4px;
      padding: 8px 12px;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .issue-item:last-child {
      margin-bottom: 0;
    }

    .timeline {
      margin-top: 15px;
    }

    .timeline-item {
      display: flex;
      margin-bottom: 10px;
      font-size: 14px;
    }

    .timeline-time {
      font-weight: 600;
      color: var(--ustp-blue);
      min-width: 80px;
    }

    .timeline-event {
      flex: 1;
      padding-left: 10px;
      border-left: 2px solid var(--ustp-blue);
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

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar { width: 70px; }
      .logo-container h2, .nav-item a { display: none; }
      .main-content { margin-left: 70px; }
      .menu-toggle { display: block; }
      .monitoring-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      .filter-box {
        width: 100%;
        justify-content: space-between;
      }
      .monitoring-boxes {
        grid-template-columns: 1fr;
      }
      .stats-overview {
        grid-template-columns: repeat(2, 1fr);
      }
      .election-details {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .stats-overview {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <!-- SIDEBAR - EXACTLY THE SAME AS OTHER PAGES -->
  <nav class="sidebar" id="sidebar">
    <div class="logo-container">
      <div class="logo"><img src="../assests/suffage.png" alt="Logo"></div>
    </div>

    <ul class="nav-menu">
      <li class="nav-item"><i class="fas fa-home"></i><a href="admin_dashboard.html">Dashboard</a></li>
      <li class="nav-item"><i class="fas fa-user-graduate"></i><a href="register-voters.php">Voters</a></li>
      <li class="nav-item"><i class="fas fa-user-tie"></i><a href="register-officers.php">Officers</a></li>
      <li class="nav-item"><i class="fas fa-user-tag"></i><a href="candidates.php">Candidates</a></li>
      <li class="nav-item"><i class="fas fa-check-circle"></i><a href="validate-elections.php">Elections</a></li>
      <li class="nav-item active"><i class="fas fa-chart-line"></i><a href="monitoring.php">Monitoring</a></li>
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
      <h1>Election Monitoring</h1>
      <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
    </div>

    <div class="content">
      <div class="monitoring-header">
        <h2 class="monitoring-title">Real-time Election Monitoring</h2>
        <div class="filter-box">
          <select class="filter-select" id="statusFilter">
            <option value="all">All Status</option>
            <option value="active">Active Only</option>
            <option value="upcoming">Upcoming</option>
            <option value="completed">Completed</option>
          </select>
          <select class="filter-select" id="organizationFilter">
            <option value="all">All Organizations</option>
            <option value="SOCE">SOCE</option>
            <option value="SBA">SBA</option>
            <option value="SAS">SAS</option>
            <option value="SNAHS">SNAHS</option>
            <option value="USG">USG</option>
          </select>
          <button class="refresh-btn" id="refreshBtn">
            <i class="fas fa-sync-alt"></i> Refresh
          </button>
        </div>
      </div>

      <!-- Stats Overview -->
      <div class="stats-overview">
        <div class="stat-card stat-1">
          <div class="stat-icon"><i class="fas fa-vote-yea"></i></div>
          <div class="stat-info">
            <h3 id="totalVotes">1,248</h3>
            <p>Total Votes Cast</p>
          </div>
        </div>
        <div class="stat-card stat-2">
          <div class="stat-icon"><i class="fas fa-users"></i></div>
          <div class="stat-info">
            <h3 id="activeVoters">892</h3>
            <p>Active Voters</p>
          </div>
        </div>
        <div class="stat-card stat-3">
          <div class="stat-icon"><i class="fas fa-clock"></i></div>
          <div class="stat-info">
            <h3 id="turnoutRate">68%</h3>
            <p>Voter Turnout</p>
          </div>
        </div>
        <div class="stat-card stat-4">
          <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
          <div class="stat-info">
            <h3 id="issuesCount">3</h3>
            <p>Active Issues</p>
          </div>
        </div>
      </div>

      <!-- Monitoring Boxes -->
      <div class="monitoring-boxes" id="monitoringBoxes">
        <!-- Monitoring boxes will be dynamically generated here -->
      </div>

      <!-- Real-time Activity Section -->
      <div class="activity-section">
        <div class="section-header">
          <h3 class="section-title">Real-time Activity</h3>
          <span class="status-badge status-active" id="activityStatus">Live</span>
        </div>
        <div class="activity-list" id="activityList">
          <!-- Activity items will be dynamically generated here -->
        </div>
      </div>
    </div>
  </div>

  <!-- View Details Modal -->
  <div class="modal" id="viewDetailsModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="electionDetailsTitle">Election Details</h2>
        <button class="close-modal" id="closeDetailsModal">&times;</button>
      </div>
      <div id="electionDetailsContent">
        <!-- Election details will be dynamically generated here -->
      </div>
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" id="closeDetailsBtn">Close</button>
        <button type="button" class="btn btn-primary" id="exportDetailsBtn">
          <i class="fas fa-download"></i> Export Report
        </button>
      </div>
    </div>
  </div>

  <!-- Toast notification -->
  <div class="toast" id="toast"></div>

  <script>
    // Monitoring data with detailed information
    let monitoringData = [
      {
        id: "1",
        title: "SOCE Officers Election 2024",
        organization: "SOCE",
        status: "active",
        voters: 125,
        voted: 89,
        turnout: 71,
        issues: 0,
        lastActivity: "2 minutes ago",
        color: "#003366",
        details: {
          startDate: "2024-04-15",
          endDate: "2024-04-17",
          positions: ["President", "Vice President", "Secretary", "Treasurer"],
          candidates: [
            { name: "John Smith", position: "President", votes: 45, color: "#003366" },
            { name: "Maria Garcia", position: "President", votes: 32, color: "#0066cc" },
            { name: "David Johnson", position: "President", votes: 12, color: "#4caf50" },
            { name: "Sarah Chen", position: "Vice President", votes: 52, color: "#ff9800" },
            { name: "Michael Brown", position: "Vice President", votes: 37, color: "#9c27b0" }
          ],
          timeline: [
            { time: "08:00 AM", event: "Election started" },
            { time: "10:30 AM", event: "Peak voting period" },
            { time: "12:00 PM", event: "System maintenance completed" },
            { time: "02:15 PM", event: "Voter verification updated" }
          ],
          issues: []
        }
      },
      {
        id: "2",
        title: "USG General Election 2024",
        organization: "USG",
        status: "upcoming",
        voters: 450,
        voted: 0,
        turnout: 0,
        issues: 1,
        lastActivity: "1 hour ago",
        color: "#0066cc",
        details: {
          startDate: "2024-04-20",
          endDate: "2024-04-22",
          positions: ["President", "Vice President", "Senators (5 positions)"],
          candidates: [
            { name: "Alex Rodriguez", position: "President", votes: 0, color: "#003366" },
            { name: "Lisa Wang", position: "President", votes: 0, color: "#0066cc" },
            { name: "James Wilson", position: "Vice President", votes: 0, color: "#4caf50" },
            { name: "Emily Davis", position: "Vice President", votes: 0, color: "#ff9800" }
          ],
          timeline: [
            { time: "Scheduled", event: "Election preparation" },
            { time: "Scheduled", event: "Candidate verification" },
            { time: "Scheduled", event: "Voter registration review" }
          ],
          issues: [
            "Pending candidate approval for 2 positions"
          ]
        }
      },
      {
        id: "3",
        title: "CACHE Publication Election",
        organization: "CACHE",
        status: "completed",
        voters: 45,
        voted: 38,
        turnout: 84,
        issues: 0,
        lastActivity: "2 days ago",
        color: "#9c27b0",
        details: {
          startDate: "2024-04-10",
          endDate: "2024-04-12",
          positions: ["Editor-in-Chief", "Managing Editor", "Content Editor"],
          candidates: [
            { name: "Rachel Green", position: "Editor-in-Chief", votes: 25, color: "#003366" },
            { name: "Thomas Lee", position: "Editor-in-Chief", votes: 13, color: "#0066cc" },
            { name: "Olivia Martinez", position: "Managing Editor", votes: 22, color: "#4caf50" },
            { name: "Daniel Kim", position: "Managing Editor", votes: 16, color: "#ff9800" }
          ],
          timeline: [
            { time: "04-10 09:00 AM", event: "Election started" },
            { time: "04-11 02:30 PM", event: "75% voter turnout reached" },
            { time: "04-12 05:00 PM", event: "Election concluded" },
            { time: "04-12 06:15 PM", event: "Results certified" }
          ],
          issues: []
        }
      },
      {
        id: "4",
        title: "SBA Department Election",
        organization: "SBA",
        status: "active",
        voters: 180,
        voted: 112,
        turnout: 62,
        issues: 2,
        lastActivity: "5 minutes ago",
        color: "#4caf50",
        details: {
          startDate: "2024-04-16",
          endDate: "2024-04-18",
          positions: ["Department Representative", "Academic Coordinator", "Event Coordinator"],
          candidates: [
            { name: "Kevin Patel", position: "Department Representative", votes: 68, color: "#003366" },
            { name: "Sophia Williams", position: "Department Representative", votes: 44, color: "#0066cc" },
            { name: "Brian Taylor", position: "Academic Coordinator", votes: 59, color: "#4caf50" },
            { name: "Amanda Clark", position: "Academic Coordinator", votes: 53, color: "#ff9800" }
          ],
          timeline: [
            { time: "08:00 AM", event: "Election started" },
            { time: "10:45 AM", event: "Technical issue resolved" },
            { time: "01:20 PM", event: "Voter assistance requested" },
            { time: "03:30 PM", event: "Security audit completed" }
          ],
          issues: [
            "Network connectivity issue in Building A",
            "2 voter verification delays"
          ]
        }
      }
    ];

    // Activity data
    let activityData = [
      {
        id: "1",
        type: "vote",
        text: "Juan Dela Cruz voted for President position",
        time: "2 minutes ago",
        election: "SOCE Officers Election 2024"
      },
      {
        id: "2",
        type: "user",
        text: "Maria Santos logged in to vote",
        time: "3 minutes ago",
        election: "SOCE Officers Election 2024"
      },
      {
        id: "3",
        type: "vote",
        text: "Carlos Lopez submitted ballot",
        time: "4 minutes ago",
        election: "SBA Department Election"
      },
      {
        id: "4",
        type: "system",
        text: "System backup completed successfully",
        time: "10 minutes ago",
        election: "All Elections"
      },
      {
        id: "5",
        type: "warning",
        text: "Unusual activity detected in USG election",
        time: "1 hour ago",
        election: "USG General Election 2024"
      },
      {
        id: "6",
        type: "vote",
        text: "Ana Gonzales cast her vote",
        time: "1 hour ago",
        election: "SOCE Officers Election 2024"
      }
    ];

    // DOM Elements
    const userProfile = document.getElementById('userProfile');
    const dropdown = document.getElementById('dropdown');
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const logoutBtn = document.getElementById('logoutBtn');
    const statusFilter = document.getElementById('statusFilter');
    const organizationFilter = document.getElementById('organizationFilter');
    const refreshBtn = document.getElementById('refreshBtn');
    const monitoringBoxes = document.getElementById('monitoringBoxes');
    const activityList = document.getElementById('activityList');
    const activityStatus = document.getElementById('activityStatus');
    const totalVotes = document.getElementById('totalVotes');
    const activeVoters = document.getElementById('activeVoters');
    const turnoutRate = document.getElementById('turnoutRate');
    const issuesCount = document.getElementById('issuesCount');
    const viewDetailsModal = document.getElementById('viewDetailsModal');
    const closeDetailsModal = document.getElementById('closeDetailsModal');
    const closeDetailsBtn = document.getElementById('closeDetailsBtn');
    const exportDetailsBtn = document.getElementById('exportDetailsBtn');
    const electionDetailsTitle = document.getElementById('electionDetailsTitle');
    const electionDetailsContent = document.getElementById('electionDetailsContent');
    const toast = document.getElementById('toast');

    // Current filters and selected election
    let currentStatusFilter = 'all';
    let currentOrganizationFilter = 'all';
    let currentElectionDetails = null;

    // Initialize monitoring page
    function initMonitoringPage() {
      updateStats();
      renderMonitoringBoxes();
      renderActivityList();
      setupEventListeners();
      startRealTimeUpdates();
    }

    // Update statistics
    function updateStats() {
      // Calculate totals from monitoring data
      const totalVotesCount = monitoringData.reduce((sum, election) => sum + election.voted, 0);
      const activeElections = monitoringData.filter(e => e.status === 'active').length;
      const totalIssues = monitoringData.reduce((sum, election) => sum + election.issues, 0);
      
      // Calculate overall turnout rate (average of active/completed elections)
      const activeCompletedElections = monitoringData.filter(e => e.status === 'active' || e.status === 'completed');
      const avgTurnout = activeCompletedElections.length > 0 
        ? Math.round(activeCompletedElections.reduce((sum, e) => sum + e.turnout, 0) / activeCompletedElections.length)
        : 0;
      
      totalVotes.textContent = totalVotesCount.toLocaleString();
      activeVoters.textContent = activeElections;
      turnoutRate.textContent = `${avgTurnout}%`;
      issuesCount.textContent = totalIssues;
    }

    // Render monitoring boxes
    function renderMonitoringBoxes() {
      monitoringBoxes.innerHTML = '';
      
      let filteredElections = monitoringData;
      
      // Apply status filter
      if (currentStatusFilter !== 'all') {
        filteredElections = filteredElections.filter(election => election.status === currentStatusFilter);
      }
      
      // Apply organization filter
      if (currentOrganizationFilter !== 'all') {
        filteredElections = filteredElections.filter(election => election.organization === currentOrganizationFilter);
      }
      
      if (filteredElections.length === 0) {
        monitoringBoxes.innerHTML = `
          <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
            <i class="fas fa-chart-line" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
            <h3 style="color: #666; margin-bottom: 10px;">No elections found</h3>
            <p style="color: #888;">Try changing your filters</p>
          </div>
        `;
        return;
      }
      
      filteredElections.forEach(election => {
        const monitoringBox = document.createElement('div');
        monitoringBox.className = 'monitoring-box';
        monitoringBox.setAttribute('data-election', election.id);
        
        // Determine status badge class
        let statusClass = '';
        let statusText = '';
        switch(election.status) {
          case 'active':
            statusClass = 'status-active';
            statusText = 'Active';
            break;
          case 'upcoming':
            statusClass = 'status-upcoming';
            statusText = 'Upcoming';
            break;
          case 'completed':
            statusClass = 'status-completed';
            statusText = 'Completed';
            break;
        }
        
        // Determine progress bar class
        let progressClass = '';
        switch(election.status) {
          case 'active':
            progressClass = 'progress-active';
            break;
          case 'upcoming':
            progressClass = 'progress-upcoming';
            break;
          case 'completed':
            progressClass = 'progress-completed';
            break;
        }
        
        monitoringBox.innerHTML = `
          <div class="monitoring-header-box" style="background-color: ${election.color}">
            <div class="monitoring-avatar" style="background-color: ${election.color}">
              <i class="fas fa-chart-bar"></i>
            </div>
            <div class="monitoring-info">
              <h3>${election.organization}</h3>
              <p>${election.title}</p>
            </div>
          </div>
          <div class="monitoring-stats">
            <div class="stat">
              <div class="stat-value">${election.voters}</div>
              <div class="stat-label">Voters</div>
            </div>
            <div class="stat">
              <div class="stat-value">${election.voted}</div>
              <div class="stat-label">Voted</div>
            </div>
            <div class="stat">
              <div class="stat-value">${election.turnout}%</div>
              <div class="stat-label">Turnout</div>
            </div>
          </div>
          <div class="monitoring-details">
            <div class="monitoring-detail">
              <span class="monitoring-detail-label">Status:</span>
              <span class="status-badge ${statusClass}">${statusText}</span>
            </div>
            <div class="monitoring-detail">
              <span class="monitoring-detail-label">Issues:</span>
              <span>${election.issues} ${election.issues === 1 ? 'issue' : 'issues'}</span>
            </div>
            <div class="monitoring-detail">
              <span class="monitoring-detail-label">Last Activity:</span>
              <span>${election.lastActivity}</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill ${progressClass}" style="width: ${election.turnout}%"></div>
            </div>
          </div>
          <div class="monitoring-actions">
            <button class="btn-view-monitoring view-details-btn" data-election="${election.id}">
              <i class="fas fa-chart-line"></i> View Details
            </button>
          </div>
        `;
        
        monitoringBoxes.appendChild(monitoringBox);
      });
      
      // Add event listeners to view details buttons
      document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', handleViewDetails);
      });

      // Add click event to entire monitoring box for viewing details
      document.querySelectorAll('.monitoring-box').forEach(box => {
        box.addEventListener('click', (e) => {
          // Don't trigger if clicking on buttons inside the box
          if (!e.target.closest('.view-details-btn')) {
            const electionId = box.getAttribute('data-election');
            handleViewDetails({ currentTarget: { getAttribute: () => electionId } });
          }
        });
      });
    }

    // Handle view details
    function handleViewDetails(e) {
      const electionId = e.currentTarget.getAttribute('data-election');
      const election = monitoringData.find(el => el.id === electionId);
      
      if (election) {
        currentElectionDetails = election;
        showElectionDetails(election);
      }
    }

    // Show election details in modal
    function showElectionDetails(election) {
      electionDetailsTitle.textContent = `${election.organization} - ${election.title}`;
      
      // Generate election details content
      const details = election.details;
      let detailsHTML = `
        <div class="election-details">
          <div class="detail-section">
            <h4>Election Information</h4>
            <div class="detail-item">
              <span class="detail-label">Status:</span>
              <span class="detail-value">
                <span class="status-badge ${getStatusClass(election.status)}">${getStatusText(election.status)}</span>
              </span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Start Date:</span>
              <span class="detail-value">${formatDate(details.startDate)}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">End Date:</span>
              <span class="detail-value">${formatDate(details.endDate)}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Total Voters:</span>
              <span class="detail-value">${election.voters}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Votes Cast:</span>
              <span class="detail-value">${election.voted}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Turnout Rate:</span>
              <span class="detail-value">${election.turnout}%</span>
            </div>
          </div>
          
          <div class="detail-section">
            <h4>Election Positions</h4>
            ${details.positions.map(position => `
              <div class="detail-item">
                <span class="detail-label">•</span>
                <span class="detail-value">${position}</span>
              </div>
            `).join('')}
          </div>
        </div>
      `;
      
      // Add candidate results if available
      if (election.status !== 'upcoming' && details.candidates.length > 0) {
        detailsHTML += `
          <div class="detail-section">
            <h4>Candidate Results</h4>
            ${groupCandidatesByPosition(details.candidates).map(group => `
              <div style="margin-bottom: 15px;">
                <h5 style="color: var(--ustp-blue); margin-bottom: 8px;">${group.position}</h5>
                ${group.candidates.map(candidate => `
                  <div class="candidate-item">
                    <span class="detail-label">${candidate.name}</span>
                    <span class="detail-value">${candidate.votes} votes</span>
                  </div>
                  ${election.status === 'completed' ? `
                    <div class="vote-chart">
                      <div class="vote-fill" style="width: ${(candidate.votes / Math.max(...group.candidates.map(c => c.votes)) * 100)}%; background-color: ${candidate.color};"></div>
                    </div>
                  ` : ''}
                `).join('')}
              </div>
            `).join('')}
          </div>
        `;
      }
      
      // Add issues if any
      if (details.issues.length > 0) {
        detailsHTML += `
          <div class="detail-section">
            <h4>Active Issues</h4>
            <div class="issues-list">
              ${details.issues.map(issue => `
                <div class="issue-item">
                  <i class="fas fa-exclamation-circle"></i> ${issue}
                </div>
              `).join('')}
            </div>
          </div>
        `;
      }
      
      // Add timeline
      detailsHTML += `
        <div class="detail-section">
          <h4>Election Timeline</h4>
          <div class="timeline">
            ${details.timeline.map(item => `
              <div class="timeline-item">
                <div class="timeline-time">${item.time}</div>
                <div class="timeline-event">${item.event}</div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
      
      electionDetailsContent.innerHTML = detailsHTML;
      viewDetailsModal.style.display = 'flex';
    }

    // Helper function to group candidates by position
    function groupCandidatesByPosition(candidates) {
      const groups = {};
      candidates.forEach(candidate => {
        if (!groups[candidate.position]) {
          groups[candidate.position] = [];
        }
        groups[candidate.position].push(candidate);
      });
      
      return Object.keys(groups).map(position => ({
        position,
        candidates: groups[position]
      }));
    }

    // Helper function to get status class
    function getStatusClass(status) {
      switch(status) {
        case 'active': return 'status-active';
        case 'upcoming': return 'status-upcoming';
        case 'completed': return 'status-completed';
        default: return 'status-upcoming';
      }
    }

    // Helper function to get status text
    function getStatusText(status) {
      switch(status) {
        case 'active': return 'Active';
        case 'upcoming': return 'Upcoming';
        case 'completed': return 'Completed';
        default: return 'Unknown';
      }
    }

    // Helper function to format date
    function formatDate(dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString(undefined, options);
    }

    // Render activity list
    function renderActivityList() {
      activityList.innerHTML = '';
      
      if (activityData.length === 0) {
        activityList.innerHTML = `
          <div class="empty-state" style="text-align: center; padding: 20px;">
            <i class="fas fa-info-circle" style="font-size: 24px; color: #ccc; margin-bottom: 10px;"></i>
            <p style="color: #888;">No recent activity</p>
          </div>
        `;
        return;
      }
      
      activityData.forEach(activity => {
        const activityItem = document.createElement('div');
        activityItem.className = 'activity-item';
        
        // Determine activity icon class
        let iconClass = '';
        let icon = '';
        switch(activity.type) {
          case 'vote':
            iconClass = 'activity-vote';
            icon = 'fa-vote-yea';
            break;
          case 'user':
            iconClass = 'activity-user';
            icon = 'fa-user';
            break;
          case 'system':
            iconClass = 'activity-system';
            icon = 'fa-cog';
            break;
          case 'warning':
            iconClass = 'activity-warning';
            icon = 'fa-exclamation-triangle';
            break;
        }
        
        activityItem.innerHTML = `
          <div class="activity-icon ${iconClass}">
            <i class="fas ${icon}"></i>
          </div>
          <div class="activity-content">
            <div class="activity-text">${activity.text}</div>
            <div class="activity-time">${activity.time} • ${activity.election}</div>
          </div>
        `;
        
        activityList.appendChild(activityItem);
      });
    }

    // Simulate real-time updates
    function startRealTimeUpdates() {
      // Update activity status
      setInterval(() => {
        activityStatus.textContent = 'Live';
        activityStatus.className = 'status-badge status-active';
      }, 30000);
      
      // Simulate new activity every 10-30 seconds
      setInterval(() => {
        simulateNewActivity();
      }, Math.random() * 20000 + 10000);
    }

    // Simulate new activity
    function simulateNewActivity() {
      const activities = [
        {
          type: 'vote',
          text: `Student ${Math.floor(Math.random() * 1000)} cast a vote`,
          election: 'SOCE Officers Election 2024'
        },
        {
          type: 'user',
          text: `New voter logged in to the system`,
          election: 'SBA Department Election'
        },
        {
          type: 'system',
          text: 'System health check completed',
          election: 'All Elections'
        }
      ];
      
      const randomActivity = activities[Math.floor(Math.random() * activities.length)];
      const newActivity = {
        id: Date.now().toString(),
        type: randomActivity.type,
        text: randomActivity.text,
        time: 'Just now',
        election: randomActivity.election
      };
      
      // Add to beginning of array
      activityData.unshift(newActivity);
      
      // Keep only last 10 activities
      if (activityData.length > 10) {
        activityData.pop();
      }
      
      // Update UI
      renderActivityList();
      
      // Also update a random election's stats
      const randomElectionIndex = Math.floor(Math.random() * monitoringData.length);
      if (monitoringData[randomElectionIndex].status === 'active') {
        monitoringData[randomElectionIndex].voted += 1;
        monitoringData[randomElectionIndex].turnout = Math.round(
          (monitoringData[randomElectionIndex].voted / monitoringData[randomElectionIndex].voters) * 100
        );
        monitoringData[randomElectionIndex].lastActivity = 'Just now';
        
        renderMonitoringBoxes();
        updateStats();
      }
    }

    // Show toast notification
    function showToast(message, type = 'info') {
      toast.textContent = message;
      toast.className = 'toast';
      
      if (type === 'success') {
        toast.classList.add('success');
      } else if (type === 'error') {
        toast.classList.add('error');
      }
      
      toast.classList.add('show');
      
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3000);
    }

    // Set up all event listeners
    function setupEventListeners() {
      // User dropdown
      userProfile.addEventListener('click', () => {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', (e) => {
        if (!userProfile.contains(e.target)) dropdown.style.display = 'none';
      });

      // Highlight active nav item
      document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', () => {
          document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
          item.classList.add('active');
        });
      });

      // Mobile sidebar toggle
      menuToggle.addEventListener('click', () => {
        if (sidebar.style.left === '0px' || sidebar.style.left === '') {
          sidebar.style.left = '-250px';
          mainContent.style.marginLeft = '0';
        } else {
          sidebar.style.left = '0px';
          mainContent.style.marginLeft = '250px';
        }
      });

      // Logout
      logoutBtn.addEventListener('click', () => {
        showToast('Logging out...', 'info');
        setTimeout(() => {
          alert('You have been logged out. In a real application, you would be redirected to the login page.');
        }, 1000);
      });

      // Filter functionality
      statusFilter.addEventListener('change', (e) => {
        currentStatusFilter = e.target.value;
        renderMonitoringBoxes();
      });

      organizationFilter.addEventListener('change', (e) => {
        currentOrganizationFilter = e.target.value;
        renderMonitoringBoxes();
      });

      // Refresh button
      refreshBtn.addEventListener('click', () => {
        showToast('Data refreshed successfully', 'success');
        // In a real application, this would fetch new data from the server
        renderMonitoringBoxes();
        renderActivityList();
        updateStats();
      });

      // Close details modal
      closeDetailsModal.addEventListener('click', () => {
        viewDetailsModal.style.display = 'none';
      });

      closeDetailsBtn.addEventListener('click', () => {
        viewDetailsModal.style.display = 'none';
      });

      // Export details
      exportDetailsBtn.addEventListener('click', () => {
        if (currentElectionDetails) {
          showToast(`Exporting ${currentElectionDetails.title} report...`, 'success');
          setTimeout(() => {
            showToast('Report exported successfully!', 'success');
          }, 1500);
        }
      });

      // Close modal when clicking outside
      window.addEventListener('click', (e) => {
        if (e.target === viewDetailsModal) {
          viewDetailsModal.style.display = 'none';
        }
      });
    }

    // Initialize the monitoring page when DOM is loaded
    document.addEventListener('DOMContentLoaded', initMonitoringPage);
  </script>
</body>
</html>