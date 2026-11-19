<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eBOTO | Election Management</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <!-- SIDEBAR - EXACTLY THE SAME AS VOTERS PAGE -->
  <nav class="sidebar" id="sidebar">
    <div class="logo-container">
      <div class="logo"><img src="../assests/suffage.png" alt="Logo"></div>
    </div>

    <ul class="nav-menu">
      <li class="nav-item"><i class="fas fa-home"></i><a href="admin_dashboard.html">Dashboard</a></li>
      <li class="nav-item"><i class="fas fa-user-graduate"></i><a href="register-voters.php">Voters</a></li>

      <li class="nav-item"><i class="fas fa-user-tag"></i><a href="candidates.php">Candidates</a></li>
      <li class="nav-item active"><i class="fas fa-check-circle"></i><a href="validate-elections.php">Elections</a></li>

      <li class="nav-item"><i class="fas fa-cog"></i><a href="settings.php">Settings</a></li>
    </ul>

    <!-- user-profile integrated like dashboard reference -->
    <div class="user-profile" id="userProfile" style="cursor:pointer">
      <img id="adminAvatar" src="../assests/default-avatar.jpg" class="user-avatar" alt="Admin Avatar" width="56" height="56">
      <div class="user-info">
        <h4 id="adminName">Administrator</h4>
        <p id="adminRole">Administration</p>
      </div>
      <div class="user-dropdown" id="dropdown" style="display:none;">
        <a href="../login.html" id="logoutBtn">Logout</a>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <div class="main-content" id="mainContent">
    <div class="header">
      <h1>Election Management</h1>
      <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
    </div>

    <div class="content">
      <div class="election-header">
        <h2 class="election-title">Manage Elections</h2>
        <div class="search-box">
          <input type="text" class="search-input" placeholder="Search elections..." id="searchInput">
          <button class="search-btn"><i class="fas fa-search"></i></button>
          <button class="add-election-btn" id="addElectionBtn">
            <i class="fas fa-plus"></i> Create Election
          </button>
        </div>
      </div>

      <!-- Election Boxes -->
      <div class="election-boxes" id="electionBoxes">
        <!-- Election boxes will be dynamically generated here -->
      </div>
    </div>
  </div>

  <!-- Create Election Modal -->
  <div class="modal" id="createElectionModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Create New Election</h2>
        <button class="close-modal" id="closeElectionModal">&times;</button>
      </div>
      <form id="electionForm">
        <div class="form-group">
          <label class="form-label" for="electionTitle">Election Title</label>
          <input type="text" class="form-input" id="electionTitle" placeholder="e.g., SOCE Officers Election 2024" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="electionOrganization">Organization</label>
          <select class="form-select" id="electionOrganization" required>
            <option value="">Select Organization</option>
            <option value="IT">Information Technology</option>
            <option value="ESM">Energy Solution Management</option>
            <option value="MET">Manufacturing Engineering Technology</option>
            <option value="TCM">Technology Communication Management</option>
            <option value="NAME">Naval Architect Marine Engineering</option>
            <option value="USG">University Student Government</option>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="startDate">Start Date</label>
            <input type="datetime-local" class="form-input" id="startDate" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="endDate">End Date</label>
            <input type="datetime-local" class="form-input" id="endDate" required>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="electionDescription">Description</label>
          <textarea class="form-input" id="electionDescription" rows="3" placeholder="Describe the purpose and scope of this election"></textarea>
        </div>
        <div class="form-group">
          <label class="form-label" for="electionStatus">Status</label>
          <select class="form-select" id="electionStatus" required>
            <option value="draft">Draft</option>
            <option value="upcoming">Upcoming</option>
            <option value="active">Active</option>
            <option value="completed">Completed</option>
          </select>
        </div>
        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelElectionBtn">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Election</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Action Confirmation Modal -->
  <div class="modal" id="actionModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="actionModalTitle">Confirm Action</h2>
        <button class="close-modal" id="closeActionModal">&times;</button>
      </div>
      <div id="actionModalContent">
        <!-- Content will be dynamically set -->
      </div>
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" id="cancelActionBtn">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmActionBtn">Confirm</button>
      </div>
    </div>
  </div>

  <!-- Toast notification -->
  <div class="toast" id="toast"></div>

  <script>
    // Election data (unchanged)
    let electionData = [
      {
        id: "1",
        title: "IT Officers Election 2024",
        organization: "IT",
        description: "Election for IT Student Council Officers",
        startDate: "2024-03-15T08:00:00",
        endDate: "2024-03-17T17:00:00",
        status: "active",
        voters: 125,
        candidates: 24,
        voted: 89,
        color: "#003366",
        link: "elecIT.php"
      },
      {
        id: "2",
        title: "USG General Election 2024",
        organization: "USG",
        description: "University-wide Student Government Election",
        startDate: "2024-04-01T08:00:00",
        endDate: "2024-04-03T17:00:00",
        status: "upcoming",
        voters: 450,
        candidates: 35,
        voted: 0,
        color: "#0066cc",
        link: "elecUSG.php"
      },
      {
        id: "3",
        title: "Manufacturing Engineering Technology",
        organization: "MET",
        description: "Election for MET Officers",
        startDate: "2024-02-10T08:00:00",
        endDate: "2024-02-12T17:00:00",
        status: "completed",
        voters: 45,
        candidates: 8,
        voted: 38,
        color: "#9c27b0",
        link: "elecMET.php"
      },
      {
        id: "4",
        title: "Naval Architect Marine Engineering",
        organization: "NAME",
        description: "Election for NAME Department Representatives",
        startDate: "2024-03-20T08:00:00",
        endDate: "2024-03-22T17:00:00",
        status: "upcoming",
        voters: 180,
        candidates: 15,
        voted: 0,
        color: "#4caf50",
        link: "elecNAME.php"
      },
      {
        id: "5",
        title: "Technology Communication Management",
        organization: "TCM",
        description: "Election for TCM Officers",
        startDate: "2024-01-15T08:00:00",
        endDate: "2024-01-17T17:00:00",
        status: "completed",
        voters: 60,
        candidates: 6,
        voted: 52,
        color: "#ff9800",
        link: "elecTCM.php"
      },
      {
        id: "6",
        title: "Energy Solution Management",
        organization: "ESM",
        description: "Election for ESM Department Representatives",
        startDate: "2024-05-01T08:00:00",
        endDate: "2024-05-03T17:00:00",
        status: "draft",
        voters: 95,
        candidates: 12,
        voted: 0,
        color: "#f44336",
        link: "elecESM.php"
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
    const electionBoxes = document.getElementById('electionBoxes');
    const addElectionBtn = document.getElementById('addElectionBtn');
    const createElectionModal = document.getElementById('createElectionModal');
    const closeElectionModal = document.getElementById('closeElectionModal');
    const cancelElectionBtn = document.getElementById('cancelElectionBtn');
    const electionForm = document.getElementById('electionForm');
    const toast = document.getElementById('toast');
    const actionModal = document.getElementById('actionModal');
    const actionModalTitle = document.getElementById('actionModalTitle');
    const actionModalContent = document.getElementById('actionModalContent');
    const closeActionModal = document.getElementById('closeActionModal');
    const cancelActionBtn = document.getElementById('cancelActionBtn');
    const confirmActionBtn = document.getElementById('confirmActionBtn');

    // Current search filter and action state
    let currentSearch = '';
    let currentAction = null;
    let currentElectionId = null;

    // Initialize election management page
    function initElectionManagement() {
      renderElectionBoxes();
      setupEventListeners();
    }

    // Render election boxes
    function renderElectionBoxes() {
      electionBoxes.innerHTML = '';
      
      let filteredElections = electionData;
      
      // Apply search filter
      if (currentSearch) {
        const searchTerm = currentSearch.toLowerCase();
        filteredElections = electionData.filter(election => 
          election.title.toLowerCase().includes(searchTerm) || 
          election.organization.toLowerCase().includes(searchTerm) ||
          election.description.toLowerCase().includes(searchTerm)
        );
      }
      
      if (filteredElections.length === 0) {
        electionBoxes.innerHTML = `
          <div class="empty-state">
            <i class="fas fa-vote-yea"></i>
            <h3>No elections found</h3>
            <p>Try changing your search term or create a new election</p>
          </div>
        `;
        return;
      }
      
      filteredElections.forEach(election => {
        const electionBox = document.createElement('div');
        electionBox.className = 'election-box';
        electionBox.setAttribute('data-election', election.id);
        
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
          case 'draft':
            statusClass = 'status-draft';
            statusText = 'Draft';
            break;
        }
        
        // Format dates
        const startDate = new Date(election.startDate);
        const endDate = new Date(election.endDate);
        const formattedStartDate = startDate.toLocaleDateString() + ' ' + startDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        const formattedEndDate = endDate.toLocaleDateString() + ' ' + endDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        
        // Calculate percentage voted
        const votedPercentage = election.voters > 0 ? Math.round((election.voted / election.voters) * 100) : 0;
        
        electionBox.innerHTML = `
          <div class="election-header-box" style="background-color: ${election.color}">
            <div class="election-avatar" style="background-color: ${election.color}">
              <i class="fas fa-vote-yea"></i>
            </div>
            <div class="election-info">
              <h3>${election.organization}</h3>
              <p>${election.title}</p>
            </div>
          </div>
          <div class="election-stats">
            <div class="stat">
              <div class="stat-value">${election.voters}</div>
              <div class="stat-label">Voters</div>
            </div>
            <div class="stat">
              <div class="stat-value">${election.candidates}</div>
              <div class="stat-label">Candidates</div>
            </div>
            <div class="stat">
              <div class="stat-value">${votedPercentage}%</div>
              <div class="stat-label">Voted</div>
            </div>
          </div>
          <div class="election-details">
            <div class="election-detail">
              <span class="election-detail-label">Status:</span>
              <span class="status-badge ${statusClass}">${statusText}</span>
            </div>
            <div class="election-detail">
              <span class="election-detail-label">Starts:</span>
              <span>${formattedStartDate}</span>
            </div>
            <div class="election-detail">
              <span class="election-detail-label">Ends:</span>
              <span>${formattedEndDate}</span>
            </div>
          </div>
          <div class="election-actions">
            <a href="${election.link}" class="btn-view-election">
              <i class="fas fa-arrow-right"></i> Manage
            </a>
            <div>
              <button class="btn-action" data-action="edit" data-election="${election.id}">
                <i class="fas fa-edit"></i> Edit
              </button>
              <button class="btn-action" data-action="delete" data-election="${election.id}">
                <i class="fas fa-trash"></i> Delete
              </button>
            </div>
          </div>
        `;
        
        electionBoxes.appendChild(electionBox);
      });
      
      // Add event listeners to action buttons
      document.querySelectorAll('.btn-action').forEach(btn => {
        btn.addEventListener('click', handleElectionAction);
      });
    }

    // Handle election actions (edit, delete)
    function handleElectionAction(e) {
      const action = e.currentTarget.getAttribute('data-action');
      const electionId = e.currentTarget.getAttribute('data-election');
      const election = electionData.find(e => e.id === electionId);
      
      if (action === 'edit') {
        editElection(election);
      } else if (action === 'delete') {
        showActionModal(
          'Delete Election',
          `Are you sure you want to delete the election "${election.title}"? This action cannot be undone.`,
          () => deleteElection(electionId)
        );
      }
    }

    // Edit election
    function editElection(election) {
      // Populate form with election data
      document.getElementById('electionTitle').value = election.title;
      document.getElementById('electionOrganization').value = election.organization;
      document.getElementById('electionDescription').value = election.description;
      document.getElementById('startDate').value = election.startDate.slice(0, 16);
      document.getElementById('endDate').value = election.endDate.slice(0, 16);
      document.getElementById('electionStatus').value = election.status;
      
      // Update modal title and button
      document.querySelector('#createElectionModal .modal-header h2').textContent = 'Edit Election';
      document.querySelector('#createElectionModal .btn-primary').textContent = 'Update Election';
      
      // Store current election ID for update
      currentElectionId = election.id;
      
      // Show modal
      createElectionModal.style.display = 'flex';
    }

    // Add new election
    function addElection(electionData) {
      // Generate a unique ID
      const id = Date.now().toString();
      
      // Determine link based on organization
      let link = "";
      switch(electionData.organization) {
        case "IT": link = "elecIT.php"; break;
        case "ESM": link = "elecESM.php"; break;
        case "MET": link = "elecMET.php"; break;
        case "TCM": link = "elecTCM.php"; break;
        case "NAME": link = "elecNAME.php"; break;
        case "USG": link = "elecUSG.php"; break;
        default: link = "election-details.php";
      }
      
      // Add the new election to the data
      electionData.push({
        id: id,
        title: electionData.title,
        organization: electionData.organization,
        description: electionData.description,
        startDate: electionData.startDate,
        endDate: electionData.endDate,
        status: electionData.status,
        voters: 0,
        candidates: 0,
        voted: 0,
        color: getRandomColor(),
        link: link
      });
      
      // Re-render the election boxes
      renderElectionBoxes();
      
      // Show success message
      showToast(`Election "${electionData.title}" created successfully!`, 'success');
    }

    // Update election
    function updateElection(electionData) {
      const index = electionData.findIndex(e => e.id === currentElectionId);
      if (index === -1) return;
      
      // Update the election data
      electionData[index] = {
        ...electionData[index],
        title: electionData.title,
        organization: electionData.organization,
        description: electionData.description,
        startDate: electionData.startDate,
        endDate: electionData.endDate,
        status: electionData.status
      };
      
      // Re-render the election boxes
      renderElectionBoxes();
      
      // Show success message
      showToast(`Election "${electionData.title}" updated successfully!`, 'success');
    }

    // Delete election
    function deleteElection(electionId) {
      const electionIndex = electionData.findIndex(e => e.id === electionId);
      if (electionIndex === -1) return;
      
      const electionName = electionData[electionIndex].title;
      
      // Remove the election from the data
      electionData.splice(electionIndex, 1);
      
      // Re-render the election boxes
      renderElectionBoxes();
      
      // Show success message
      showToast(`Election "${electionName}" deleted successfully!`, 'success');
      
      // Close action modal
      closeActionModalFunc();
    }

    // Show action confirmation modal
    function showActionModal(title, content, confirmCallback) {
      actionModalTitle.textContent = title;
      actionModalContent.innerHTML = `<p>${content}</p>`;
      currentAction = confirmCallback;
      actionModal.style.display = 'flex';
    }

    // Close action modal
    function closeActionModalFunc() {
      actionModal.style.display = 'none';
      currentAction = null;
      currentElectionId = null;
    }

    // Generate random color for election
    function getRandomColor() {
      const colors = [
        '#003366', '#0066cc', '#4caf50', '#9c27b0', 
        '#ff9800', '#f44336', '#795548', '#607d8b'
      ];
      return colors[Math.floor(Math.random() * colors.length)];
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

      // Search functionality
      searchInput.addEventListener('input', (e) => {
        currentSearch = e.target.value;
        renderElectionBoxes();
      });

      // Create election modal
      addElectionBtn.addEventListener('click', () => {
        // Reset form
        electionForm.reset();
        document.querySelector('#createElectionModal .modal-header h2').textContent = 'Create New Election';
        document.querySelector('#createElectionModal .btn-primary').textContent = 'Create Election';
        currentElectionId = null;
        
        // Show modal
        createElectionModal.style.display = 'flex';
      });

      // Close election modal
      closeElectionModal.addEventListener('click', () => {
        createElectionModal.style.display = 'none';
        electionForm.reset();
        currentElectionId = null;
      });

      cancelElectionBtn.addEventListener('click', () => {
        createElectionModal.style.display = 'none';
        electionForm.reset();
        currentElectionId = null;
      });

      // Close modals when clicking outside
      window.addEventListener('click', (e) => {
        if (e.target === createElectionModal) {
          createElectionModal.style.display = 'none';
          electionForm.reset();
          currentElectionId = null;
        }
        if (e.target === actionModal) {
          closeActionModalFunc();
        }
      });

      // Election form submission
      electionForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const electionData = {
          title: document.getElementById('electionTitle').value,
          organization: document.getElementById('electionOrganization').value,
          description: document.getElementById('electionDescription').value,
          startDate: document.getElementById('startDate').value + ':00',
          endDate: document.getElementById('endDate').value + ':00',
          status: document.getElementById('electionStatus').value
        };
        
        if (currentElectionId) {
          updateElection(electionData);
        } else {
          addElection(electionData);
        }
        
        createElectionModal.style.display = 'none';
        electionForm.reset();
        currentElectionId = null;
      });

      // Action modal controls
      closeActionModal.addEventListener('click', closeActionModalFunc);
      cancelActionBtn.addEventListener('click', closeActionModalFunc);
      confirmActionBtn.addEventListener('click', () => {
        if (currentAction) {
          currentAction();
        }
      });
    }

    // Initialize the election management page when DOM is loaded
    document.addEventListener('DOMContentLoaded', initElectionManagement);
  </script>

  <!-- Admin profile loader (integrated from dashboard reference) -->
  <script>
  (function(){
    const GET_ADMIN = '../php/getAdmin.php';
    const avatarEl = document.getElementById('adminAvatar');
    const nameEl   = document.getElementById('adminName');
    const roleEl   = document.getElementById('adminRole');
    const userProfileEl = document.getElementById('userProfile');
    const dropdownEl = document.getElementById('dropdown');
    const logoutEl = document.getElementById('logoutBtn');

    function safeText(node, text) {
      if (!node) return;
      node.textContent = String(text ?? '');
    }

    function normalizeAvatarPath(raw) {
      if (!raw) return '../assests/default-avatar.jpg';
      let s = String(raw).trim();
      s = s.replace(/\\+/g, '/');
      if (!s) return '../assests/default-avatar.jpg';
      if (/^https?:\/\//i.test(s) || s.startsWith('/')) return s;
      if (s.startsWith('../')) return s;
      return '../' + s.replace(/^\/+/, '');
    }

    async function loadAdminProfile() {
      try {
        const res = await fetch(GET_ADMIN, { cache: 'no-store' });
        if (!res || !res.ok) {
          // keep defaults
          return;
        }
        const json = await res.json().catch(()=>null);
        if (!json) return;
        if (json.success === false) return;

        const name = json.name || json.admin_name || json.fullname || 'Administrator';
        const role = json.role || json.position || 'Administration';
        const avatarRaw = json.avatar || json.avatar_path || json.avatarUrl || json.profile || '';

        const avatar = normalizeAvatarPath(avatarRaw);

        if (avatarEl) avatarEl.src = avatar;
        safeText(nameEl, name);
        safeText(roleEl, /admin/i.test(String(role)) ? 'Administration' : role);
      } catch (err) {
        console.warn('loadAdminProfile error', err);
      }
    }

    function setupProfileInteractions() {
      if (!userProfileEl) return;
      userProfileEl.addEventListener('click', (e) => {
        e.stopPropagation();
        if (!dropdownEl) return;
        dropdownEl.style.display = dropdownEl.style.display === 'block' ? 'none' : 'block';
      });

      document.addEventListener('click', (e) => {
        if (!dropdownEl) return;
        if (!userProfileEl.contains(e.target)) dropdownEl.style.display = 'none';
      });

      if (logoutEl) {
        logoutEl.addEventListener('click', (ev) => {
          ev.preventDefault();
          // simple redirect to login; replace with real logout endpoint if available
          window.location.href = logoutEl.getAttribute('href') || '../login.html';
        });
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      setupProfileInteractions();
      loadAdminProfile();
    });
  })();
  </script>
</body>
</html>


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

    /* Election Management Specific Styles */
    .election-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .election-title {
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

    .add-election-btn {
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

    .add-election-btn:hover {
      background: #e6b800;
    }

    /* Election Boxes */
    .election-boxes {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 25px;
      margin-bottom: 30px;
    }

    .election-box {
      background: var(--ustp-white);
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid transparent;
    }

    .election-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .election-header-box {
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .election-avatar {
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

    .election-info h3 {
      font-size: 18px;
      margin-bottom: 5px;
    }

    .election-info p {
      font-size: 14px;
      opacity: 0.9;
    }

    .election-stats {
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

    .election-details {
      padding: 15px 20px;
      border-top: 1px solid #eee;
    }

    .election-detail {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .election-detail-label {
      font-weight: 600;
      color: var(--ustp-blue);
    }

    .election-actions {
      padding: 15px 20px;
      border-top: 1px solid #eee;
      display: flex;
      justify-content: space-between;
    }

    .btn-view-election {
      background: var(--ustp-blue);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 8px 15px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-view-election:hover {
      background: var(--ustp-light-blue);
    }

    .btn-action {
      background: transparent;
      color: var(--ustp-blue);
      border: 1px solid var(--ustp-blue);
      border-radius: 6px;
      padding: 8px 12px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 14px;
    }

    .btn-action:hover {
      background: var(--ustp-blue);
      color: white;
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

    .status-draft {
      background: #e2e3e5;
      color: #383d41;
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

    .btn-success {
      background: #28a745;
      color: white;
    }

    .btn-success:hover {
      background: #218838;
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

    .form-row {
      display: flex;
      gap: 15px;
    }

    .form-row .form-group {
      flex: 1;
    }

    .form-select {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      background-color: white;
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
      .election-header {
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
      .election-boxes {
        grid-template-columns: 1fr;
      }
      .election-actions {
        flex-direction: column;
        gap: 10px;
      }
      .form-row {
        flex-direction: column;
        gap: 0;
      }
    }
  </style>
</body>
</html>