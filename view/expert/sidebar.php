<!-- Expert Sidebar - Modern Dashboard Style -->
<style>
    /* ============================================
       EXPERT SIDEBAR - MODERN DASHBOARD STYLE
       ============================================ */
    :root {
        --sidebar-bg: #1e293b;
        --sidebar-bg-dark: #0f172a;
        --sidebar-active: #3b82f6;
        --sidebar-active-light: #3b82f620;
        --sidebar-hover: #334155;
        --sidebar-text: #e2e8f0;
        --sidebar-text-muted: #94a3b8;
        --sidebar-border: #334155;
        --accent-success: #10b981;
        --accent-warning: #f59e0b;
        --accent-danger: #ef4444;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --transition-fast: all 0.2s ease;
        --transition-normal: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --radius-sm: 0.5rem;
        --radius: 0.75rem;
        --radius-lg: 1rem;
    }

    /* Sidebar Container */
    .sidebar {
        width: 280px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-dark) 100%);
        box-shadow: var(--shadow-lg);
        padding: 28px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: var(--transition-normal);
        z-index: 1000;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: var(--sidebar-active) var(--sidebar-border);
    }

    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: var(--sidebar-border);
        border-radius: 10px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: var(--sidebar-active);
        border-radius: 10px;
    }

    /* Sidebar Header */
    .sidebar-header {
        text-align: center;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--sidebar-border);
    }

    .sidebar-header h4 {
        background: linear-gradient(135deg, var(--white) 0%, var(--sidebar-active) 100%);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .sidebar-header h4 i {
        font-size: 1.4rem;
        color: var(--sidebar-active);
    }

    .sidebar-header p {
        color: var(--sidebar-text-muted);
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* Expert Profile Card */
    .expert-profile {
        background: rgba(59, 130, 246, 0.1);
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 28px;
        border: 1px solid rgba(59, 130, 246, 0.2);
        transition: var(--transition-fast);
    }

    .expert-profile:hover {
        background: rgba(59, 130, 246, 0.15);
        transform: translateY(-2px);
        border-color: rgba(59, 130, 246, 0.4);
    }

    .expert-avatar {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, var(--sidebar-active), #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .expert-avatar i {
        font-size: 1.6rem;
        color: var(--white);
    }

    .expert-name {
        color: var(--white);
        font-weight: 700;
        font-size: 0.9rem;
        text-align: center;
        margin-bottom: 4px;
    }

    .expert-role {
        color: var(--sidebar-active);
        font-size: 0.7rem;
        text-align: center;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    /* Navigation Menu */
    .sidebar-nav {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    /* Nav Item Base */
    .sidebar a {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--sidebar-text);
        padding: 12px 16px;
        margin-bottom: 4px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: var(--transition-normal);
        position: relative;
        overflow: hidden;
    }

    .sidebar a i {
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        transition: var(--transition-fast);
        color: var(--sidebar-text-muted);
    }

    .sidebar a span {
        flex: 1;
    }

    /* Hover Effects */
    .sidebar a:hover {
        background: var(--sidebar-hover);
        color: var(--white);
        transform: translateX(4px);
    }

    .sidebar a:hover i {
        transform: scale(1.1);
        color: var(--sidebar-active);
    }

    /* Active Page Style */
    .sidebar a.active {
        background: linear-gradient(90deg, var(--sidebar-active) 0%, rgba(59, 130, 246, 0.8) 100%);
        color: var(--white);
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .sidebar a.active i {
        color: var(--white);
    }

    .sidebar a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 40%;
        background: var(--white);
        border-radius: 0 4px 4px 0;
    }

    /* Badge for notifications */
    .nav-badge {
        background: var(--accent-danger);
        color: white;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        margin-left: auto;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }

    /* Divider */
    .nav-divider {
        margin: 20px 0 12px;
        padding: 0 12px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--sidebar-text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-divider::before,
    .nav-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--sidebar-border);
    }

    /* Logout Section */
    .logout-section {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--sidebar-border);
    }

    .logout-section a {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .logout-section a:hover {
        background: var(--accent-danger);
        border-color: var(--accent-danger);
    }

    .logout-section a i {
        color: var(--accent-danger);
    }

    .logout-section a:hover i {
        color: var(--white);
    }

    /* Mobile Toggle Button */
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        width: 48px;
        height: 48px;
        background: var(--white);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: var(--sidebar-bg);
        cursor: pointer;
        z-index: 1100;
        box-shadow: var(--shadow-md);
        transition: var(--transition-fast);
        border: 1px solid var(--gray-200);
    }

    .sidebar-toggle:hover {
        transform: scale(1.05);
        background: var(--sidebar-active);
        color: white;
        border-color: var(--sidebar-active);
    }

    /* Mobile Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 999;
        transition: var(--transition-normal);
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* Animation for menu items */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .sidebar a {
        animation: slideInLeft 0.3s ease backwards;
    }

    /* Tooltip on hover */
    .sidebar a[data-tooltip] {
        position: relative;
    }

    .sidebar a[data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        background: var(--sidebar-bg-dark);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        white-space: nowrap;
        z-index: 100;
        margin-left: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--sidebar-border);
        pointer-events: none;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .sidebar {
            left: -300px;
            width: 280px;
            z-index: 1001;
        }
        
        .sidebar.show {
            left: 0;
        }
        
        .sidebar-toggle {
            display: flex;
        }
        
        body.sidebar-open {
            overflow: hidden;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 260px;
            padding: 20px 16px;
        }
        
        .sidebar a {
            padding: 10px 14px;
            font-size: 0.85rem;
        }
        
        .sidebar a i {
            font-size: 1.1rem;
        }
        
        .sidebar-header h4 {
            font-size: 1.2rem;
        }
        
        .expert-profile {
            padding: 12px;
        }
        
        .expert-avatar {
            width: 44px;
            height: 44px;
        }
        
        .expert-avatar i {
            font-size: 1.3rem;
        }
    }
