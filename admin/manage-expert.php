<?php
// manage-expert.php - Professional Expert Management Dashboard
include("../model/db.php");

// Fetch expert statistics
$totalExperts = $conn->query("SELECT COUNT(*) as total FROM experts")->fetch_assoc()['total'] ?? 0;
$specialties = $conn->query("SELECT COUNT(DISTINCT specialization) as specialties FROM experts WHERE specialization IS NOT NULL")->fetch_assoc()['specialties'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Manage Experts | Cameroon Pro</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: var(--gray-100);
        color: var(--gray-800);
        line-height: 1.5;
        min-height: 100vh;
    }

    /* Main Content Area */
    .main-content {
        margin-left: 280px;
        padding: 28px 32px;
        min-height: 100vh;
        transition: var(--transition);
    }

    /* Page Header */
    .page-header {
        margin-bottom: 32px;
    }

    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header h1 i {
        color: var(--primary);
        font-size: 2rem;
    }

    .page-header p {
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
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

    .stat-info h3 {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .stat-trend.up {
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

    /* Action Cards Grid */
    .action-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 28px;
        margin-bottom: 32px;
    }

    .action-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        border: 1px solid var(--gray-200);
        position: relative;
    }

    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .card-gradient {
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .card-icon {
        width: 70px;
        height: 70px;
        background: var(--primary-bg);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .card-icon i {
        font-size: 2rem;
        color: var(--primary);
    }

    .card-content {
        padding: 28px;
    }

    .card-content h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--gray-800);
    }

    .card-content p {
        color: var(--gray-500);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 24px;
    }

    .btn-card {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-primary-card {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
    }

    .btn-primary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
    }

    .btn-warning-card {
        background: linear-gradient(135deg, var(--warning), #d97706);
        color: var(--white);
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
    }

    .btn-warning-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);
    }

    /* Recent Experts Section */
    .recent-section {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-top: 8px;
    }

    .section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        background: var(--gray-50);
    }

    .section-header h3 {
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-700);
    }

    .expert-list {
        padding: 8px 0;
    }

    .expert-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-bottom: 1px solid var(--gray-100);
        transition: var(--transition);
    }

    .expert-item:hover {
        background: var(--gray-50);
    }

    .expert-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .expert-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .expert-details h4 {
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .expert-details p {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .expert-stats {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .expert-badge {
        background: var(--success-bg);
        color: var(--success);
        padding: 4px 10px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .expert-link {
        color: var(--primary);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        color: var(--gray-700);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--transition);
        margin-top: 20px;
    }

    .back-button:hover {
        background: var(--gray-50);
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }
        
        .action-cards {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 16px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .expert-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        
        .expert-stats {
            width: 100%;
            justify-content: space-between;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .card-content {
            padding: 20px;
        }
        
        .expert-info {
            flex-wrap: wrap;
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

    .stat-card, .action-card, .recent-section {
        animation: fadeInUp 0.4s ease backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stat-card:nth-child(4) { animation-delay: 0.2s; }
    .action-card:nth-child(1) { animation-delay: 0.25s; }
    .action-card:nth-child(2) { animation-delay: 0.3s; }
</style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-person-badge"></i>
            Manage Experts
        </h1>
        <p>Add, view, edit, and manage all expert mentors in the Cameroon Pro network</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Experts</h3>
                <div class="stat-number"><?= $totalExperts ?></div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up-short"></i> +4 this month
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Active Mentors</h3>
                <div class="stat-number"><?= $activeExperts ?></div>
                <div class="stat-trend up">
                    <i class="bi bi-check-circle-fill"></i> Available
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-person-check"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Specializations</h3>
                <div class="stat-number"><?= $specialties ?></div>
                <div class="stat-trend">
                    <i class="bi bi-tags"></i> Diverse fields
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-star"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Active Mentees</h3>
                <div class="stat-number">286</div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up-short"></i> +18%
                </div>
            </div>
            <div class="stat-icon">
                <i class="bi bi-mortarboard"></i>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="action-cards">
        <!-- Add Expert Card -->
        <div class="action-card">
            <div class="card-gradient"></div>
            <div class="card-content">
                <div class="card-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h3>Add New Expert</h3>
                <p>Register a new expert mentor with complete profile including name, email, specialization, region, and professional experience.</p>
                <a href="../view/expert/add-expert.php" class="btn-card btn-primary-card">
                    <i class="bi bi-plus-lg"></i> Add Expert
                </a>
            </div>
        </div>

        <!-- View/Edit Experts Card -->
        <div class="action-card">
            <div class="card-gradient"></div>
            <div class="card-content">
                <div class="card-icon">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <h3>View All Experts</h3>
                <p>Browse through all registered experts, edit their profiles, update specializations, or remove inactive mentors from the system.</p>
                <a href="../view/expert/view-expert.php" class="btn-card btn-warning-card">
                    <i class="bi bi-eye"></i> View Experts
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Experts Preview -->
    <div class="recent-section">
        <div class="section-header">
            <h3>
                <i class="bi bi-clock-history"></i>
                Recently Added Experts
            </h3>
            <a href="../view/expert/view-expert.php" class="expert-link">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="expert-list">
            <?php
            // Fetch recent experts
            $recentExperts = $conn->query("SELECT * FROM experts ORDER BY id DESC LIMIT 3");
            if ($recentExperts->num_rows > 0):
                while($expert = $recentExperts->fetch_assoc()):
                    $initial = strtoupper(substr($expert['full_name'], 0, 1));
            ?>
                <div class="expert-item">
                    <div class="expert-info">
                        <div class="expert-avatar">
                            <?= $initial ?>
                        </div>
                        <div class="expert-details">
                            <h4><?= htmlspecialchars($expert['full_name']) ?></h4>
                            <p><i class="bi bi-briefcase"></i> <?= htmlspecialchars($expert['specialization'] ?? 'General Expert') ?> • <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($expert['region'] ?? 'Cameroon') ?></p>
                        </div>
                    </div>
                    <div class="expert-stats">
                        <span class="expert-badge">
                            <i class="bi bi-check-circle-fill"></i> Active
                        </span>
                        <a href="../view/expert/edit-expert.php?id=<?= $expert['id'] ?>" class="expert-link">
                            Edit <i class="bi bi-pencil"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php else: ?>
                <div class="expert-item">
                    <div class="expert-info">
                        <div class="expert-avatar">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="expert-details">
                            <h4>No experts yet</h4>
                            <p>Start by adding your first expert mentor</p>
                        </div>
                    </div>
                    <div class="expert-stats">
                        <a href="../view/expert/add-expert.php" class="expert-link">
                            Add Now <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center" style="margin-top: 24px;">
        <a href="admindashboard.php" class="back-button">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add hover effects for action cards
    const actionCards = document.querySelectorAll('.action-card');
    actionCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-8px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
    
    // Animation for stats numbers (simple counter effect)
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const target = parseInt(stat.textContent);
        let current = 0;
        const increment = target / 50;
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                stat.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                stat.textContent = target;
            }
        };
        // Only animate if the number is visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.disconnect();
                }
            });
        });
        observer.observe(stat);
    });
</script>

</body>
</html>