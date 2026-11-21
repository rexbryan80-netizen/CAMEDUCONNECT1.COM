<?php
session_start();
require_once '../../model/db.php';

// Check if user is logged in as expert
if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'expert'){
    header("Location: login.php");
    exit();
}

$expert_id = $_SESSION['user_id'];
$expert_name = $_SESSION['full_name'] ?? 'Expert ';
$expert_specialization = $_SESSION['specialization'] ?? 'Education Expert';



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Expert Dashboard | Cameroon Pro</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --primary-light: #60a5fa;
        --primary-bg: #eff6ff;
        --success: #10b981;
        --success-bg: #d1fae5;
        --warning: #f59e0b;
        --warning-bg: #fef3c7;
        --danger: #ef4444;
        --danger-bg: #fee2e2;
        --info: #8b5cf6;
        --info-bg: #ede9fe;
        --dark: #1e293b;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --radius-sm: 0.5rem;
        --radius: 0.75rem;
        --radius-lg: 1rem;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--gray-100);
        color: var(--gray-800);
        line-height: 1.5;
        min-height: 100vh;
    }

    /* Main Content Area */
    .main-content {
        margin-left: 280px;
        padding: 24px 32px;
        min-height: 100vh;
        transition: var(--transition);
    }

    /* Top Bar */
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
        background: var(--white);
        padding: 12px 24px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
    }

    .logo-area {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        font-size: 1.3rem;
        color: var(--gray-800);
    }

    .logo-area i {
        font-size: 1.6rem;
        color: var(--primary);
    }

    .expert-badge {
        background: var(--primary-bg);
        padding: 6px 16px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .avatar-prof {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--gray-50);
        padding: 6px 16px 6px 12px;
        border-radius: 50px;
        border: 1px solid var(--gray-200);
    }

    .avatar-prof i {
        font-size: 1.3rem;
        color: var(--primary);
    }

    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 22px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: var(--transition);
        border: 1px solid var(--gray-200);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .stat-left h4 {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--gray-500);
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-800);
    }

    .stat-trend {
        font-size: 0.7rem;
        margin-top: 6px;
        color: var(--success);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-bg);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 26px;
        margin-bottom: 28px;
    }

    /* Cards */
    .card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 20px 24px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-200);
    }

    .card-header h3 {
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-header h3 i {
        color: var(--primary);
    }

    .badge-link {
        font-size: 0.7rem;
        background: var(--gray-100);
        padding: 4px 12px;
        border-radius: 30px;
        text-decoration: none;
        color: var(--gray-600);
        font-weight: 500;
        transition: var(--transition);
    }

    .badge-link:hover {
        background: var(--primary);
        color: white;
    }

    /* Mentee List */
    .mentee-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-100);
    }

    .mentee-avatar {
        width: 44px;
        height: 44px;
        background: var(--primary-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--primary);
    }

    .mentee-info {
        flex: 1;
    }

    .mentee-name {
        font-weight: 700;
        font-size: 0.9rem;
    }

    .progress-indicator {
        font-size: 0.7rem;
        color: var(--gray-500);
    }

    .action-icon {
        color: var(--gray-400);
        cursor: pointer;
        transition: var(--transition);
    }

    .action-icon:hover {
        color: var(--primary);
    }

    /* Session Items */
    .session-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .session-time {
        background: var(--gray-100);
        border-radius: 30px;
        padding: 4px 12px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray-600);
    }

    .session-topic {
        font-weight: 500;
        font-size: 0.85rem;
        flex: 1;
    }

    .btn-sm {
        background: var(--primary-bg);
        border: none;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--primary);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-sm:hover {
        background: var(--primary);
        color: white;
    }

    /* Resource List */
    .resource-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .resource-item {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--gray-50);
        padding: 10px 12px;
        border-radius: var(--radius);
        font-size: 0.8rem;
    }

    .resource-item i {
        color: var(--primary);
    }

    /* Expert Tags */
    .expert-tag {
        display: inline-block;
        background: var(--gray-100);
        border-radius: 30px;
        padding: 5px 14px;
        font-size: 0.7rem;
        margin: 0 6px 8px 0;
        font-weight: 500;
    }

    /* Buttons */
    button, .btn-primary {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 16px;
        border-radius: 40px;
        cursor: pointer;
        font-size: 0.8rem;
        transition: var(--transition);
    }

    button:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover {
        background: var(--primary);
        color: white;
    }

    /* Progress Bar */
    .progress-track {
        margin: 12px 0;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.7rem;
        margin-bottom: 6px;
    }

    .progress-bar {
        background: var(--gray-200);
        height: 6px;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        background: var(--primary);
        height: 100%;
        border-radius: 10px;
    }

    /* Quick Actions */
    .quick-actions {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 20px 28px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        border: 1px solid var(--gray-200);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }
        
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 16px;
        }
        
        .top-bar {
            flex-direction: column;
            text-align: center;
        }
        
        .user-info {
            justify-content: center;
        }
        
        .stats-row {
            grid-template-columns: 1fr;
        }
        
        .quick-actions {
            flex-direction: column;
            text-align: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card, .card {
        animation: fadeInUp 0.4s ease backwards;
    }
</style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="logo-area">
            <i class="fas fa-chalkboard-user"></i>
            <span>Expert Dashboard</span>
        </div>
        <div class="user-info">
            <div class="expert-badge">
                <i class="fas fa-check-circle"></i> 
            </div>
            <div class="avatar-prof">
                <i class="fas fa-user-circle"></i>
                <span><strong><?= htmlspecialchars($expert_name) ?></strong> · <?= htmlspecialchars($expert_specialization) ?></span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-left">
                <h4>Active Mentees</h4>
                <div class="stat-number">9</div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i> this semester</div>
            </div>
            <div class="stat-icon"><i class="fas fa-users"></i></div>
        </div>
        <div class="stat-card">
            <div class="stat-left">
                <h4>Sessions Completed</h4>
                <div class="stat-number">1</div>
                <div class="stat-trend"><i class="fas fa-calendar-check"></i> +8 this month</div>
            </div>
            <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
        </div>
        <div class="stat-card">
            <div class="stat-left">
                <h4>Avg. Student Growth</h4>
                <div class="stat-number">+50%</div>
                <div class="stat-trend">performance increase</div>
            </div>
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
        </div>
        <div class="stat-card">
            <div class="stat-left">
                <h4>Institute Rating</h4>
                <div class="stat-number">4.9</div>
                <div class="stat-trend"><i class="fas fa-star" style="color: #f59e0b;"></i> from 58 reviews</div>
            </div>
            <div class="stat-icon"><i class="fas fa-medal"></i></div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="dashboard-grid">
        <!-- My Mentees -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-user-graduate"></i> My Mentees</h3>
                <a href="#" class="badge-link">view all</a>
            </div>
            <div class="mentee-item">
                <div class="mentee-avatar"><i class="fas fa-female"></i></div>
                <div class="mentee-info">
                    <div class="mentee-name">Amara N. <span style="font-size:0.7rem;">(Yaoundé)</span></div>
                    <div class="progress-indicator">Progress: +18% · GPA 3.6 → 3.9</div>
                </div>
                <i class="fas fa-comment action-icon"></i>
            </div>
            <div class="mentee-item">
                <div class="mentee-avatar"><i class="fas fa-male"></i></div>
                <div class="mentee-info">
                    <div class="mentee-name">James K. <span style="font-size:0.7rem;">(Adamawa)</span></div>
                    <div class="progress-indicator">Web dev project: 92% completion</div>
                </div>
                <i class="fas fa-chart-simple action-icon"></i>
            </div>
            <div class="mentee-item">
                <div class="mentee-avatar"><i class="fas fa-user"></i></div>
                <div class="mentee-info">
                    <div class="mentee-name">BONGKISHE <span style="font-size:0.7rem;">(South Region)</span></div>
                    <div class="progress-indicator">AI coursework · needs mentorship</div>
                </div>
                <i class="fas fa-calendar-alt action-icon"></i>
            </div>
            <div class="mentee-item">
                <div class="mentee-avatar"><i class="fas fa-user"></i></div>
                <div class="mentee-info">
                    <div class="mentee-name">Grace L. <span style="font-size:0.7rem;">(Bafoussam)</span></div>
                    <div class="progress-indicator">Database project review pending</div>
                </div>
                <i class="fas fa-chalkboard action-icon"></i>
            </div>
            <button class="btn-outline" style="margin-top: 8px; width: 100%;"><i class="fas fa-plus-circle"></i> Add session notes</button>
        </div>

        <!-- Scheduled Sessions -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-video"></i> Scheduled Sessions</h3>
                <i class="fas fa-bell" style="color: var(--gray-400);"></i>
            </div>
            <div class="session-item">
                <div><span class="session-time"><i class="far fa-clock"></i> Today 3:00 PM</span></div>
                <div class="session-topic">Data Structures: Trees & Algorithms</div>
                <button class="btn-sm">Join</button>
            </div>
            <div class="session-item">
                <div><span class="session-time"><i class="far fa-calendar"></i> Apr 5, 10:30 AM</span></div>
                <div class="session-topic">AI Ethics & Research Paper</div>
                <button class="btn-sm">Prepare</button>
            </div>
            <div class="session-item">
                <div><span class="session-time"><i class="far fa-calendar"></i> Apr 7, 2:00 PM</span></div>
                <div class="session-topic">Web Dev: React Native workshop</div>
                <button class="btn-sm">Reschedule</button>
            </div>
            <div class="card-header" style="margin-top: 8px;">
                <h3><i class="fas fa-handshake"></i> Mentorship Requests</h3>
                <span class="badge-link">2 new</span>
            </div>
            <div class="mentee-item" style="border-bottom: none;">
                <div class="mentee-avatar" style="background: var(--warning-bg);"><i class="fas fa-plus"></i></div>
                <div class="mentee-info"><strong>New: Marie M.</strong><br><span style="font-size:0.7rem;">Request: Exam prep (Algorithms)</span></div>
                <button class="btn-sm" style="background: var(--primary); color: white;">Accept</button>
            </div>
            <div class="mentee-item">
                <div class="mentee-avatar" style="background: var(--warning-bg);"><i class="fas fa-plus"></i></div>
                <div class="mentee-info"><strong>New: Daniel F.</strong><br><span style="font-size:0.7rem;">Career guidance: software engineering</span></div>
                <button class="btn-sm" style="background: var(--primary); color: white;">Accept</button>
            </div>
        </div>

        <!-- AI Assistant -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-robot"></i> AI Assistant</h3>
                <i class="fas fa-microchip" style="color: var(--gray-400);"></i>
            </div>
            <div style="background: var(--primary-bg); border-radius: 20px; padding: 16px; margin-bottom: 20px;">
                <div style="display: flex; gap: 12px; align-items: center;">
                    <i class="fas fa-brain" style="font-size: 1.8rem; color: var(--primary);"></i>
                    <div><strong>Generate learning plans</strong><br><span style="font-size:0.7rem;">AI-powered insights for mentees</span></div>
                </div>
                <div style="display: flex; gap: 8px; margin-top: 12px;">
                    <input type="text" placeholder="e.g., Suggest python exercises" style="flex:1; padding: 10px 14px; border-radius: 40px; border: 1px solid var(--gray-200);">
                    <button style="width: auto; padding: 10px 20px;">Generate</button>
                </div>
            </div>
            <div class="card-header" style="margin-top: 4px;">
                <h3><i class="fas fa-book-open"></i> Resource Hub</h3>
                <a href="#" class="badge-link">Cameroon curriculum</a>
            </div>
            <div class="resource-list">
                <div class="resource-item"><i class="fas fa-file-pdf"></i> AI Curriculum Guide</div>
                <div class="resource-item"><i class="fas fa-chalkboard"></i> Mentorship best practices</div>
                <div class="resource-item"><i class="fas fa-chart-line"></i> Growth tracking templates</div>
            </div>
            <button class="btn-outline" style="margin-top: 12px; width: 100%;"><i class="fas fa-upload"></i> Share resource</button>
        </div>
    </div>

    <!-- Second Row -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 26px; margin-bottom: 28px;">
        <!-- Expert Network -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-network-wired"></i> Expert Network</h3>
                <i class="fas fa-users" style="color: var(--gray-400);"></i>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px;">
                <div class="expert-tag"><i class="fas fa-code"></i> Dr. Peterson</div>
                <div class="expert-tag"><i class="fas fa-database"></i> Prof. Chen</div>
                <div class="expert-tag"><i class="fas fa-chart-line"></i> Mrs. Atanga</div>
            </div>
            <div class="mentee-item" style="border-bottom: none;">
                <div class="mentee-avatar" style="background: var(--info-bg);"><i class="fas fa-comments"></i></div>
                <div class="mentee-info"><strong>Expert Forum: Mentorship Circle</strong><br><span>Share strategies & co-host webinars</span></div>
                <i class="fas fa-arrow-right action-icon"></i>
            </div>
            <button style="margin-top: 8px; width: 100%;"><i class="fas fa-user-plus"></i> Connect with mentors</button>
        </div>

        <!-- Partner Institutes -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-building-columns"></i> Partner Institutes</h3>
                <a href="#" class="badge-link">verified</a>
            </div>
            <div style="background: var(--gray-50); border-radius: 16px; padding: 14px; margin-bottom: 16px;">
                <div><i class="fas fa-school"></i> <strong>NANFAH INSTITUTE</strong> (West Region)</div>
                <div style="font-size:0.7rem; margin-top: 6px;">Top computer science program · 94% satisfaction</div>
            </div>
            <div><i class="fas fa-trophy" style="color: var(--warning);"></i> <strong>Your Impact</strong> — Mentees improved by avg. 96%</div>
            <div class="progress-track">
                <div class="progress-label"><span>Student completion rate</span><span>89%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 89%;"></div></div>
            </div>
            <div><i class="fas fa-medal"></i> Expert of the Month (March)</div>
            <button class="btn-outline" style="margin-top: 14px; width: 100%;"><i class="fas fa-chart-simple"></i> View analytics</button>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div><i class="fas fa-calendar-alt" style="color: var(--primary);"></i> <strong>Host a group mentorship session</strong> — Invite up to 20 students</div>
        <div style="display: flex; gap: 12px;">
            <button style="width: auto; background: transparent; border: 1px solid var(--primary); color: var(--primary);">Schedule</button>
            <button style="width: auto;"><i class="fas fa-chalkboard"></i> Launch webinar</button>
        </div>
    </div>
</div>

<script>
    // AI Assistant Generate Button
    const aiGenerate = document.querySelector('.card button:not(.btn-sm)');
    if(aiGenerate && aiGenerate.innerText.includes('Generate')) {
        aiGenerate.addEventListener('click', () => {
            const inputField = document.querySelector('.card input');
            const query = inputField ? inputField.value : "learning plan";
            alert(`✨ AI Assistant: Generating personalized academic growth plan for "${query}".`);
        });
    }
    
    // Handle accept requests, join session
    const actionBtns = document.querySelectorAll('.btn-sm');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            if(btn.innerText.includes('Accept')) alert("✅ Mentorship request accepted.");
            else if(btn.innerText.includes('Join')) alert("🔗 Joining mentorship session.");
            else if(btn.innerText.includes('Prepare')) alert("📚 Add preparation notes.");
            else alert("Action updated.");
        });
    });
    
    // Badge links
    document.querySelectorAll('.badge-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            alert("📊 Full analytics and tracking available.");
        });
    });
    
    // Quick action buttons
    document.querySelectorAll('.quick-actions button').forEach(btn => {
        btn.addEventListener('click', () => alert("🎓 Schedule a group mentorship session."));
    });
    
    // Action icons
    document.querySelectorAll('.action-icon').forEach(icon => {
        icon.addEventListener('click', () => alert("View mentee details and progress."));
    });
</script>

</body>
</html>