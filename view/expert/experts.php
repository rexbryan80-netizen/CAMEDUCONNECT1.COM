<?php
include("../../model/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Our Experts | Cameroon Pro</title>

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
        --warning: #f59e0b;
        --danger: #ef4444;
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
    }

    /* Header Section */
    .experts-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 60px 0 40px;
        position: relative;
        overflow: hidden;
    }

    .experts-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }

    .experts-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }

    .header-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .header-content h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .header-content h1 i {
        font-size: 2.5rem;
    }

    .header-content p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Stats Section */
    .stats-section {
        margin-top: -30px;
        margin-bottom: 40px;
    }

    .stats-container {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 0 20px;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 20px;
        text-align: center;
        box-shadow: var(--shadow-lg);
        transition: var(--transition);
        border: 1px solid var(--gray-200);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 6px;
    }

    /* Expert Cards Grid */
    .experts-grid {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 24px 60px;
    }

    .section-title {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-title h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 12px;
    }

    .section-title p {
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 28px;
    }

    /* Expert Card Premium */
    .expert-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        border: 1px solid var(--gray-200);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .expert-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    /* Card Header with Gradient */
    .card-header-gradient {
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        padding: 24px;
        text-align: center;
        position: relative;
    }

    .expert-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--white);
        box-shadow: var(--shadow-md);
        margin-bottom: 12px;
    }

    .avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .avatar-placeholder i {
        font-size: 3rem;
        color: var(--white);
    }

    .expert-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 4px;
    }

    .region-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 500;
        color: var(--white);
    }

    /* Card Body */
    .card-body {
        padding: 20px;
        flex: 1;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .info-item i {
        width: 24px;
        color: var(--primary);
        font-size: 1rem;
    }

    .info-item strong {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-600);
        min-width: 95px;
    }

    .info-item span {
        font-size: 0.8rem;
        color: var(--gray-700);
        flex: 1;
    }

    .expert-bio {
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid var(--gray-200);
        font-size: 0.8rem;
        color: var(--gray-600);
        line-height: 1.5;
        font-style: italic;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 16px;
    }

    .empty-state p {
        color: var(--gray-500);
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .grid-container {
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        }
        
        .stats-container {
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
    }

    @media (max-width: 768px) {
        .header-content h1 {
            font-size: 1.8rem;
        }
        
        .header-content h1 i {
            font-size: 1.8rem;
        }
        
        .experts-grid {
            padding: 30px 20px 50px;
        }
        
        .grid-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .stats-container {
            grid-template-columns: 1fr;
            gap: 12px;
            max-width: 300px;
        }
        
        .stats-section {
            margin-top: -20px;
        }
        
        .section-title h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .expert-avatar {
            width: 100px;
            height: 100px;
        }
        
        .info-item {
            flex-wrap: wrap;
        }
        
        .info-item strong {
            min-width: auto;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .expert-card {
        animation: fadeInUp 0.4s ease backwards;
    }
</style>
</head>
<body>

<?php include "../include/navbar.php"; ?>

<!-- Hero Header -->
<div class="experts-header">
    <div class="header-content">
        <h1>
            <i class="bi bi-person-badge"></i>
            Our Experts
        </h1>
        <p>Meet our team of qualified mentors dedicated to guiding students toward academic excellence</p>
    </div>
</div>

<!-- Stats Section -->
<?php
$totalExperts = $conn->query("SELECT COUNT(*) as total FROM experts")->fetch_assoc()['total'] ?? 0;
$specialties = $conn->query("SELECT COUNT(DISTINCT specialization) as specs FROM experts WHERE specialization IS NOT NULL")->fetch_assoc()['specs'] ?? 0;
$regions = $conn->query("SELECT COUNT(DISTINCT region) as regions FROM experts WHERE region IS NOT NULL")->fetch_assoc()['regions'] ?? 0;
?>
<div class="stats-section">
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number"><?= $totalExperts ?></div>
            <div class="stat-label">Expert Mentors</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $specialties ?></div>
            <div class="stat-label">Specializations</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $regions ?></div>
            <div class="stat-label">Regions Covered</div>
        </div>
    </div>
</div>

<!-- Experts Grid -->
<div class="experts-grid">
    <div class="section-title">
        <h2>Meet Our Expert Team</h2>
        <p>Experienced professionals ready to help you succeed</p>
    </div>

    <div class="grid-container">
        <?php
        $sql = "SELECT * FROM experts ORDER BY id DESC";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($expert = $result->fetch_assoc()){
                $imgPath = !empty($expert['profile_image']) && file_exists("../../assets/images/experts/".$expert['profile_image']) 
                           ? "../../assets/images/experts/".$expert['profile_image'] 
                           : null;
                $initial = strtoupper(substr($expert['full_name'], 0, 1));
                $bio = !empty($expert['bio']) ? $expert['bio'] : "Dedicated mentor committed to helping students achieve their academic goals.";
        ?>
        <div class="expert-card">
            <div class="card-header-gradient">
                <?php if($imgPath): ?>
                    <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($expert['full_name']) ?>" class="expert-avatar">
                <?php else: ?>
                    <div class="avatar-placeholder">
                        <i class="bi bi-person-circle"></i>
                    </div>
                <?php endif; ?>
                <h3 class="expert-name"><?= htmlspecialchars($expert['full_name']) ?></h3>
                <span class="region-badge">
                    <i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($expert['region'] ?? 'Cameroon') ?>
                </span>
            </div>
            <div class="card-body">
                <div class="info-item">
                    <i class="bi bi-star-fill"></i>
                    <strong>Specialization:</strong>
                    <span><?= htmlspecialchars($expert['specialization'] ?? 'General Expert') ?></span>
                </div>
                <div class="info-item">
                    <i class="bi bi-award"></i>
                    <strong>Qualification:</strong>
                    <span><?= htmlspecialchars($expert['qualification'] ?? 'Professional Expert') ?></span>
                </div>
                <div class="info-item">
                    <i class="bi bi-envelope"></i>
                    <strong>Contact:</strong>
                    <span><?= htmlspecialchars($expert['email'] ?? 'Available on request') ?></span>
                </div>
                <div class="expert-bio">
                                    <i class="bi bi-quote"></i>
                    <?= strlen($bio) > 100 ? substr($bio, 0, 100) . '...' : htmlspecialchars($bio) ?>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
        ?>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add staggered animation to cards
    const cards = document.querySelectorAll('.expert-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
    });
    
    // Lazy loading for images
    const images = document.querySelectorAll('.expert-avatar');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.opacity = '1';
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
        imageObserver.observe(img);
    });
</script>

</body>
</html>