</style>

<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle" onclick="toggleExpertSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeExpertSidebar()"></div>

<!-- Sidebar -->
<div class="sidebar" id="expertSidebar">
    <div>
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <h4>
                <i class="fas fa-chalkboard-user"></i>
                <span>Expert Panel</span>
            </h4>
            <p>Mentor Dashboard</p>
        </div>
        
        
        
        <!-- Navigation Menu -->
        <div class="sidebar-nav">
            <a href="expert_dashboard.php" class="<?= $activePage == 'expert_dashboard.php' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="../student/students.php" class="<?= $activePage == 'students.php' ? 'active' : '' ?>">
                <i class="fas fa-graduation-cap"></i>
                <span>Students</span>
            </a>
            <a href="../institute/institute.php" class="<?= $activePage == 'institute.php' ? 'active' : '' ?>">
                <i class="fas fa-building"></i>
                <span>Institutes</span>
           
            <a href="../../expert-chat.php" class="<?= $activePage == 'expert-chat.php' ? 'active' : '' ?>">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
                <span class="nav-badge" id="sidebarNotif">0</span>
            </a>
            <a href="setting.php" class="<?= $activePage == 'setting.php' ? 'active' : '' ?>">
                <i class="fas fa-user-cog"></i>
                <span>Settings</span>
            </a>
        </div>
    </div>
    
    <!-- Logout Section -->
    <div class="logout-section">
        <a href="../logout.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</div>

<script>
    // Toggle Sidebar Function
    function toggleExpertSidebar() {
        const sidebar = document.getElementById('expertSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('show');
        overlay.classList.toggle('active');
        document.body.classList.toggle('sidebar-open');
    }
    
    // Close Sidebar Function
    function closeExpertSidebar() {
        const sidebar = document.getElementById('expertSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.remove('show');
        overlay.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('expertSidebar');
        const toggle = document.querySelector('.sidebar-toggle');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (window.innerWidth <= 992) {
            if (!sidebar.contains(e.target) && !toggle.contains(e.target) && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                overlay.classList.remove('active');
                document.body.classList.remove('sidebar-open');
            }
        }
    });
    
    // Prevent body scroll when sidebar is open on mobile
    function handleBodyScroll() {
        const sidebar = document.getElementById('expertSidebar');
        if (window.innerWidth <= 992) {
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        } else {
            document.body.style.overflow = '';
        }
    }
    
    // Listen for sidebar class changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                handleBodyScroll();
            }
        });
    });
    
    const sidebarElement = document.getElementById('expertSidebar');
    if (sidebarElement) {
        observer.observe(sidebarElement, { attributes: true });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('expertSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (window.innerWidth > 992) {
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    
    // Highlight current page based on URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentPage = window.location.pathname.split('/').pop();
        const navLinks = document.querySelectorAll('.sidebar-nav a');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPage) {
                link.classList.add('active');
            } else if (currentPage === '' && href === 'expert_dashboard.php') {
                link.classList.add('active');
            }
        });
    });
    
    // Add hover tooltips for better UX on desktop
    if (window.innerWidth > 992) {
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            const text = link.querySelector('span:first-of-type')?.innerText;
            if (text) {
                link.setAttribute('data-tooltip', text);
            }
        });
    }
    
    // Function to update notification badge (call this when new messages arrive)
    function updateNotificationCount(count) {
        const badge = document.getElementById('sidebarNotif');
        if (badge) {
            if (count > 0) {
                badge.textContent = count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        }
    }
</script>