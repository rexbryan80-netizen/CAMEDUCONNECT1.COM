<?php
session_start();
require_once '../../model/db.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Your head content -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Institutes </title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome 6 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f0f4ff 0%, #e8edf5 100%);
        font-family: 'Inter', 'Plus Jakarta Sans', 'Poppins', sans-serif;
        min-height: 100vh;
    }

    /* navbar wrapper spacing (since navbar is included) */
    main {
        padding-top: 1rem;
    }

    /* header section with modern gradient */
    .institutes-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 2rem;
        padding: 2rem 2rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 15px 35px -12px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }

    .institutes-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(56,189,248,0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .institutes-header h2 {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .institutes-header p {
        color: #94a3b8;
        font-weight: 500;
        margin: 0;
    }

    /* card grid improvements */
    .institute-grid {
        margin-bottom: 3rem;
    }

    /* modern card design - dashboard style */
    .institute-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(0px);
        border-radius: 1.5rem;
        transition: all 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(56,189,248,0.2);
        box-shadow: 0 10px 25px -8px rgba(0,0,0,0.08);
    }

    .institute-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 40px -12px rgba(0,0,0,0.2);
        border-color: rgba(56,189,248,0.4);
    }

    /* image container with overlay effect */
    .card-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .institute-card:hover .card-img-top {
        transform: scale(1.08);
    }

    .img-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        height: 60px;
        pointer-events: none;
    }

    /* card body styling */
    .card-body-custom {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        background: white;
    }

    .institute-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.75rem;
        letter-spacing: -0.3px;
        line-height: 1.3;
    }

    .region-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #f1f5f9;
        padding: 0.4rem 1rem;
        border-radius: 2rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 1rem;
        width: fit-content;
    }

    .region-badge i {
        color: #38bdf8;
        font-size: 0.8rem;
    }

    .description-text {
        font-size: 0.9rem;
        color: #334155;
        line-height: 1.5;
        margin-bottom: 1.25rem;
        flex: 1;
    }

    /* button modern */
    .btn-programs {
        background: linear-gradient(105deg, #0f172a, #1e293b);
        border: 1px solid #38bdf8;
        border-radius: 2rem;
        padding: 0.75rem 1.25rem;
        font-weight: 700;
        font-size: 0.9rem;
        color: #38bdf8;
        transition: all 0.25s ease;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
    }

    .btn-programs i {
        transition: transform 0.2s;
    }

    .btn-programs:hover {
        background: linear-gradient(105deg, #1e293b, #0f172a);
        border-color: #7dd3fc;
        color: #7dd3fc;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(56,189,248,0.25);
    }

    .btn-programs:active {
        transform: translateY(1px);
    }

    /* empty state styling */
    .empty-state {
        background: white;
        border-radius: 1.5rem;
        padding: 3rem;
        text-align: center;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
        border: 1px dashed #cbd5e1;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #475569;
        font-weight: 500;
    }

    /* floating action vibe */
    .container-custom {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem 2rem;
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 1rem 1.25rem;
        }
        .institutes-header {
            padding: 1.5rem;
        }
        .institutes-header h2 {
            font-size: 1.7rem;
        }
        .institute-name {
            font-size: 1.3rem;
        }
    }

    /* subtle animation */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .institute-card {
        animation: fadeUp 0.5s ease forwards;
    }
</style>
</head>
<body>
<?php include "../include/navbar.php"; ?>

<div class="container-custom">
    <!-- Header section with modern dashboard vibe -->
    <div class="institutes-header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h2><i class="fas fa-building me-2"></i> Our Institutes</h2>
                <p><i class="fas fa-map-marker-alt me-1"></i> Discover excellence — Explore top-rated institutes and their programs</p>
            </div>
            <div class="mt-3 mt-md-0">
                <span class="badge bg-white/10 text-primary px-4 py-2 rounded-pill" style="background: rgba(56,189,248,0.15); color:#38bdf8; font-weight:600;">
                    <i class="fas fa-school me-1"></i> Quality Education
                </span>
            </div>
        </div>
    </div>

    <!-- Institutes Grid - Same logic: ORDER BY id ASC (oldest first) -->
    <div class="institute-grid">
        <div class="row g-4 justify-content-center align-items-stretch">
            <?php
            // Original query logic preserved exactly
            $sql = "SELECT * FROM institutes ORDER BY id ASC"; // Oldest first
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    // safe image path handling
                    $imagePath = '../uploads/' . htmlspecialchars($row['image']);
                    // description trim logic preserved
                    $description = strlen($row['description']) > 120 ? substr($row['description'],0,120).'...' : $row['description'];
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                <div class="institute-card w-100">
                    <div class="card-img-wrapper">
                        <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" onerror="this.src='https://placehold.co/600x400/1e293b/38bdf8?text=Institute'">
                        <div class="img-overlay"></div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="institute-name"><?= htmlspecialchars($row['name']) ?></h3>
                        <div class="region-badge">
                            <i class="fas fa-location-dot"></i> 
                            <span><?= htmlspecialchars($row['region']) ?></span>
                        </div>
                        <p class="description-text"><?= nl2br(htmlspecialchars($description)) ?></p>
                        <div class="mt-auto">
                            <a href="institute-detail.php?id=<?= $row['id'] ?>" class="btn-programs">
                                <i class="fas fa-graduation-cap"></i> View Programs
                                <i class="fas fa-arrow-right ms-1" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-building-circle-xmark"></i>
                            <p class="fw-semibold mb-0">No institutes found.</p>
                            <small class="text-muted">Check back later for new listings</small>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle (optional for interactivity) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Optional: add any interactive enhancements without breaking logic
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth entrance for cards (already handled via CSS)
        // Add fallback for broken images
        const images = document.querySelectorAll('.card-img-top');
        images.forEach(img => {
            img.addEventListener('error', function() {
                this.src = 'https://placehold.co/600x400/1e293b/38bdf8?text=Image+Not+Found';
            });
        });
    });
</script>
</body>
</html>