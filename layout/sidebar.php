<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemilihan Tempat Magang - Sidebar Style</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #f5f5dc;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
    }

    /* Top Header */
    .top-header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background: linear-gradient(90deg, #800000 0%, #A52A2A 100%);
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      z-index: 1100;
      display: flex;
      align-items: center;
      padding: 0 20px;
      transition: padding-left 0.3s ease;
    }

    .top-header.sidebar-collapsed {
      padding-left: 90px;
    }

    .top-header.sidebar-expanded {
      padding-left: 280px;
    }

    .hamburger-menu {
      background: none;
      border: none;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      padding: 8px;
      border-radius: 4px;
      transition: background 0.2s;
      margin-right: 15px;
    }

    .hamburger-menu:hover {
      background: rgba(255,255,255,0.1);
    }

    .header-logo {
      display: flex;
      align-items: center;
      color: #fff;
      text-decoration: none;
    }

    .header-logo i {
      font-size: 28px;
      color: #F5F5DC;
      margin-right: 12px;
    }

    .header-title {
      font-size: 18px;
      font-weight: 600;
      color: #fff;
    }
    /* === Perbaikan Layout Utama === */

#main {
  margin-left: 260px;
  padding: 90px 25px 30px;
  transition: margin-left 0.3s ease;
  min-height: calc(100vh - 70px);
}

#sidebar.collapsed ~ #main {
  margin-left: 70px;
}

@media (max-width: 900px) {
  #main {
    margin-left: 0 !important;
    padding: 90px 20px 20px;
  }

  #sidebar.collapsed ~ #main {
    margin-left: 0;
  }
}

