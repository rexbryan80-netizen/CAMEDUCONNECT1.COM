<?php
include '../../model/db.php';

$student_id = $_SESSION['user_id'];

// Fetch student info
$stmt = $conn->prepare("SELECT full_name, profile_image FROM students WHERE id=?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$full_name = $student['full_name'] ?? 'Student';
$profile_image = $student['profile_image'] ?? 'assets/images/default-student.png';

// Fetch unread messages count
$stmt2 = $conn->prepare("SELECT COUNT(*) as unread FROM messages WHERE receiver_id=? AND receiver_role='student' AND seen=0");
$stmt2->bind_param("i", $student_id);
$stmt2->execute();
$msg_result = $stmt2->get_result();
$unread = $msg_result->fetch_assoc()['unread'] ?? 0;
?>

<!-- MODERN SIDEBAR -->
<aside class="modern-sidebar" id="modernSidebar">
    <div class="sidebar-profile">
        <div class="avatar-wrapper">
            <?php if(file_exists('../../'.$profile_image)): ?>
                <img src="../../<?= $profile_image ?>" class="avatar-img" alt="avatar">
            <?php else:
                $initials = implode('', array_map(function($n){return $n[0];}, explode(' ', $full_name)));
                $initials = strtoupper(substr($initials, 0, 2));
            ?>
                <div class="avatar-initials"><?= $initials ?></div>
            <?php endif; ?>
        </div>
        <div class="student-name"><?= $full_name ?></div>
    </div>

    <div class="nav-menu">
        <a href="students-dashboard.php" class="nav-item" data-nav="dashboard">
            <i class="fas fa-chart-line"></i> <span>Dashboard</span>
        </a>
        <a href="../../student-chat.php" class="nav-item" data-nav="messages">
            <i class="fas fa-comment-dots"></i> <span>Messages</span>
            <span class="badge-count"><?= $unread ?></span>
        </a>
        <a href="../expert/experts.php" class="nav-item">
            <i class="fas fa-user-graduate"></i> <span>Find Experts</span>
        </a>
        <a href="../institute/institute.php" class="nav-item">
            <i class="fas fa-university"></i> <span>Institutes</span>
        </a>
        <a href="../../student_ai.php" class="nav-item">
            <i class="fas fa-brain"></i> <span>AI Guide</span>
        </a>
        <a href="setting.php" class="nav-item">
            <i class="fas fa-sliders-h"></i> <span>Settings</span>
        </a>
        <a href="../logout.php" class="nav-item">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
    </div>

    <button class="toggle-sidebar-btn" id="toggleSidebarBtn" aria-label="Toggle sidebar">
        <i class="fas fa-chevron-left"></i>
    </button>
</aside>

<!-- Mobile menu open button -->
<button class="mobile-menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
</button>

<style>
/* ===== Modern sidebar styling ===== */
.modern-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    background: linear-gradient(145deg,#0f172a 0%,#111827 100%);
    color: #eef2ff;
    flex-direction: column;
    display: flex;
    z-index: 1100;
    box-shadow: 8px 0 30px rgba(0,0,0,0.12);
    border-right: 1px solid rgba(255,255,255,0.08);
    overflow-y: auto;
    transition: all 0.35s cubic-bezier(0.2,0.9,0.4,1.1);
}
.modern-sidebar.collapsed { width: 88px; }

.sidebar-profile { display: flex; flex-direction: column; align-items: center; padding: 32px 20px 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
.avatar-wrapper { position: relative; margin-bottom: 16px; }
.avatar-img { width: 92px; height: 92px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(79,70,229,0.7); box-shadow:0 12px 22px -8px rgba(0,0,0,0.4); }
.avatar-initials { width:92px; height:92px; border-radius:50%; background:linear-gradient(135deg,#4f46e5,#06b6d4); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:32px; color:white; border:3px solid rgba(255,255,240,0.5); box-shadow:0 12px 22px -8px rgba(0,0,0,0.4);}
.student-name { font-size:1.25rem; font-weight:600; text-align:center; background:linear-gradient(120deg,#fff,#cbd5e6); background-clip:text; -webkit-background-clip:text; color:transparent; }
.modern-sidebar.collapsed .student-name { opacity:0; visibility:hidden; width:0; height:0; margin:0; font-size:0; }
.nav-menu { flex:1; display:flex; flex-direction:column; padding:0 14px; gap:8px; }
.nav-item { display:flex; align-items:center; gap:14px; padding:12px 16px; border-radius:18px; color:#e2e8f0; text-decoration:none; font-weight:500; transition:0.25s; position:relative; }
.nav-item i { width:26px; font-size:1.3rem; text-align:center; }
.nav-item span { white-space:nowrap; transition:opacity 0.2s,transform 0.2s; }
.nav-item:hover { background: rgba(79,70,229,0.35); backdrop-filter:blur(4px); transform:translateX(6px); }
.nav-item.active { background: linear-gradient(95deg,#4f46e5,#6366f1); color:white; box-shadow:0 8px 18px -6px rgba(79,70,229,0.4); }
.badge-count { background:#ef4444; color:white; font-size:0.7rem; font-weight:bold; padding:2px 8px; border-radius:30px; margin-left:auto; min-width:26px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.2); }
.modern-sidebar.collapsed .nav-item span { opacity:0; visibility:hidden; width:0; display:none; }
.modern-sidebar.collapsed .nav-item { justify-content:center; padding:12px 0; gap:0; margin:4px auto; width:90%; }
.modern-sidebar.collapsed .badge-count { position:absolute; top:4px; right:8px; padding:1px 5px; font-size:0.6rem; min-width:18px; }
.toggle-sidebar-btn { background:#1e293b; border:1px solid rgba(255,255,255,0.2); color:#cbd5e1; width:42px; height:42px; border-radius:30px; display:flex; align-items:center; justify-content:center; cursor:pointer; margin:20px auto 28px auto; box-shadow:0 4px 12px rgba(0,0,0,0.2); font-size:1.2rem; }
.toggle-sidebar-btn:hover { background:#4f46e5; color:white; transform:rotate(180deg); border-color:#818cf8; }
.mobile-menu-toggle { display:none; position:fixed; bottom:24px; right:24px; background:#4f46e5; color:white; width:52px; height:52px; border-radius:30px; box-shadow:0 8px 20px rgba(0,0,0,0.25); display:flex; align-items:center; justify-content:center; font-size:24px; z-index:1200; cursor:pointer; border:none; transition:0.2s; }
@media(max-width:768px){ .modern-sidebar { width:260px; } .modern-sidebar.collapsed { width:0; transform:translateX(-100%); visibility:hidden; } .dashboard-main { margin-left:0 !important; } .mobile-menu-toggle { display:flex; } }
</style>

<script>
const sidebar = document.getElementById('modernSidebar');
const toggleBtn = document.getElementById('toggleSidebarBtn');
const mobileToggle = document.getElementById('mobileMenuToggle');

// Sidebar toggle
toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});

// Mobile menu toggle
mobileToggle.addEventListener('click', () => {
    sidebar.classList.remove('collapsed');
});
</script>