<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cameroon Education Connect | Empowering Futures</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap 5 + Icons + Google Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: #f8fafc;
        overflow-x: hidden;
    }

    /* Modern Hero Section with Attractive Static Image */
    .hero {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }

    /* Attractive Static Background Image */
    .hero-bg-image {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.pexels.com/photos/5212345/pexels-photo-5212345.jpeg?auto=compress&cs=tinysrgb&w=1600') center/cover no-repeat;
        background-attachment: fixed;
        z-index: 0;
        transition: transform 0.3s ease-out;
    }

    /* Overlay for better text readability */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(10,15,28,0.75) 0%, rgba(15,23,42,0.85) 100%);
        z-index: 1;
    }

    .hero .container {
        position: relative;
        z-index: 2;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-badge {
        display: inline-block;
        background: rgba(56, 189, 248, 0.15);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1.2rem;
        border-radius: 3rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #38bdf8;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(56, 189, 248, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(56, 189, 248, 0.4); }
        50% { box-shadow: 0 0 0 10px rgba(56, 189, 248, 0); }
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
    }

    .hero-title .gradient-text {
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    #typed-text {
        background: linear-gradient(135deg, #fff, #cbd5e1);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    #cursor {
        display: inline-block;
        background: #38bdf8;
        margin-left: 4px;
        width: 3px;
        height: 1.2em;
        animation: blink 0.8s infinite;
        vertical-align: middle;
        border-radius: 2px;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    .hero p {
        font-size: 1.2rem;
        color: #cbd5e1;
        max-width: 600px;
        margin: 0 auto;
    }

    .btn-hero {
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        border: none;
        padding: 0.9rem 2.2rem;
        border-radius: 3rem;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(56, 189, 248, 0.3);
    }

    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(56, 189, 248, 0.4);
        background: linear-gradient(135deg, #2ea5e0, #6f6af0);
    }

    /* Section Titles */
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 2.5rem;
        position: relative;
        display: inline-block;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 70px;
        height: 4px;
        background: linear-gradient(90deg, #38bdf8, #818cf8);
        border-radius: 4px;
    }

    /* Feature Cards - Modern Glassmorphism */
    .feature-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(0px);
        border-radius: 1.5rem;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        border: 1px solid rgba(56, 189, 248, 0.15);
        box-shadow: 0 10px 25px -8px rgba(0,0,0,0.05);
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        border-color: #38bdf8;
        box-shadow: 0 20px 35px -12px rgba(56, 189, 248, 0.2);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #e0f2fe, #ede9fe);
        border-radius: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        transition: all 0.3s;
    }

    .feature-card:hover .feature-icon {
        background: linear-gradient(135deg, #38bdf8, #818cf8);
    }

    .feature-icon i {
        font-size: 2rem;
        color: #0f172a;
        transition: all 0.3s;
    }

    .feature-card:hover .feature-icon i {
        color: white;
    }

    .feature-card h5 {
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #0f172a;
    }

    .feature-card p {
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        border-radius: 2rem;
        padding: 2.5rem;
        margin: 2rem 0;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #38bdf8;
    }

    /* Modern Cards for Institutes/Experts/Students */
    .modern-card {
        background: white;
        border-radius: 1.2rem;
        overflow: hidden;
        transition: all 0.35s ease;
        box-shadow: 0 10px 25px -8px rgba(0,0,0,0.08);
        height: 100%;
        border: 1px solid #e2e8f0;
    }

    .modern-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15);
        border-color: #38bdf8;
    }

    .modern-card-img {
        height: 220px;
        width: 100%;
        object-fit: cover;
    }

    .modern-card-body {
        padding: 1.2rem;
        text-align: center;
    }

    .modern-card-body h5 {
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }

    .modern-card-body p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 0;
    }

    /* Testimonial Section - Authentic Cameroonian Students */
    .testimonial-modern {
        background: linear-gradient(135deg, #f1f5f9, #eef2ff);
        border-radius: 2rem;
        padding: 3rem 2rem;
        margin: 2rem 0;
    }

    .testimonial-card-modern {
        background: white;
        border-radius: 1.5rem;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 15px 30px -12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .testimonial-card-modern:hover {
        transform: translateY(-5px);
        border-color: #38bdf8;
    }

    .testimonial-avatar {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1rem;
        border: 3px solid #38bdf8;
        padding: 3px;
        background: #fff;
    }

    .testimonial-text {
        font-size: 0.95rem;
        color: #334155;
        line-height: 1.6;
        font-style: italic;
        margin-bottom: 1rem;
    }

    .testimonial-name {
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.2rem;
    }

    .testimonial-region {
        font-size: 0.75rem;
        color: #38bdf8;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .stars {
        color: #fbbf24;
        margin-bottom: 0.8rem;
    }

    /* CTA Section */
    .cta-modern {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        border-radius: 2rem;
        padding: 3rem;
        text-align: center;
        margin: 2rem 0;
    }

    .cta-modern h2 {
        font-size: 2rem;
        font-weight: 800;
        color: white;
    }

    .btn-cta {
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 3rem;
        font-weight: 700;
        color: white;
        transition: all 0.3s;
    }

    .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(56, 189, 248, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        .section-title {
            font-size: 1.6rem;
        }
        .stat-number {
            font-size: 1.8rem;
        }
        .testimonial-card-modern {
            padding: 1.5rem;
        }
        .hero-bg-image {
            background-attachment: scroll;
        }
    }
</style>
</head>
<body>

<?php
include '../include/navbar.php';
include '../../model/db.php';

// Fetch only first 3 records
$institutes = $conn->query("SELECT * FROM institutes ORDER BY id DESC LIMIT 3");
$students   = $conn->query("SELECT * FROM students ORDER BY id DESC LIMIT 3");
$experts    = $conn->query("SELECT * FROM experts ORDER BY id DESC LIMIT 3");

// Paths to images folders
$institutePath = "../uploads/";
$studentPath   = "../../uploads/students/";
$expertPath    = "../../assets/images/experts/";

// Placeholder fallback images
$placeholderInstitute = "https://placehold.co/600x400/1e293b/38bdf8?text=Institute";
$placeholderStudent   = "https://placehold.co/600x400/1e293b/38bdf8?text=Student";
$placeholderExpert    = "https://placehold.co/600x400/1e293b/38bdf8?text=Expert";
?>
<!-- HERO SECTION WITH STUDENT ON COMPUTER AND TYPING TEXT - COMPACT VERSION -->
<section class="hero" style="position:relative; min-height:70vh; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden;">
    
    <!-- Background Image with Parallax Effect -->
    <div class="hero-bg-image" style="
        position:absolute; top:0; left:0; right:0; bottom:0;
        background:url('https://images.pexels.com/photos/5212345/pexels-photo-5212345.jpeg?auto=compress&cs=tinysrgb&w=1200') center/cover no-repeat;
        background-size:cover;
        background-attachment: fixed;
        transition: opacity 0.8s ease-in-out, transform 0.3s ease-out;
        z-index:0;
    "></div>

    <!-- Gradient Overlay for better readability -->
    <div class="hero-overlay" style="
        position:absolute; top:0; left:0; right:0; bottom:0;
        background: linear-gradient(135deg, rgba(10,15,28,0.8) 0%, rgba(15,23,42,0.85) 100%);
        z-index:1;
    "></div>

    <!-- Foreground Content -->
    <div class="container" style="position:relative; z-index:2; animation: fadeInUp 0.8s ease-out; padding:2rem 1rem;">
        <div class="hero-badge" style="display:inline-block; background:rgba(56,189,248,0.15); backdrop-filter:blur(8px); padding:0.4rem 1.2rem; border-radius:3rem; font-size:0.75rem; font-weight:600; color:#38bdf8; margin-bottom:1rem; border:1px solid rgba(56,189,248,0.4);">
            <i class="fas fa-graduation-cap me-1"></i> Cameroon's #1 Platform
        </div>
        <h1 class="hero-title" style="font-size:2.2rem; font-weight:800; color:white; margin-bottom:0.75rem; letter-spacing:-0.02em;">
            <span id="typed-text" style="background:linear-gradient(135deg, #fff, #cbd5e1); -webkit-background-clip:text; background-clip:text; color:transparent;"></span>
            <span id="cursor" style="display:inline-block; width:2px; height:1.1em; background:#38bdf8; margin-left:4px; animation:blink 0.8s infinite; vertical-align:middle; border-radius:2px;"></span>
        </h1>
        <p style="color:#cbd5e1; font-size:0.95rem; max-width:550px; margin:0 auto; line-height:1.5;">Empowering young Cameroonian students through digital education, verified institutes, and expert mentorship.</p>
        
        <!-- CTA Buttons -->
        <div class="hero-buttons" style="margin-top:1.5rem; display:flex; gap:0.8rem; justify-content:center; flex-wrap:wrap;">
            <a href="../register.php" class="btn-hero-primary" style="background:linear-gradient(135deg, #38bdf8, #818cf8); color:white; border:none; padding:0.7rem 1.8rem; border-radius:3rem; font-weight:600; font-size:0.9rem; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem; transition:all 0.3s ease; box-shadow:0 4px 12px rgba(56,189,248,0.3);">
                Get Started <i class="fas fa-arrow-right" style="font-size:0.8rem;"></i>
            </a>
            <a href="../institute/institute.php" class="btn-hero-secondary" style="background:rgba(255,255,255,0.1); backdrop-filter:blur(8px); color:white; border:1px solid rgba(56,189,248,0.4); padding:0.7rem 1.8rem; border-radius:3rem; font-weight:600; font-size:0.9rem; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem; transition:all 0.3s ease;">
                Explore <i class="fas fa-building" style="font-size:0.8rem;"></i>
            </a>
        </div>

        <!-- Scroll Indicator - Smaller -->
        <div class="scroll-indicator" style="position:absolute; bottom:-40px; left:50%; transform:translateX(-50%); display:flex; flex-direction:column; align-items:center; gap:0.3rem; cursor:pointer;" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <span style="font-size:0.6rem; color:#94a3b8;">Scroll</span>
            <div style="width:20px; height:32px; border:1.5px solid #38bdf8; border-radius:15px; position:relative;">
                <div style="width:3px; height:6px; background:#38bdf8; border-radius:2px; position:absolute; top:5px; left:50%; transform:translateX(-50%); animation: scrollBounce 1.5s infinite;"></div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

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

@keyframes scrollBounce {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 1; }
    50% { transform: translateX(-50%) translateY(6px); opacity: 0.5; }
}

.btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(56, 189, 248, 0.4);
    background: linear-gradient(135deg, #2ea5e0, #6f6af0);
}

.btn-hero-secondary:hover {
    background: rgba(56, 189, 248, 0.2);
    transform: translateY(-2px);
    border-color: #38bdf8;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.6rem !important;
    }
    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }
    .btn-hero-primary, .btn-hero-secondary {
        width: 80%;
        justify-content: center;
    }
    .hero {
        min-height: 65vh !important;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // TYPING TEXT - Compact version
    const texts = [
        "Connecting Students to Quality Education",
        "Find Verified Institutes in Cameroon",
        "Get Expert Mentorship & Guidance",
        "Track Your Academic Growth Easily"
    ];
    const typedText = document.getElementById("typed-text");
    const typingSpeed = 60;
    const pauseBetween = 2000;
    let textIndex = 0;
    let charIndex = 0;

    function type() {
        if(charIndex < texts[textIndex].length){
            typedText.textContent += texts[textIndex].charAt(charIndex);
            charIndex++;
            setTimeout(type, typingSpeed);
        } else {
            setTimeout(erase, pauseBetween);
        }
    }

    function erase() {
        if(charIndex > 0){
            typedText.textContent = texts[textIndex].substring(0, charIndex - 1);
            charIndex--;
            setTimeout(erase, typingSpeed/2);
        } else {
            textIndex = (textIndex + 1) % texts.length;
            setTimeout(type, typingSpeed);
        }
    }

    type();

    // HERO IMAGE TRANSITION - Smooth crossfade between images
    const heroBg = document.querySelector('.hero-bg-image');
    const images = [
        'https://images.pexels.com/photos/5212345/pexels-photo-5212345.jpeg?auto=compress&cs=tinysrgb&w=1200',
        'https://images.pexels.com/photos/4145190/pexels-photo-4145190.jpeg?auto=compress&cs=tinysrgb&w=1200',
        'https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=1200',
        'https://images.pexels.com/photos/5428015/pexels-photo-5428015.jpeg?auto=compress&cs=tinysrgb&w=1200'
    ];
    let imgIndex = 0;
    
    setInterval(() => {
        if (heroBg) {
            heroBg.style.opacity = '0';
            setTimeout(() => {
                imgIndex = (imgIndex + 1) % images.length;
                heroBg.style.backgroundImage = `url('${images[imgIndex]}')`;
                heroBg.style.opacity = '1';
            }, 500);
        }
    }, 4000);

    // PARALLAX SCROLL EFFECT
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        if (heroBg) {
            heroBg.style.transform = `translateY(${scrolled * 0.15}px)`;
        }
    });
});
</script>