/* Hapus display: none pada sidebar jika masih ada */
.sidebar {
  display: block !important;
}

    /* Sidebar */
    #sidebar {
      width: 260px;
      height: 100vh;
      background: linear-gradient(180deg, #800000 0%, #A52A2A 40%, #F5F5DC 100%);
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
      box-shadow: 2px 0 15px rgba(0,0,0,0.08);
      transition: width 0.3s ease;
      z-index: 1000;
    }

    #sidebar.collapsed {
      width: 70px;
    }

    /* Sidebar Header */
    .sidebar-header {
      padding: 22px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid rgba(255,255,255,0.12);
      min-height: 70px;
      box-sizing: border-box;
    }

    .logo a {
      color: #fff;
      font-size: 18px;
      font-weight: 700;
      text-decoration: none;
      letter-spacing: 1px;
      transition: opacity 0.3s;
      white-space: nowrap;
    }

    #sidebar.collapsed .logo a {
      opacity: 0;
      pointer-events: none;
    }

    #sidebar.collapsed .sidebar-header {
      justify-content: center;
      padding: 22px 10px;
    }

    /* Menu */
    .menu {
      list-style: none;
      padding: 0;
      margin: 20px 0;
    }

    .sidebar-title {
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      padding: 10px 25px;
      color: rgba(255,255,255,0.6);
      letter-spacing: 1px;
      margin-bottom: 5px;
      transition: opacity 0.3s;
    }

    #sidebar.collapsed .sidebar-title {
      opacity: 0;
      height: 0;
      padding: 0;
      margin: 0;
      overflow: hidden;
    }

    .sidebar-item {
      margin: 0;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      padding: 12px 25px;
      color: #fff;
      text-decoration: none;
      font-size: 15px;
      border-radius: 8px;
      transition: all 0.18s;
      cursor: pointer;
      gap: 14px;
      position: relative;
      margin: 0 10px;
    }

    .sidebar-link:hover, .sidebar-item.active > .sidebar-link {
      background: rgba(255,255,255,0.13);
      color: #fff;
      text-decoration: none;
    }

    .sidebar-link i {
      font-size: 18px;
      color: #fff;
      min-width: 22px;
      text-align: center;
      transition: color 0.2s;
    }

    #sidebar.collapsed .sidebar-link span {
      opacity: 0;
      width: 0;
      overflow: hidden;
      transition: opacity 0.3s;
    }

    #sidebar.collapsed .sidebar-link {
      justify-content: center;
      padding: 12px 8px;
      margin: 2px 5px;
      gap: 0;
    }

    /* Submenu */
    .has-sub .submenu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.25s cubic-bezier(0.4,0,0.2,1);
      background: rgba(255,255,255,0.07);
      border-radius: 0 0 8px 8px;
      margin: 0 10px;
    }

    .has-sub.active .submenu {
      max-height: 500px;
      transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1);
    }

    .submenu-item a {
      display: block;
      padding: 10px 25px 10px 50px;
      color: #fff;
      text-decoration: none;
      font-size: 14px;
      border-radius: 6px;
      transition: background 0.2s;
    }

    .submenu-item a:hover, .submenu-item.active a {
      background: rgba(255,255,255,0.18);
      text-decoration: none;
    }

    #sidebar.collapsed .submenu {
      display: none !important;
    }

    .chevron-icon {
      margin-left: auto;
      transition: transform 0.3s;
      font-size: 14px;
    }

    .has-sub.active .chevron-icon {
      transform: rotate(180deg);
    }

    #sidebar.collapsed .chevron-icon {
      display: none;
    }

    /* Content */
    #content {
      margin-left: 260px;
      margin-top: 70px;
      padding: 30px 25px;
      transition: margin-left 0.3s ease;
      min-height: calc(100vh - 70px);
    }

    #sidebar.collapsed + #content {
      margin-left: 70px;
    }

    /* User profile in sidebar */
    .sidebar-user {
      display: flex;
      align-items: center;
      padding: 15px 25px;
      border-bottom: 1px solid rgba(255,255,255,0.12);
      transition: all 0.3s;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 12px;
      font-size: 18px;
      color: #fff;
      transition: margin 0.3s;
    }

    .user-info {
      flex: 1;
      transition: opacity 0.3s;
    }

    .user-name {
      font-size: 14px;
      font-weight: 600;
      margin: 0;
      color: #fff;
    }

    .user-role {
      font-size: 12px;
      color: rgba(255,255,255,0.7);
      margin: 0;
    }

    #sidebar.collapsed .sidebar-user {
      justify-content: center;
      padding: 15px 10px;
    }

    #sidebar.collapsed .user-avatar {
      margin-right: 0;
    }

    #sidebar.collapsed .user-info {
      opacity: 0;
      width: 0;
      overflow: hidden;
    }

    /* Custom scrollbar for sidebar */
    #sidebar::-webkit-scrollbar {
      width: 6px;
    }

    #sidebar::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.1);
    }

    #sidebar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.3);
      border-radius: 3px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255,255,255,0.5);
    }

    /* Sample content styles */
    .content-header {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .content-title {
      font-size: 24px;
      font-weight: 600;
      color: #800000;
      margin: 0;
    }

    .content-subtitle {
      color: #A52A2A;
      margin: 5px 0 0;
    }

    /* Responsive */
    @media (max-width: 900px) {
      #sidebar {
        left: -260px;
      }
      
      #sidebar.mobile-open {
        left: 0;
      }
      
      .top-header {
        padding-left: 20px !important;
      }
      
      #content {
        margin-left: 0;
        padding: 20px 15px;
      }
      
      #sidebar.collapsed + #content {
        margin-left: 0;
      }
    }

    /* Overlay for mobile */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s;
    }

    .sidebar-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    /* Tooltip for collapsed sidebar */
    .tooltip {
      position: absolute;
      left: 70px;
      background: #333;
      color: #fff;
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 12px;
      white-space: nowrap;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s;
      z-index: 1200;
      top: 50%;
      transform: translateY(-50%);
    }

    .tooltip::before {
      content: '';
      position: absolute;
      left: -5px;
      top: 50%;
      transform: translateY(-50%);
      border: 5px solid transparent;
      border-right-color: #333;
    }

    #sidebar.collapsed .sidebar-link:hover .tooltip {
      opacity: 1;
      visibility: visible;
    }

    /* Remove the problematic secondary sidebar */
    .sidebar {
      display: none;
    }

    /* Submenu toggle styling */
    .sidebar-toggle {
      color: #fff !important;
      text-decoration: none !important;
      display: flex;
      align-items: center;
      width: 100%;
    }

    .sidebar-toggle:hover {
      color: #fff !important;
      text-decoration: none !important;
    }
  </style>
</head>

