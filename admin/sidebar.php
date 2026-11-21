<?php
// sidebar.php - Modern Dashboard-Matched Sidebar
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

<style>
/* ============================================
   MODERN SIDEBAR - MATCHES DASHBOARD THEME
   ============================================ */
:root {
    /* Dashboard Color Scheme */
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
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* --- Sidebar Container --- */
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

/* --- Logo Section --- */
.sidebar-logo {
    text-align: center;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--sidebar-border);
}

.sidebar-logo h4 {
    background: linear-gradient(135deg, var(--white) 0%, var(--sidebar-active) 100%);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    font-weight: 800;
    font-size: 1.6rem;
    margin-bottom: 8px;
    letter-spacing: -0.5px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.sidebar-logo h4 i {
    font-size: 1.6rem;
    color: var(--sidebar-active);
    background: none;
    -webkit-background-clip: unset;
    background-clip: unset;
    color: var(--sidebar-active);
}

.sidebar-logo p {
    color: var(--sidebar-text-muted);
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* --- User Profile Section --- */
.user-profile {
    background: rgba(59, 130, 246, 0.1);
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 28px;
    border: 1px solid rgba(59, 130, 246, 0.2);
    transition: var(--transition-fast);
}

.user-profile:hover {
    background: rgba(59, 130, 246, 0.15);
    transform: translateY(-2px);
    border-color: rgba(59, 130, 246, 0.4);
}

.user-avatar {
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

.user-avatar i {
    font-size: 1.8rem;
    color: var(--white);
}

.user-name {
    color: var(--white);
    font-weight: 700;
    font-size: 0.95rem;
    text-align: center;
    margin-bottom: 4px;
}

.user-role {
    color: var(--sidebar-active);
    font-size: 0.7rem;
    text-align: center;
    font-weight: 600;
    letter-spacing: 0.3px;
}

/* --- Navigation Menu --- */
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

/* Menu Section Divider */
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

/* --- Logout Section --- */
.logout-section {
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--sidebar-border);
}

.logout a {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    margin-top: 0;
}

.logout a:hover {
    background: var(--accent-danger);
    border-color: var(--accent-danger);
    transform: translateX(4px);
}

.logout a i {
    color: var(--accent-danger);
}

.logout a:hover i {
    color: var(--white);
}

/* --- Mobile Toggle Button --- */
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
    border: 1px solid var(--sidebar-border);
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

/* --- Responsive Design --- */
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
    
    .sidebar-logo h4 {
        font-size: 1.4rem;
    }
    
    .sidebar-logo h4 i {
        font-size: 1.4rem;
    }
    
    .user-profile {
        padding: 12px;
    }
    
    .user-avatar {
        width: 44px;
        height: 44px;
    }
    
    .user-avatar i {
        font-size: 1.5rem;
    }
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

.sidebar a:nth-child(1) { animation-delay: 0.05s; }
.sidebar a:nth-child(2) { animation-delay: 0.1s; }
.sidebar a:nth-child(3) { animation-delay: 0.15s; }
.sidebar a:nth-child(4) { animation-delay: 0.2s; }
.sidebar a:nth-child(5) { animation-delay: 0.25s; }
.sidebar a:nth-child(6) { animation-delay: 0.3s; }
.sidebar a:nth-child(7) { animation-delay: 0.35s; }

/* Active page indicator dot */
.sidebar a.active .active-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    background: var(--white);
    border-radius: 50%;
    margin-left: 8px;
    animation: blink 1.5s infinite;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
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

/* Collapsed state for desktop (optional future feature) */
@media (min-width: 1200px) {
    .sidebar.collapsed {
        width: 80px;
    }
    
    .sidebar.collapsed .sidebar-logo h4 span,
    .sidebar.collapsed .user-profile,
    .sidebar.collapsed .sidebar-nav a span,
    .sidebar.collapsed .nav-divider,
    .sidebar.collapsed .logout-section .logout a span {
        display: none;
    }
    
    .sidebar.collapsed .sidebar-nav a {
        justify-content: center;
        padding: 12px;
    }
    
    .sidebar.collapsed .sidebar-nav a i {
        margin-right: 0;
    }
    
    .sidebar.collapsed .sidebar-logo h4 i {
        margin-right: 0;
    }
}
</style>

<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div>
        
        <!-- User Profile Section -->
        <div class="user-profile">
            <div class="user-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="user-name">Welcome, Admin</div>
            <div class="user-role">Administrator</div>
        </div>
        
        <!-- Navigation Menu -->
        <div class="sidebar-nav">
            <a href="admindashboard.php" class="active">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
                <span class="active-dot"></span>
            </a>
            <a href="manage-student.php">
                <i class="bi bi-people"></i>
                <span>Manage Students</span>
            </a>
            <a href="manage-expert.php">
                <i class="bi bi-person-badge"></i>
                <span>Manage Experts</span>
            </a>
            <a href="../view/institute/view_institute.php">
                <i class="bi bi-building"></i>
                <span>Manage Institutes</span>
            </a>
            <a href="manage-programs.php">
                <i class="bi bi-journal-bookmark"></i>
                <span>Manage Programs</span>
            </a>
            <a href="manage-contact.php">
                <i class="bi bi-envelope"></i>
                <span>Contacts</span>
                <span class="nav-badge">3</span>
            </a>
            <a href="settings.php">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </div>
    </div>
    
    <!-- Logout Section -->
    <div class="logout-section">
        <div class="logout">
            <a href="../view/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>

<script>
// Toggle Sidebar Function
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('show');
    overlay.classList.toggle('active');
    document.body.classList.toggle('sidebar-open');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('sidebar');
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
    const sidebar = document.getElementById('sidebar');
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

const sidebarElement = document.getElementById('sidebar');
if (sidebarElement) {
    observer.observe(sidebarElement, { attributes: true });
}

// Handle window resize
window.addEventListener('resize', function() {
    const sidebar = document.getElementById('sidebar');
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
        } else if (currentPage === '' && href === 'admindashboard.php') {
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
</script>