<!-- STATIC FEATURES SECTION -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Why Choose Us?</h2>
        <div class="row g-4 mt-2">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Verified Institutes</h5>
                    <p>All institutes undergo rigorous verification to ensure quality education and trusted credentials.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <h5>Expert Mentorship</h5>
                    <p>Get 1-on-1 guidance from certified academic experts and industry professionals.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Track Your Growth</h5>
                    <p>Monitor academic progress, set goals, and receive personalized insights to excel.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h5>AI Academic Assistant</h5>
                    <p>24/7 AI-powered support for assignments, exam prep, and career guidance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="container">
    <div class="stats-section">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-3 mb-md-0">
                <div class="stat-number">50+</div>
                <p class="text-white-50 mb-0">Verified Institutes</p>
            </div>
            <div class="col-md-3 col-6 mb-3 mb-md-0">
                <div class="stat-number">100+</div>
                <p class="text-white-50 mb-0">Active Students</p>
            </div>
            <div class="col-md-3 col-6 mb-3 mb-md-0">
                <div class="stat-number">50+</div>
                <p class="text-white-50 mb-0">Expert Mentors</p>
            </div>
            <div class="col-md-3 col-6 mb-3 mb-md-0">
                <div class="stat-number">98%</div>
                <p class="text-white-50 mb-0">Satisfaction Rate</p>
            </div>
        </div>
    </div>