<body>
  <!-- Top Header -->
  <div class="top-header" id="topHeader">
    <button class="hamburger-menu" id="sidebarToggle">
      <i class="bi bi-list"></i>
    </button>
    <a href="#" class="header-logo">
      <i class="bi bi-mortarboard-fill"></i>
      <span class="header-title">Pemilihan Tempat Magang</span>
    </a>
  </div>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <div id="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <a href="index.php">SPK Magang</a>
      </div>
    </div>

    <div class="sidebar-user">
      <div class="user-avatar">
        <i class="bi bi-person-fill"></i>
      </div>
      <div class="user-info">
        <p class="user-name">Admin</p>
        <p class="user-role">Administrator</p>
      </div>
    </div>

    <ul class="menu">
      <li class="sidebar-title">Menu</li>
      
      <li class="sidebar-item active">
        <a href="index.php" class="sidebar-link">
          <i class="bi bi-grid-fill"></i>
          <span>Dashboard</span>
          <div class="tooltip">Dashboard</div>
        </a>
      </li>
      
      <li class="sidebar-item has-sub">
        <a href="javascript:void(0)" class="sidebar-link sidebar-toggle">
          <i class="bi bi-file-earmark-spreadsheet-fill"></i>
          <span>Data</span>
          <i class="bi bi-chevron-down chevron-icon"></i>
          <div class="tooltip">Data</div>
        </a>
        <ul class="submenu">
          <li class="submenu-item">
            <a href="alternatif.php">Alternatif</a>
          </li>
          <li class="submenu-item">
            <a href="bobot.php">Bobot & Kriteria</a>
          </li>
        </ul>
      </li>
      
      <li class="sidebar-item">
        <a href="matrik.php" class="sidebar-link">
          <i class="bi bi-pentagon-fill"></i>
          <span>Matrik</span>
          <div class="tooltip">Matrik</div>
        </a>
      </li>
      
      <li class="sidebar-item">
        <a href="preferensi.php" class="sidebar-link">
          <i class="bi bi-bar-chart-fill"></i>
          <span>Nilai Preferensi</span>
          <div class="tooltip">Nilai Preferensi</div>
        </a>
      </li>
      
      <li class="sidebar-item">
        <a href="logout.php" class="sidebar-link">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
          <div class="tooltip">Logout</div>
        </a>
      </li>
    </ul>
  </div>

  
  <script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const topHeader = document.getElementById('topHeader');
    const content = document.getElementById('content');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    let isMobile = window.innerWidth <= 900;
    let isCollapsed = false;

    // Function to check if mobile
    function checkMobile() {
      isMobile = window.innerWidth <= 900;
      if (isMobile) {
        sidebar.classList.remove('collapsed');
        topHeader.className = 'top-header';
        isCollapsed = false;
      }
    }

    // Toggle sidebar
    sidebarToggle.addEventListener('click', () => {
      if (isMobile) {
        // Mobile behavior: show/hide sidebar
        sidebar.classList.toggle('mobile-open');
        sidebarOverlay.classList.toggle('active');
      } else {
        // Desktop behavior: collapse/expand sidebar
        sidebar.classList.toggle('collapsed');
        isCollapsed = !isCollapsed;
        
        // Update header padding and content margin
        if (isCollapsed) {
          topHeader.className = 'top-header sidebar-collapsed';
        } else {
          topHeader.className = 'top-header sidebar-expanded';
        }
      }
    });

    // Close sidebar when clicking overlay (mobile only)
    sidebarOverlay.addEventListener('click', () => {
      if (isMobile) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
      }
    });

    // Handle submenu toggle
    document.addEventListener('DOMContentLoaded', function() {
      const submenuToggles = document.querySelectorAll('.sidebar-toggle');
      
      submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!sidebar.classList.contains('collapsed')) {
            const parent = this.closest('.has-sub');
            
            // Close other submenus
            document.querySelectorAll('.has-sub.active').forEach(item => {
              if (item !== parent) {
                item.classList.remove('active');
              }
            });
            
            // Toggle current submenu
            parent.classList.toggle('active');
          }
        });
      });
      
      // Handle navigation clicks
      const navLinks = document.querySelectorAll('.sidebar-link[href]:not(.sidebar-toggle), .submenu-item a[href]');
      
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Close mobile sidebar after navigation
          if (isMobile) {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.remove('active');
          }
          
          // Update active states
          setActiveFromHref(this.getAttribute('href'));
        });
      });
    });

    // Set active menu based on href
    function setActiveFromHref(href) {
      // Remove all active classes
      document.querySelectorAll('.sidebar-item, .submenu-item').forEach(item => {
        item.classList.remove('active');
      });
      
      // Find and activate the matching link
      const matchingLink = document.querySelector(`a[href="${href}"]`);
      if (matchingLink) {
        if (matchingLink.closest('.submenu-item')) {
          // Submenu item
          matchingLink.closest('.submenu-item').classList.add('active');
          const parentSub = matchingLink.closest('.has-sub');
          if (parentSub) {
            parentSub.classList.add('active');
          }
        } else {
          // Main menu item
          matchingLink.closest('.sidebar-item').classList.add('active');
        }
      }
    }

    // Set current page active on load
    function setActiveMenu() {
      const currentPage = window.location.pathname.split('/').pop() || 'index.php';
      setActiveFromHref(currentPage);
    }

    // Window resize handler
    window.addEventListener('resize', checkMobile);

    // Initialize
    checkMobile();
    setActiveMenu();
    if (!isMobile) {
      topHeader.className = 'top-header sidebar-expanded';
    }
  </script>
</body>
</html>