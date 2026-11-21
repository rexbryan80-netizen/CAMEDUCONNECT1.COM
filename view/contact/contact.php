<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Cameroon Education Connect</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
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
.hero-contact {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    padding: 5rem 0 4rem;
    color: white;
    overflow: hidden;
}

.hero-contact::before {
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

.hero-contact::after {
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

.hero-contact h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.hero-contact .lead {
    font-size: 1.2rem;
    color: #cbd5e1;
    max-width: 600px;
    margin: 0 auto;
}

/* Contact Cards */
.contact-card {
    background: white;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px -12px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    height: 100%;
}

.contact-card:hover {
    transform: translateY(-5px);
    border-color: #38bdf8;
    box-shadow: 0 20px 35px -12px rgba(56,189,248,0.15);
}

.contact-icon {
    width: 65px;
    height: 65px;
    background: linear-gradient(135deg, #e0f2fe, #ede9fe);
    border-radius: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.contact-icon i {
    font-size: 1.8rem;
    color: #38bdf8;
}

.contact-card h5 {
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #0f172a;
}

.contact-card p {
    color: #475569;
    margin-bottom: 1rem;
}

/* Social Icons */
.social-icons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
}

.social-icon {
    width: 40px;
    height: 40px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #38bdf8;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-icon:hover {
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    color: white;
    transform: translateY(-3px);
}

/* Form Styling */
.form-card {
    background: white;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px -12px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
}

.form-card h4 {
    font-weight: 800;
    margin-bottom: 1.5rem;
    color: #0f172a;
    position: relative;
    display: inline-block;
}

.form-card h4:after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    border-radius: 3px;
}

.form-label {
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
    font-size: 0.85rem;
}

.form-control {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 1rem;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #38bdf8;
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    background: white;
}

textarea.form-control {
    resize: vertical;
}

.btn-submit {
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    border: none;
    padding: 0.85rem 2rem;
    border-radius: 2rem;
    font-weight: 700;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(56, 189, 248, 0.4);
    background: linear-gradient(135deg, #2ea5e0, #6f6af0);
}

/* Map Container */
.map-container {
    border-radius: 1.5rem;
    overflow: hidden;
    box-shadow: 0 10px 30px -12px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    height: 350px;
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

/* Alert Styling */
.alert-custom {
    border-radius: 1rem;
    border: none;
    padding: 1rem;
    font-weight: 500;
}

.alert-success-custom {
    background: #ecfdf5;
    color: #059669;
    border-left: 4px solid #059669;
}

.alert-danger-custom {
    background: #fef2f2;
    color: #dc2626;
    border-left: 4px solid #dc2626;
}

/* Quick Contact Row */
.quick-contact {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1rem;
}

.quick-item {
    flex: 1;
    background: #f8fafc;
    padding: 0.8rem;
    border-radius: 1rem;
    text-align: center;
}

.quick-item i {
    color: #38bdf8;
    margin-right: 0.5rem;
}

.quick-item span {
    font-size: 0.8rem;
    color: #475569;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-contact h1 {
        font-size: 2rem;
    }
    .contact-card {
        padding: 1.5rem;
    }
    .form-card {
        padding: 1.5rem;
    }
    .quick-contact {
        flex-direction: column;
    }
}
</style>
</head>
<body>

<?php
include '../../model/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    if($full_name && $email && $subject && $message){
        $stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, subject, message) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $full_name, $email, $subject, $message);
        if($stmt->execute()){
            $success = "Your message has been sent successfully! We'll get back to you soon.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
        $stmt->close();
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!-- NAVBAR -->
<?php include '../include/navbar.php'; ?>

<!-- HERO SECTION -->
<section class="hero-contact text-center">
    <div class="container">
        <div class="hero-badge">
            <i class="fas fa-headset me-2"></i> Get in Touch
        </div>
        <h1 class="fw-bold">Contact Us</h1>
        <p class="lead mx-auto">We're here to help and answer any questions you might have</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="container my-5">
    <div class="row g-4">

        <!-- Contact Info Cards -->
        <div class="col-lg-4">
            <div class="contact-card text-center">
                <div class="contact-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <h5>Phone Support</h5>
                <p>Mon-Fri, 8am - 6pm</p>
                <p class="fw-bold text-dark">+237 675 544 181</p>
                <p class="fw-bold text-dark">+237 687 115 819</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="contact-card text-center">
                <div class="contact-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h5>Email Us</h5>
                <p>We'll respond within 24h</p>
                <p class="fw-bold text-dark">info@camerooneduconnect.cm</p>
                <p class="fw-bold text-dark">support@camerooneduconnect.cm</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="contact-card text-center">
                <div class="contact-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h5>Visit Us</h5>
                <p>Our headquarters</p>
                <p class="fw-bold text-dark">Dschang, West Region, Cameroon</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form and Map Row -->
    <div class="row g-4 mt-3">
        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="form-card">
                <h4>Send Us a Message</h4>
                <p class="text-muted small mb-4">Fill out the form below and we'll get back to you as soon as possible.</p>

                <?php if(isset($success)): ?>
                    <div class="alert alert-success-custom alert-custom mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?= htmlspecialchars($success) ?>
                    </div>
                <?php elseif(isset($error)): ?>
                    <div class="alert alert-danger-custom alert-custom mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="hello@example.com" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" placeholder="How can we help you?" required>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Tell us more about your inquiry..." required></textarea>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-submit" type="submit">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </div>
                </form>

                <div class="quick-contact mt-4">
                    <div class="quick-item">
                        <i class="fas fa-clock"></i> <span>Response within 24h</span>
                    </div>
                    <div class="quick-item">
                        <i class="fas fa-lock"></i> <span>Your data is safe</span>
                    </div>
                    <div class="quick-item">
                        <i class="fas fa-headset"></i> <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="col-lg-5">
            <div class="form-card" style="padding: 0; overflow: hidden;">
                <div class="map-container" style="height: 100%; min-height: 450px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.973864859046!2d11.5183!3d3.8480!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bcf32c7cc9f51%3A0x41e8b4d6fb2c1ddb!2sDschang%C3%A9%2C%20Cameroon!5e0!3m2!1sen!2scm!4v1700000000000"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Office Hours Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="contact-card text-center">
                <div class="contact-icon" style="width: 50px; height: 50px; margin: 0 auto 1rem;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h5>Office Hours</h5>
                <div class="row justify-content-center mt-3">
                    <div class="col-auto">
                        <p class="mb-1"><strong>Monday - Friday:</strong> 8:00 AM - 6:00 PM</p>
                        <p class="mb-1"><strong>Saturday:</strong> 9:00 AM - 2:00 PM</p>
                        <p class="mb-0"><strong>Sunday:</strong> Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php include '../include/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>