<?php
include("../../model/db.php"); // Database connection

$students = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Our Students | Cameroon Pro</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    .students-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 60px 0 40px;
        position: relative;
        overflow: hidden;
    }

    .students-header::before {
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

    .students-header::after {
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

    /* Filter Bar */
    .filter-bar {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 24px 24px;
    }

    .search-container {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 12px 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        position: relative;
        min-width: 200px;
    }

    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
    }

    .search-box input {
        width: 100%;
        padding: 10px 12px 10px 38px;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        font-size: 0.85rem;
        font-family: inherit;
        transition: var(--transition);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .filter-select {
        padding: 10px 16px;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        font-size: 0.85rem;
        background: var(--white);
        cursor: pointer;
        min-width: 140px;
    }

    .stats-badge {
        background: var(--primary-bg);
        color: var(--primary);
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Students Grid */
    .students-grid {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 24px 60px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 28px;
    }

    /* Student Card Premium */
    .student-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        border: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
    }

    .student-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    /* Card Image Section */
    .card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
    }

    .student-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .student-card:hover .student-image {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        padding: 16px;
    }

    .region-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(255, 255, 255, 0.9);
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--primary);
    }

    /* Card Content */
    .card-content {
        padding: 20px;
        flex: 1;
    }

    .student-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .student-name i {
        color: var(--success);
        font-size: 0.9rem;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid var(--gray-200);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        color: var(--gray-600);
    }

    .info-item i {
        color: var(--primary);
        font-size: 0.8rem;
    }

    .details-grid {
        margin-top: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.8rem;
    }

    .detail-item i {
        width: 24px;
        color: var(--primary);
        font-size: 0.9rem;
    }

    .detail-item strong {
        color: var(--gray-600);
        font-weight: 600;
        min-width: 60px;
    }

    .detail-item span {
        color: var(--gray-700);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--success-bg);
        color: var(--success);
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 12px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        grid-column: 1/-1;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 16px;
    }

    .empty-state p {
        color: var(--gray-500);
        margin-bottom: 0;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .grid-container {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
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
        
        .students-grid {
            padding: 0 16px 40px;
        }
        
        .grid-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .stats-container {
            grid-template-columns: 1fr;
            gap: 12px;
            max-width: 280px;
        }
        
        .stats-section {
            margin-top: -20px;
        }
        
        .search-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-box {
            width: 100%;
        }
        
        .filter-select {
            width: 100%;
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

    .student-card {
        animation: fadeInUp 0.4s ease backwards;
    }
</style>
</head>

<body>

<?php include "../include/navbar.php"; ?>

<!-- Hero Header -->
<div class="students-header">
    <div class="header-content">
        <h1>
            <i class="bi bi-mortarboard"></i>
            Our Students
        </h1>
        <p>Meet the bright minds shaping the future of Cameroon through education</p>
    </div>
</div>

<!-- Stats Section -->
<?php
$totalStudents = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'] ?? 0;
$regions = $conn->query("SELECT COUNT(DISTINCT region) as regions FROM students WHERE region IS NOT NULL")->fetch_assoc()['regions'] ?? 0;
?>
<div class="stats-section">
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number"><?= $totalStudents ?></div>
            <div class="stat-label">Active Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $regions ?></div>
            <div class="stat-label">Regions Covered</div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="filter-bar">
    <div class="search-container">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Search by name, region, or course...">
        </div>
        <select id="regionFilter" class="filter-select">
            <option value="">All Regions</option>
            <option>Centre</option><option>Littoral</option><option>West</option>
            <option>North West</option><option>South West</option><option>Adamawa</option>
            <option>North</option><option>Far North</option><option>East</option><option>South</option>
        </select>
        <div class="stats-badge">
            <i class="bi bi-people"></i> <?= $totalStudents ?> Students
        </div>
    </div>
</div>

<!-- Students Grid -->
<div class="students-grid">
    <div class="grid-container" id="studentsGrid">
        <?php if($students && $students->num_rows > 0): ?>
        <?php while($row = $students->fetch_assoc()): 
            $name    = htmlspecialchars($row['full_name']);
            $region  = htmlspecialchars($row['region'] ?? 'Not specified');
            $email   = htmlspecialchars($row['email'] ?? 'N/A');
            $phone   = htmlspecialchars($row['phone'] ?? 'N/A');
            $course  = htmlspecialchars($row['course'] ?? 'Not enrolled');
            $initial = strtoupper(substr($name, 0, 1));

            // Image handling
            $imgUrl = null;
            if (!empty($row['profile_image'])) {
                $imgFile = $row['profile_image'];
                $serverPath = $_SERVER['DOCUMENT_ROOT']."/CAMEDUCONNECT/uploads/students/".$imgFile;
                if(file_exists($serverPath)){
                    $imgUrl = "/CAMEDUCONNECT/uploads/students/".$imgFile;
                }
            }
        ?>
        <div class="student-card" data-name="<?= strtolower($name) ?>" data-region="<?= strtolower($region) ?>" data-course="<?= strtolower($course) ?>">
            <div class="card-image">
                <?php if($imgUrl): ?>
                    <img src="<?= $imgUrl ?>" class="student-image" alt="<?= $name ?>">
                <?php else: ?>
                    <div class="student-image" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary-light), var(--primary));">
                        <i class="bi bi-person-circle" style="font-size: 4rem; color: rgba(255,255,255,0.7);"></i>
                    </div>
                <?php endif; ?>
                <div class="image-overlay">
                    <span class="region-badge">
                        <i class="bi bi-geo-alt-fill"></i> <?= $region ?>
                    </span>
                </div>
            </div>
            <div class="card-content">
                <div class="student-name">
                    <?= $name ?>
                    <i class="bi bi-check-circle-fill" style="font-size: 0.8rem;"></i>
                </div>
                <div class="details-grid">
                    <div class="detail-item">
                        <i class="bi bi-envelope"></i>
                        <strong>Email:</strong>
                        <span><?= $email ?></span>
                    </div>
                    <div class="detail-item">
                        <i class="bi bi-telephone"></i>
                        <strong>Phone:</strong>
                        <span><?= $phone ?></span>
                    </div>
                    <div class="detail-item">
                        <i class="bi bi-journal-bookmark"></i>
                        <strong>Course:</strong>
                        <span><?= $course ?></span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <i class="bi bi-calendar3"></i>
                        <span>Joined 2024</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-star-fill"></i>
                        <span>Active Member</span>
                    </div>
                </div>
                <div class="status-badge">
                    <i class="bi bi-check-circle-fill"></i> Verified Student
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <p>No students found in the database.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Search and Filter Functionality
    const searchInput = document.getElementById('searchInput');
    const regionFilter = document.getElementById('regionFilter');
    const studentsGrid = document.getElementById('studentsGrid');
    
    function filterStudents() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRegion = regionFilter.value.toLowerCase();
        const cards = document.querySelectorAll('.student-card');
        
        cards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const region = card.getAttribute('data-region') || '';
            const course = card.getAttribute('data-course') || '';
            
            const matchesSearch = name.includes(searchTerm) || course.includes(searchTerm);
            const matchesRegion = selectedRegion === '' || region === selectedRegion;
            
            if (matchesSearch && matchesRegion) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    if (searchInput) searchInput.addEventListener('keyup', filterStudents);
    if (regionFilter) regionFilter.addEventListener('change', filterStudents);
    
    // Staggered animation for cards
    const cards = document.querySelectorAll('.student-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
    });
    
    // Set data attributes for filtering
    document.querySelectorAll('.student-card').forEach(card => {
        const name = card.querySelector('.student-name')?.textContent.trim() || '';
        const region = card.querySelector('.region-badge')?.textContent.replace(/[^\w\s]/g, '').trim() || '';
        const course = card.querySelector('.detail-item:last-child span')?.textContent.trim() || '';
        card.setAttribute('data-name', name.toLowerCase());
        card.setAttribute('data-region', region.toLowerCase());
        card.setAttribute('data-course', course.toLowerCase());
    });
    
    // Lazy loading for images
    const images = document.querySelectorAll('.student-image');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.tagName === 'IMG') {
                    img.style.opacity = '1';
                }
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => {
        if (img.tagName === 'IMG') {
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
            imageObserver.observe(img);
        }
    });
</script>

</body>
</html>