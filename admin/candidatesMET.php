<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eBOTO | MET Candidates</title>
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

    /* SIDEBAR - EXACTLY THE SAME AS VOTERS PAGE */
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
</head>
<body>

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
      <h1>Candidate Management - MET Department</h1>
      <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
    </div>

    <div class="content">
      <div class="department-header">
        <img src="met.jpg" class="department-logo" alt="MET Department Logo">
        <div class="department-info">
          <h2>Manufacturing Engineering Technology Department</h2>
          <p>Department of Manufacturing Engineering Technology</p>
        </div>
      </div>

      <div class="candidate-header">
        <h2 class="candidate-title">MET Department Candidates</h2>
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
  <div class="modal" id="addPartyModal">
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
          <input type="text" class="form-input" id="partySlogan" placeholder="e.g., Advancing Technology, Empowering Students" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="partyEstablished">Established Year</label>
          <input type="number" class="form-input" id="partyEstablished" placeholder="e.g., 2023" min="2000" max="2030" required>
        </div>
        <div class="form-group">
          <label class="form-label">Party Logo</label>
          <div class="file-upload-container">
            <label for="partyLogo" class="file-upload-label">
              <i class="fas fa-upload"></i> Choose Logo
            </label>
            <input type="file" id="partyLogo" class="file-upload-input" accept="image/*">
            <img id="partyLogoPreview" class="file-preview" alt="Logo Preview">
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
  <div class="modal" id="addCandidateModal">
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
            <option value="President">President</option>
            <option value="Vice President">Vice President</option>
            <option value="Secretary">Secretary</option>
            <option value="Treasurer">Treasurer</option>
            <option value="Auditor">Auditor</option>
            <option value="P.R.O.">P.R.O.</option>
            <option value="Representative">Representative</option>
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
            <img id="photoPreview" class="file-preview" alt="Photo Preview">
          </div>
        </div>
        
        <div class="form-group">
          <label class="form-label">Platform</label>
          <div id="addPlatformItems">
            <!-- Platform items will be dynamically added here -->
          </div>
          <button type="button" class="add-item-btn" id="addPlatformItem">
            <i class="fas fa-plus"></i> Add Platform Item
          </button>
        </div>
        
        <div class="form-group">
          <label class="form-label">Key Achievements</label>
          <div id="addAchievementItems">
            <!-- Achievement items will be dynamically added here -->
          </div>
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
  <div class="modal" id="editCandidateModal">
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
          <label class="form-label" for="editCandidateParty">Party</label>
          <select class="form-select" id="editCandidateParty" required>
            <option value="">Select Party</option>
            <!-- Options will be dynamically populated -->
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="editCandidatePosition">Position</label>
          <select class="form-select" id="editCandidatePosition" required>
            <option value="">Select Position</option>
            <option value="President">President</option>
            <option value="Vice President">Vice President</option>
            <option value="Secretary">Secretary</option>
            <option value="Treasurer">Treasurer</option>
            <option value="Auditor">Auditor</option>
            <option value="P.R.O.">P.R.O.</option>
            <option value="Representative">Representative</option>
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
            <img id="editPhotoPreview" class="file-preview" alt="Photo Preview">
          </div>
        </div>
        
        <div class="form-group">
          <label class="form-label">Platform</label>
          <div id="platformItems">
            <!-- Platform items will be dynamically added here -->
          </div>
          <button type="button" class="add-item-btn" id="addPlatformItemEdit">
            <i class="fas fa-plus"></i> Add Platform Item
          </button>
        </div>
        
        <div class="form-group">
          <label class="form-label">Key Achievements</label>
          <div id="achievementItems">
            <!-- Achievement items will be dynamically added here -->
          </div>
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
  <div class="modal confirmation-modal" id="confirmationModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Confirm Action</h2>
        <button class="close-modal" id="closeConfirmationModal">&times;</button>
      </div>
      <div class="confirmation-message" id="confirmationMessage">
        <!-- Message will be dynamically set -->
      </div>
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" id="cancelConfirmationBtn">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmActionBtn">Confirm</button>
      </div>
    </div>
  </div>

  <!-- Toast notification -->
  <div class="toast" id="toast"></div>

  <script>
    // Party and candidate data for MET department
    let partyData = [
      {
        id: "manufacturing-progress",
        name: "Manufacturing Progress Party",
        slogan: "Innovation in Production, Excellence in Education",
        logo: "manufacturing-progress-logo.jpg",
        candidatesCount: 6,
        established: 2023,
        department: "Manufacturing Engineering Technology",
        candidates: [
          {
            id: "2021-02123",
            name: "Robert Chen",
            position: "President",
            course: "BS Manufacturing Engineering",
            yearLevel: "4th Year",
            image: "robert-chen.jpg",
            platform: [
              "Upgrade manufacturing lab equipment",
              "Establish industry mentorship program",
              "Promote research in advanced manufacturing"
            ],
            achievements: [
              "President, Manufacturing Engineering Society (2024)",
              "Led automation project that improved efficiency by 30%",
              "Organized Manufacturing Innovation Expo 2024"
            ]
          },
          {
            id: "2021-02234",
            name: "Lisa Thompson",
            position: "Vice President",
            course: "BS Industrial Technology",
            yearLevel: "3rd Year",
            image: "lisa-thompson.jpg",
            platform: [
              "Enhance safety protocols in laboratories",
              "Create skill development workshops",
              "Improve industry-academe collaboration"
            ],
            achievements: [
              "Vice President, Industrial Technology Club (2024)",
              "Developed safety training program adopted department-wide",
              "Coordinated industry visit program"
            ]
          }
        ]
      },
      {
        id: "tech-builders",
        name: "Tech Builders Coalition",
        slogan: "Building the Future Through Technology",
        logo: "tech-builders-logo.jpg",
        candidatesCount: 5,
        established: 2024,
        department: "Manufacturing Engineering Technology",
        candidates: [
          {
            id: "2021-02345",
            name: "Daniel Kim",
            position: "President",
            course: "BS Mechanical Design",
            yearLevel: "3rd Year",
            image: "daniel-kim.jpg",
            platform: [
              "Implement 3D printing facility upgrades",
              "Promote CAD/CAM skills development",
              "Establish design competition series"
            ],
            achievements: [
              "President, Mechanical Design Society (2024)",
              "Won Regional Design Competition 2024",
              "Developed prototype that reduced production time by 25%"
            ]
          }
        ]
      }
    ];

    // DOM Elements
    const userProfile = document.getElementById('userProfile');
    const dropdown = document.getElementById('dropdown');
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const logoutBtn = document.getElementById('logoutBtn');
    const searchInput = document.getElementById('searchInput');
    const partyContainer = document.getElementById('partyContainer');
    const addCandidateBtn = document.getElementById('addCandidateBtn');
    const addPartyBtn = document.getElementById('addPartyBtn');
    const addCandidateModal = document.getElementById('addCandidateModal');
    const addPartyModal = document.getElementById('addPartyModal');
    const closeCandidateModal = document.getElementById('closeCandidateModal');
    const closePartyModal = document.getElementById('closePartyModal');
    const cancelCandidateBtn = document.getElementById('cancelCandidateBtn');
    const cancelPartyBtn = document.getElementById('cancelPartyBtn');
    const candidateForm = document.getElementById('candidateForm');
    const partyForm = document.getElementById('partyForm');
    const candidatePartySelect = document.getElementById('candidateParty');
    const candidatePhoto = document.getElementById('candidatePhoto');
    const photoPreview = document.getElementById('photoPreview');
    const partyLogo = document.getElementById('partyLogo');
    const partyLogoPreview = document.getElementById('partyLogoPreview');
    const editCandidateModal = document.getElementById('editCandidateModal');
    const closeEditCandidateModal = document.getElementById('closeEditCandidateModal');
    const cancelEditCandidateBtn = document.getElementById('cancelEditCandidateBtn');
    const editCandidateForm = document.getElementById('editCandidateForm');
    const editCandidatePartySelect = document.getElementById('editCandidateParty');
    const editCandidatePhoto = document.getElementById('editCandidatePhoto');
    const editPhotoPreview = document.getElementById('editPhotoPreview');
    const addPlatformItems = document.getElementById('addPlatformItems');
    const addAchievementItems = document.getElementById('addAchievementItems');
    const platformItems = document.getElementById('platformItems');
    const achievementItems = document.getElementById('achievementItems');
    const addPlatformItem = document.getElementById('addPlatformItem');
    const addAchievementItem = document.getElementById('addAchievementItem');
    const addPlatformItemEdit = document.getElementById('addPlatformItemEdit');
    const addAchievementItemEdit = document.getElementById('addAchievementItemEdit');
    const confirmationModal = document.getElementById('confirmationModal');
    const closeConfirmationModal = document.getElementById('closeConfirmationModal');
    const cancelConfirmationBtn = document.getElementById('cancelConfirmationBtn');
    const confirmActionBtn = document.getElementById('confirmActionBtn');
    const confirmationMessage = document.getElementById('confirmationMessage');
    const toast = document.getElementById('toast');

    // Variables
    let currentSearch = '';
    let currentEditingCandidate = null;
    let uploadedPhoto = null;
    let uploadedEditPhoto = null;
    let uploadedPartyLogo = null;
    let pendingAction = null;
    let pendingCandidateId = null;

    // Initialize candidate page
    function initCandidatePage() {
      renderPartyCards();
      populatePartySelects();
      setupEventListeners();
    }

    // Populate party selects in forms
    function populatePartySelects() {
      // Clear existing options
      candidatePartySelect.innerHTML = '<option value="">Select Party</option>';
      editCandidatePartySelect.innerHTML = '<option value="">Select Party</option>';
      
      // Add party options
      partyData.forEach(party => {
        candidatePartySelect.innerHTML += `<option value="${party.id}">${party.name}</option>`;
        editCandidatePartySelect.innerHTML += `<option value="${party.id}">${party.name}</option>`;
      });
    }

    // Render party cards
    function renderPartyCards() {
      partyContainer.innerHTML = '';
      
      partyData.forEach(party => {
        // Filter candidates if search is active
        let filteredCandidates = party.candidates;
        if (currentSearch) {
          const searchTerm = currentSearch.toLowerCase();
          filteredCandidates = party.candidates.filter(candidate => 
            candidate.name.toLowerCase().includes(searchTerm) || 
            candidate.position.toLowerCase().includes(searchTerm) ||
            candidate.course.toLowerCase().includes(searchTerm)
          );
        }
        
        // Skip party if no candidates match search and search is active
        if (currentSearch && filteredCandidates.length === 0) {
          return;
        }
        
        const partyCard = document.createElement('div');
        partyCard.className = 'party-card';
        
        partyCard.innerHTML = `
          <div class="party-header">
            <img src="${party.logo}" class="party-logo" alt="${party.name} Logo">
            <div class="party-info">
              <h2>${party.name}</h2>
              <p>"${party.slogan}"</p>
              <div class="party-stats">
                <div class="party-stat">
                  <div class="party-stat-value">${party.candidatesCount} Candidates</div>
                  <div class="party-stat-label">Total</div>
                </div>
                <div class="party-stat">
                  <div class="party-stat-value">Est. ${party.established}</div>
                  <div class="party-stat-label">Established</div>
                </div>
              </div>
              <div class="party-tag">${party.department}</div>
            </div>
          </div>
          <div class="candidates-grid">
            ${filteredCandidates.map(candidate => `
              <div class="candidate-card">
                <div class="candidate-actions">
                  <button class="btn-action btn-edit" data-id="${candidate.id}">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn-action btn-delete" data-id="${candidate.id}">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
                <div class="candidate-header-card">
                  <img src="${candidate.image}" class="candidate-avatar" alt="${candidate.name}">
                  <div class="candidate-basic-info">
                    <h3>${candidate.name}</h3>
                    <p>${candidate.course}</p>
                    <div class="candidate-position">${candidate.position}</div>
                  </div>
                </div>
                <div class="candidate-details">
                  <div class="candidate-section">
                    <h4>Education</h4>
                    <div class="candidate-info-item">
                      <div class="info-label">Course:</div>
                      <div class="info-value">${candidate.course}</div>
                    </div>
                    <div class="candidate-info-item">
                      <div class="info-label">Year Level:</div>
                      <div class="info-value">${candidate.yearLevel}</div>
                    </div>
                  </div>
                  <div class="candidate-section">
                    <h4>Platform</h4>
                    <ul class="platform-list">
                      ${candidate.platform.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                  </div>
                  <div class="candidate-section">
                    <h4>Key Achievements</h4>
                    <ul class="achievement-list">
                      ${candidate.achievements.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                  </div>
                </div>
              </div>
            `).join('')}
          </div>
        `;
        
        partyContainer.appendChild(partyCard);
      });
      
      // Show message if no parties/candidates found
      if (partyContainer.children.length === 0) {
        partyContainer.innerHTML = `
          <div style="text-align: center; padding: 50px; background: white; border-radius: 12px;">
            <i class="fas fa-user-tag" style="font-size: 60px; color: #ccc; margin-bottom: 20px;"></i>
            <h3>No candidates found</h3>
            <p>Try changing your search term or add a new candidate</p>
          </div>
        `;
      }
      
      // Add event listeners to action buttons
      document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', (e) => {
          const candidateId = e.currentTarget.getAttribute('data-id');
          openEditCandidateModal(candidateId);
        });
      });
      
      document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', (e) => {
          const candidateId = e.currentTarget.getAttribute('data-id');
          showConfirmation(
            'Delete Candidate',
            `Are you sure you want to delete this candidate? This action cannot be undone.`,
            () => deleteCandidate(candidateId)
          );
        });
      });
    }

    // Open edit candidate modal
    function openEditCandidateModal(candidateId) {
      // Find the candidate
      let candidate = null;
      let partyId = null;
      
      for (const party of partyData) {
        const foundCandidate = party.candidates.find(c => c.id === candidateId);
        if (foundCandidate) {
          candidate = foundCandidate;
          partyId = party.id;
          break;
        }
      }
      
      if (candidate) {
        currentEditingCandidate = candidate;
        
        // Fill the form with candidate data
        document.getElementById('editCandidateId').value = candidate.id;
        document.getElementById('editCandidateName').value = candidate.name;
        document.getElementById('editCandidateParty').value = partyId;
        document.getElementById('editCandidatePosition').value = candidate.position;
        document.getElementById('editCandidateYear').value = candidate.yearLevel;
        
        // Show current photo
        editPhotoPreview.src = candidate.image;
        editPhotoPreview.style.display = 'block';
        
        // Populate platform items
        platformItems.innerHTML = '';
        candidate.platform.forEach((item, index) => {
          addPlatformItemToForm(item, index, platformItems);
        });
        
        // Populate achievement items
        achievementItems.innerHTML = '';
        candidate.achievements.forEach((item, index) => {
          addAchievementItemToForm(item, index, achievementItems);
        });
        
        // Open the modal
        editCandidateModal.style.display = 'flex';
      }
    }

    // Add platform item to form
    function addPlatformItemToForm(value = '', index = null, container) {
      const itemId = index !== null ? index : Date.now();
      const itemDiv = document.createElement('div');
      itemDiv.className = 'list-item';
      itemDiv.innerHTML = `
        <input type="text" class="form-input list-item-input" value="${value}" placeholder="Enter platform item">
        <button type="button" class="remove-item" data-id="${itemId}">
          <i class="fas fa-times"></i>
        </button>
      `;
      container.appendChild(itemDiv);
      
      // Add event listener to remove button
      itemDiv.querySelector('.remove-item').addEventListener('click', function() {
        container.removeChild(itemDiv);
      });
    }

    // Add achievement item to form
    function addAchievementItemToForm(value = '', index = null, container) {
      const itemId = index !== null ? index : Date.now();
      const itemDiv = document.createElement('div');
      itemDiv.className = 'list-item';
      itemDiv.innerHTML = `
        <input type="text" class="form-input list-item-input" value="${value}" placeholder="Enter achievement">
        <button type="button" class="remove-item" data-id="${itemId}">
          <i class="fas fa-times"></i>
        </button>
      `;
      container.appendChild(itemDiv);
      
      // Add event listener to remove button
      itemDiv.querySelector('.remove-item').addEventListener('click', function() {
        container.removeChild(itemDiv);
      });
    }

    // Add new party
    function addParty(partyData) {
      // Generate a unique ID
      const id = partyData.name.toLowerCase().replace(/\s+/g, '-');
      
      // Determine department based on party name
      const department = partyData.name.includes('SOCE') ? 'Computer Engineering' : 
                        partyData.name.includes('Tech') ? 'Multi-Department' : 'General';
      
      // Add the new party to the data
      partyData.push({
        id: id,
        name: partyData.name,
        slogan: partyData.slogan,
        department: department,
        established: partyData.established,
        logo: uploadedPartyLogo || "default-party-logo.jpg",
        candidatesCount: 0,
        candidates: []
      });
      
      // Re-render the party cards and update selects
      renderPartyCards();
      populatePartySelects();
      
      // Reset uploaded logo
      uploadedPartyLogo = null;
      
      // Show success message
      showToast(`Party "${partyData.name}" added successfully!`, 'success');
    }

    // Add new candidate
    function addCandidate(candidateData) {
      // Find the party
      const party = partyData.find(p => p.id === candidateData.party);
      
      if (party) {
        // Generate a course based on party
        const course = party.id === 'soce' ? 'BS Computer Engineering' : 
                      party.id === 'tech' ? 'BS Information Technology' : 'BS Computer Science';
        
        // Get platform and achievement values
        const platformInputs = addPlatformItems.querySelectorAll('.list-item-input');
        const achievementInputs = addAchievementItems.querySelectorAll('.list-item-input');
        
        const platform = Array.from(platformInputs).map(input => input.value).filter(value => value.trim() !== '');
        const achievements = Array.from(achievementInputs).map(input => input.value).filter(value => value.trim() !== '');
        
        // Add the new candidate to the party
        party.candidates.push({
          id: candidateData.id,
          name: candidateData.name,
          position: candidateData.position,
          course: course,
          yearLevel: candidateData.yearLevel,
          image: uploadedPhoto || "default-avatar.jpg",
          platform: platform.length > 0 ? platform : ["Platform details to be added"],
          achievements: achievements.length > 0 ? achievements : ["Achievements to be added"]
        });
        
        // Update party candidate count
        party.candidatesCount = party.candidates.length;
        
        // Re-render the party cards
        renderPartyCards();
        
        // Reset uploaded photo
        uploadedPhoto = null;
        
        // Show success message
        showToast(`Candidate "${candidateData.name}" added successfully!`, 'success');
      }
    }

    // Update candidate
    function updateCandidate(candidateData) {
      if (!currentEditingCandidate) return;
      
      // Get platform and achievement values
      const platformInputs = platformItems.querySelectorAll('.list-item-input');
      const achievementInputs = achievementItems.querySelectorAll('.list-item-input');
      
      const platform = Array.from(platformInputs).map(input => input.value).filter(value => value.trim() !== '');
      const achievements = Array.from(achievementInputs).map(input => input.value).filter(value => value.trim() !== '');
      
      // Find the candidate in the data
      for (const party of partyData) {
        const candidateIndex = party.candidates.findIndex(c => c.id === currentEditingCandidate.id);
        if (candidateIndex !== -1) {
          // If party changed, move candidate to new party
          if (party.id !== candidateData.party) {
            // Remove from current party
            const candidate = party.candidates.splice(candidateIndex, 1)[0];
            party.candidatesCount = party.candidates.length;
            
            // Add to new party
            const newParty = partyData.find(p => p.id === candidateData.party);
            if (newParty) {
              // Generate a course based on new party
              const course = newParty.id === 'soce' ? 'BS Computer Engineering' : 
                            newParty.id === 'tech' ? 'BS Information Technology' : 'BS Computer Science';
              
              newParty.candidates.push({
                ...candidate,
                id: candidateData.id,
                name: candidateData.name,
                position: candidateData.position,
                course: course,
                yearLevel: candidateData.yearLevel,
                image: uploadedEditPhoto || candidate.image,
                platform: platform.length > 0 ? platform : candidate.platform,
                achievements: achievements.length > 0 ? achievements : candidate.achievements
              });
              
              newParty.candidatesCount = newParty.candidates.length;
            }
          } else {
            // Update candidate in current party
            party.candidates[candidateIndex] = {
              ...party.candidates[candidateIndex],
              id: candidateData.id,
              name: candidateData.name,
              position: candidateData.position,
              yearLevel: candidateData.yearLevel,
              image: uploadedEditPhoto || currentEditingCandidate.image,
              platform: platform.length > 0 ? platform : currentEditingCandidate.platform,
              achievements: achievements.length > 0 ? achievements : currentEditingCandidate.achievements
            };
          }
          
          break;
        }
      }
      
      // Re-render the party cards
      renderPartyCards();
      
      // Reset uploaded photo and editing candidate
      uploadedEditPhoto = null;
      currentEditingCandidate = null;
      
      // Show success message
      showToast(`Candidate "${candidateData.name}" updated successfully!`, 'success');
    }

    // Delete candidate
    function deleteCandidate(candidateId) {
      // Find the candidate
      let candidate = null;
      let party = null;
      
      for (const p of partyData) {
        const foundCandidate = p.candidates.find(c => c.id === candidateId);
        if (foundCandidate) {
          candidate = foundCandidate;
          party = p;
          break;
        }
      }
      
      if (candidate && party) {
        // Remove the candidate from the party
        party.candidates = party.candidates.filter(c => c.id !== candidateId);
        
        // Update party candidate count
        party.candidatesCount = party.candidates.length;
        
        // Re-render the party cards
        renderPartyCards();
        
        // Show success message
        showToast(`Candidate "${candidate.name}" deleted successfully!`, 'success');
      }
    }

    // Show confirmation dialog
    function showConfirmation(title, message, confirmCallback) {
      confirmationMessage.textContent = message;
      pendingAction = confirmCallback;
      confirmationModal.style.display = 'flex';
    }

    // Handle file upload
    function handlePhotoUpload(event, isEdit = false) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          if (isEdit) {
            editPhotoPreview.src = e.target.result;
            editPhotoPreview.style.display = 'block';
            uploadedEditPhoto = e.target.result;
          } else {
            photoPreview.src = e.target.result;
            photoPreview.style.display = 'block';
            uploadedPhoto = e.target.result;
          }
        };
        reader.readAsDataURL(file);
      }
    }

    // Handle party logo upload
    function handlePartyLogoUpload(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          partyLogoPreview.src = e.target.result;
          partyLogoPreview.style.display = 'block';
          uploadedPartyLogo = e.target.result;
        };
        reader.readAsDataURL(file);
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
        // In a real application, you would redirect to login page
      });

      // Search functionality
      searchInput.addEventListener('input', (e) => {
        currentSearch = e.target.value;
        renderPartyCards();
      });

      // Add party modal
      addPartyBtn.addEventListener('click', () => {
        addPartyModal.style.display = 'flex';
      });

      // Close party modal
      closePartyModal.addEventListener('click', () => {
        addPartyModal.style.display = 'none';
        partyForm.reset();
        partyLogoPreview.style.display = 'none';
        uploadedPartyLogo = null;
      });

      cancelPartyBtn.addEventListener('click', () => {
        addPartyModal.style.display = 'none';
        partyForm.reset();
        partyLogoPreview.style.display = 'none';
        uploadedPartyLogo = null;
      });

      // Add candidate modal
      addCandidateBtn.addEventListener('click', () => {
        addCandidateModal.style.display = 'flex';
      });

      // Close candidate modal
      closeCandidateModal.addEventListener('click', () => {
        addCandidateModal.style.display = 'none';
        candidateForm.reset();
        photoPreview.style.display = 'none';
        uploadedPhoto = null;
        addPlatformItems.innerHTML = '';
        addAchievementItems.innerHTML = '';
      });

      cancelCandidateBtn.addEventListener('click', () => {
        addCandidateModal.style.display = 'none';
        candidateForm.reset();
        photoPreview.style.display = 'none';
        uploadedPhoto = null;
        addPlatformItems.innerHTML = '';
        addAchievementItems.innerHTML = '';
      });

      // Close edit candidate modal
      closeEditCandidateModal.addEventListener('click', () => {
        editCandidateModal.style.display = 'none';
        editCandidateForm.reset();
        editPhotoPreview.style.display = 'none';
        uploadedEditPhoto = null;
        currentEditingCandidate = null;
        platformItems.innerHTML = '';
        achievementItems.innerHTML = '';
      });

      cancelEditCandidateBtn.addEventListener('click', () => {
        editCandidateModal.style.display = 'none';
        editCandidateForm.reset();
        editPhotoPreview.style.display = 'none';
        uploadedEditPhoto = null;
        currentEditingCandidate = null;
        platformItems.innerHTML = '';
        achievementItems.innerHTML = '';
      });

      // Close confirmation modal
      closeConfirmationModal.addEventListener('click', () => {
        confirmationModal.style.display = 'none';
        pendingAction = null;
      });

      cancelConfirmationBtn.addEventListener('click', () => {
        confirmationModal.style.display = 'none';
        pendingAction = null;
      });

      // Confirm action
      confirmActionBtn.addEventListener('click', () => {
        if (pendingAction) {
          pendingAction();
        }
        confirmationModal.style.display = 'none';
        pendingAction = null;
      });

      // Close modals when clicking outside
      window.addEventListener('click', (e) => {
        if (e.target === addPartyModal) {
          addPartyModal.style.display = 'none';
          partyForm.reset();
          partyLogoPreview.style.display = 'none';
          uploadedPartyLogo = null;
        }
        
        if (e.target === addCandidateModal) {
          addCandidateModal.style.display = 'none';
          candidateForm.reset();
          photoPreview.style.display = 'none';
          uploadedPhoto = null;
          addPlatformItems.innerHTML = '';
          addAchievementItems.innerHTML = '';
        }
        
        if (e.target === editCandidateModal) {
          editCandidateModal.style.display = 'none';
          editCandidateForm.reset();
          editPhotoPreview.style.display = 'none';
          uploadedEditPhoto = null;
          currentEditingCandidate = null;
          platformItems.innerHTML = '';
          achievementItems.innerHTML = '';
        }
        
        if (e.target === confirmationModal) {
          confirmationModal.style.display = 'none';
          pendingAction = null;
        }
      });

      // File upload handlers
      candidatePhoto.addEventListener('change', (e) => handlePhotoUpload(e, false));
      editCandidatePhoto.addEventListener('change', (e) => handlePhotoUpload(e, true));
      partyLogo.addEventListener('change', handlePartyLogoUpload);

      // Add platform and achievement items
      addPlatformItem.addEventListener('click', () => addPlatformItemToForm('', null, addPlatformItems));
      addAchievementItem.addEventListener('click', () => addAchievementItemToForm('', null, addAchievementItems));
      addPlatformItemEdit.addEventListener('click', () => addPlatformItemToForm('', null, platformItems));
      addAchievementItemEdit.addEventListener('click', () => addAchievementItemToForm('', null, achievementItems));

      // Party form submission
      partyForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const partyData = {
          name: document.getElementById('partyName').value,
          slogan: document.getElementById('partySlogan').value,
          established: parseInt(document.getElementById('partyEstablished').value)
        };
        
        addParty(partyData);
        addPartyModal.style.display = 'none';
        partyForm.reset();
        partyLogoPreview.style.display = 'none';
      });

      // Candidate form submission
      candidateForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const candidateData = {
          id: document.getElementById('candidateId').value,
          name: document.getElementById('candidateName').value,
          party: document.getElementById('candidateParty').value,
          position: document.getElementById('candidatePosition').value,
          yearLevel: document.getElementById('candidateYear').value
        };
        
        addCandidate(candidateData);
        addCandidateModal.style.display = 'none';
        candidateForm.reset();
        photoPreview.style.display = 'none';
        addPlatformItems.innerHTML = '';
        addAchievementItems.innerHTML = '';
      });

      // Edit candidate form submission
      editCandidateForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const candidateData = {
          id: document.getElementById('editCandidateId').value,
          name: document.getElementById('editCandidateName').value,
          party: document.getElementById('editCandidateParty').value,
          position: document.getElementById('editCandidatePosition').value,
          yearLevel: document.getElementById('editCandidateYear').value
        };
        
        updateCandidate(candidateData);
        editCandidateModal.style.display = 'none';
        editCandidateForm.reset();
        editPhotoPreview.style.display = 'none';
        platformItems.innerHTML = '';
        achievementItems.innerHTML = '';
      });
    }

    // Initialize the candidate page when DOM is loaded
    document.addEventListener('DOMContentLoaded', initCandidatePage);
  </script>
</body>
</html>