<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Cameroon Education Connect</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
      background: #f8fafc;
      overflow-x: hidden;
    }

    /* Hero Section - Dashboard Style */
    .hero-about {
      position: relative;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      padding: 5rem 0 4rem;
      color: white;
      overflow: hidden;
    }

    .hero-about::before {
      content: '';
      position: absolute;
      top: -30%;
      right: -10%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(56,189,248,0.15) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .hero-about::after {
      content: '';
      position: absolute;
      bottom: -20%;
      left: -5%;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(129,140,248,0.1) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
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
    }

    .hero-about h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
    }

    .hero-about .lead {
      font-size: 1.2rem;
      color: #cbd5e1;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Section Titles */
    .section-title {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 1rem;
      position: relative;
      display: inline-block;
      background: linear-gradient(135deg, #0f172a, #1e293b);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .section-title:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, #38bdf8, #818cf8);
      border-radius: 4px;
    }

    .text-center .section-title:after {
      left: 50%;
      transform: translateX(-50%);
    }

    /* Who We Are Section */
    .about-content {
      background: white;
      border-radius: 1.5rem;
      padding: 2rem;
      box-shadow: 0 10px 30px -12px rgba(0,0,0,0.08);
      border: 1px solid #e2e8f0;
    }

    .about-text {
      color: #475569;
      line-height: 1.7;
      font-size: 1rem;
    }

    .about-image {
      border-radius: 1.5rem;
      overflow: hidden;
      box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15);
    }

    .about-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .about-image:hover img {
      transform: scale(1.03);
    }

    /* Mission & Vision Cards */
    .mission-card, .vision-card {
      background: white;
      border-radius: 1.5rem;
      padding: 2rem;
      text-align: center;
      transition: all 0.3s ease;
      border: 1px solid #e2e8f0;
      box-shadow: 0 10px 25px -8px rgba(0,0,0,0.05);
      height: 100%;
    }

    .mission-card:hover, .vision-card:hover {
      transform: translateY(-6px);
      border-color: #38bdf8;
      box-shadow: 0 20px 35px -12px rgba(56,189,248,0.2);
    }

    .card-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, #e0f2fe, #ede9fe);
      border-radius: 1.2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.2rem;
    }

    .card-icon i {
      font-size: 2rem;
      color: #38bdf8;
    }

    .mission-card h4, .vision-card h4 {
      font-weight: 700;
      margin-bottom: 1rem;
      color: #0f172a;
    }

    .mission-card p, .vision-card p {
      color: #475569;
      line-height: 1.6;
    }

    /* Stats Section */
    .stats-section {
      background: linear-gradient(135deg, #0f172a, #1e293b);
      border-radius: 2rem;
      padding: 2.5rem;
      margin: 2rem 0;
    }

    .stat-box {
      text-align: center;
      padding: 1rem;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 800;
      color: #38bdf8;
    }

    .stat-label {
      font-size: 0.9rem;
      color: #94a3b8;
      font-weight: 500;
    }

    /* Team Section */
    .team-card {
      background: white;
      border-radius: 1.2rem;
      overflow: hidden;
      transition: all 0.35s ease;
      box-shadow: 0 10px 25px -8px rgba(0,0,0,0.08);
      height: 100%;
      border: 1px solid #e2e8f0;
    }

    .team-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15);
      border-color: #38bdf8;
    }

    .team-img {
      width: 100%;
      height: 280px;
      object-fit: cover;
    }

    .team-body {
      padding: 1.5rem;
      text-align: center;
    }

    .team-body h5 {
      font-weight: 800;
      margin-bottom: 0.3rem;
      color: #0f172a;
    }

    .team-role {
      font-size: 0.8rem;
      color: #38bdf8;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .team-desc {
      font-size: 0.85rem;
      color: #64748b;
    }

    /* Values Section */
    .values-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .value-item {
      text-align: center;
      padding: 1.5rem;
      background: white;
      border-radius: 1.2rem;
      transition: all 0.3s;
      border: 1px solid #e2e8f0;
    }

    .value-item:hover {
      transform: translateY(-5px);
      border-color: #38bdf8;
      box-shadow: 0 10px 20px -8px rgba(56,189,248,0.15);
    }

    .value-icon {
      width: 55px;
      height: 55px;
      background: linear-gradient(135deg, #e0f2fe, #ede9fe);
      border-radius: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
    }

    .value-icon i {
      font-size: 1.5rem;
      color: #38bdf8;
    }

    .value-item h6 {
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 0.5rem;
    }

    .value-item p {
      font-size: 0.8rem;
      color: #64748b;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-about h1 {
        font-size: 2rem;
      }
      .section-title {
        font-size: 1.6rem;
      }
      .stat-number {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<?php include '../include/navbar.php'; ?>

<!-- HERO SECTION - Dashboard Style -->
<section class="hero-about text-center">
  <div class="container">
    <div class="hero-badge">
      <i class="fas fa-graduation-cap me-2"></i> Our Story
    </div>
    <h1 class="fw-bold">About Cameroon Education Connect</h1>
    <p class="lead mx-auto">Connecting students, experts, and institutes across Cameroon for a brighter future</p>
  </div>
</section>

<!-- WHO WE ARE SECTION -->
<section class="container py-5">
  <div class="row align-items-center g-4">
    <div class="col-lg-6">
      <div class="about-content">
        <h3 class="section-title">Who We Are</h3>
        <p class="about-text">
          Cameroon Education Connect is a pioneering educational platform dedicated to helping students 
          make informed academic choices by connecting them with accredited institutes and experienced career experts.
        </p>
        <p class="about-text mt-3">
          Our mission is to make education accessible, transparent, and well-structured across all regions of Cameroon. 
          We believe every student deserves access to quality education and expert guidance.
        </p>
        <div class="mt-4">
          <div class="d-flex gap-3 flex-wrap">
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill"><i class="fas fa-check-circle text-primary me-1"></i> Verified Institutes</span>
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill"><i class="fas fa-chalkboard-user text-primary me-1"></i> Expert Mentors</span>
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill"><i class="fas fa-chart-line text-primary me-1"></i> Growth Tracking</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="about-image">
        <img src="../../assets/images/1765290696_8bc0784c-53cd-486e-a17f-1c0a9568f5fb.jpg" alt="Students in Cameroon" class="img-fluid">
      </div>
    </div>
  </div>
</section>

<!-- MISSION & VISION -->
<section class="container py-4">
  <div class="row g-4">
    <div class="col-md-6">
      <div class="mission-card">
        <div class="card-icon">
          <i class="fas fa-bullseye"></i>
        </div>
        <h4>Our Mission</h4>
        <p>To bridge the gap between students and quality educational opportunities across Cameroon by providing a transparent platform that connects learners with verified institutes and expert mentors.</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="vision-card">
        <div class="card-icon">
          <i class="fas fa-eye"></i>
        </div>
        <h4>Our Vision</h4>
        <p>To become Cameroon's leading educational ecosystem where every student has access to quality education, career guidance, and the tools needed to succeed in their academic journey.</p>
      </div>
    </div>
  </div>
</section>

<!-- STATS SECTION -->
<section class="container">
  <div class="stats-section">
    <div class="row text-center">
      <div class="col-md-3 col-6 mb-3 mb-md-0">
        <div class="stat-box">
          <div class="stat-number">50+</div>
          <div class="stat-label">Verified Institutes</div>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3 mb-md-0">
        <div class="stat-box">
          <div class="stat-number">100+</div>
          <div class="stat-label">Active Students</div>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3 mb-md-0">
        <div class="stat-box">
          <div class="stat-number">50+</div>
          <div class="stat-label">Expert Mentors</div>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3 mb-md-0">
        <div class="stat-box">
          <div class="stat-number">10</div>
          <div class="stat-label">Regions Covered</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CORE VALUES -->
<section class="container py-5">
  <div class="text-center mb-4">
    <h3 class="section-title text-center">Our Core Values</h3>
    <p class="text-muted">The principles that guide everything we do</p>
  </div>
  <div class="values-grid">
    <div class="value-item">
      <div class="value-icon"><i class="fas fa-hand-holding-heart"></i></div>
      <h6>Integrity</h6>
      <p>We operate with transparency and honesty</p>
    </div>
    <div class="value-item">
      <div class="value-icon"><i class="fas fa-star"></i></div>
      <h6>Excellence</h6>
      <p>We strive for the highest quality standards</p>
    </div>
    <div class="value-item">
      <div class="value-icon"><i class="fas fa-users"></i></div>
      <h6>Inclusivity</h6>
      <p>Education for everyone, everywhere</p>
    </div>
    <div class="value-item">
      <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
      <h6>Innovation</h6>
      <p>Embracing technology for better learning</p>
    </div>
  </div>
</section>

<
<!-- CTA SECTION -->
<section class="container mb-5">
  <div class="cta-modern" style="background: linear-gradient(135deg, #0f172a, #1e293b); border-radius: 2rem; padding: 3rem; text-align: center;">
    <h2 style="font-size: 2rem; font-weight: 800; color: white;">Ready to Start Your Journey?</h2>
    <p class="text-white-50 mb-4">Join thousands of students already transforming their education with us</p>
    <a href="../register.php" class="btn btn-cta" style="background: linear-gradient(135deg, #38bdf8, #818cf8); border: none; padding: 0.8rem 2rem; border-radius: 3rem; font-weight: 700; color: white; text-decoration: none; display: inline-block;">Get Started <i class="fas fa-arrow-right ms-2"></i></a>
  </div>
</section>

<!-- FOOTER -->
<?php include '../include/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>