</section>

<!-- INSTITUTES SECTION -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Top Institutes in Cameroon</h2>
        <div class="row g-4">
            <?php while($i = $institutes->fetch_assoc()): 
                $img = !empty($i['image']) ? $institutePath.$i['image'] : $placeholderInstitute;
            ?>
            <div class="col-md-4">
                <div class="modern-card">
                    <img src="<?= $img ?>" class="modern-card-img" alt="<?= htmlspecialchars($i['name']); ?>">
                    <div class="modern-card-body">
                        <h5><?= htmlspecialchars($i['name']); ?></h5>
                        <p><i class="fas fa-map-marker-alt me-1 text-primary"></i> <?= htmlspecialchars($i['region']); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- EXPERTS SECTION -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Meet Our Experts</h2>
        <div class="row g-4">
            <?php while($e = $experts->fetch_assoc()):
                $img = !empty($e['profile_image']) ? $expertPath.$e['profile_image'] : $placeholderExpert;
            ?>
            <div class="col-md-4">
                <div class="modern-card">
                    <img src="<?= $img ?>" class="modern-card-img" alt="<?= htmlspecialchars($e['full_name']); ?>">
                    <div class="modern-card-body">
                        <h5><?= htmlspecialchars($e['full_name']); ?></h5>
                        <p><i class="fas fa-briefcase me-1 text-primary"></i> <?= htmlspecialchars($e['specialization']); ?> • <?= htmlspecialchars($e['region']); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- STUDENTS SECTION -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Our Successful Students</h2>
        <div class="row g-4">
            <?php while($s = $students->fetch_assoc()):
                $img = !empty($s['profile_image']) ? $studentPath.$s['profile_image'] : $placeholderStudent;
            ?>
            <div class="col-md-4">
                <div class="modern-card">
                    <img src="<?= $img ?>" class="modern-card-img" alt="<?= htmlspecialchars($s['full_name']); ?>">
                    <div class="modern-card-body">
                        <h5><?= htmlspecialchars($s['full_name']); ?></h5>
                        <p><i class="fas fa-location-dot me-1 text-primary"></i> <?= htmlspecialchars($s['region']); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

        
        <!-- Second row of testimonials -->
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="testimonial-card-modern">
                    <img srcclass="testimonial-avatar">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"From Garoua to Yaoundé, this platform connected me with the right institute. The expert mentorship program helped me secure an internship immediately after graduation."</p>
                    <p class="testimonial-name">Hamadou Moussa</p>
                    <p class="testimonial-region"><i class="fas fa-map-marker-alt me-1"></i> Garoua, North Region</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card-modern">
                    <img srcclass="testimonial-avatar">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The AI academic assistant is brilliant! It helped me prepare for my exams in Bamenda. I'm now pursuing my dream career thanks to this platform."</p>
                    <p class="testimonial-name">Yvonne Tataw</p>
                    <p class="testimonial-region"><i class="fas fa-map-marker-alt me-1"></i> Bamenda, North-West Region</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card-modern">
                    <img srcclass="testimonial-avatar">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">"Finding verified institutes in Limbe was so easy. The platform's transparency and student reviews gave me confidence in my educational choices."</p>
                    <p class="testimonial-name">Eric Nsom</p>
                    <p class="testimonial-region"><i class="fas fa-map-marker-alt me-1"></i> Limbe, South-West Region</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODERN CTA SECTION -->
<section class="container mb-5">
    <div class="cta-modern">
        <h2>Ready to Start Your Journey?</h2>
        <p class="text-white-50 mb-4">Join thousands of Cameroonian students already transforming their education with us.</p>
        <a href="../register.php" class="btn btn-cta">Create Free Account <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
</section>

<?php include '../include/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>