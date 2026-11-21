<?php
session_start();
include("../../model/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'expert') {
    header("Location: ../login.php");
    exit();
}

$expert_id = $_SESSION['user_id'];

// Fetch expert info
$expert = $conn->query("SELECT full_name, email, profile_image, specialization, region, phone FROM experts WHERE id='$expert_id'")->fetch_assoc();
$fullname = htmlspecialchars($expert['full_name']);
$email    = htmlspecialchars($expert['email']);
$specialization = htmlspecialchars($expert['specialization'] ?? 'Education Expert');
$region = htmlspecialchars($expert['region'] ?? 'Cameroon');
$phone = htmlspecialchars($expert['phone'] ?? 'Not provided');

// Profile image or initials
$profile_image = (!empty($expert['profile_image']) && file_exists("../../uploads/profiles/".$expert['profile_image']))
    ? "../../uploads/profiles/".$expert['profile_image']
    : null;
$abbrName = $profile_image ? '' : implode('', array_map(function($n){ return strtoupper($n[0]); }, explode(' ', $fullname)));

// Handle form submission
$message = '';
$messageType = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name  = $conn->real_escape_string($_POST['full_name']);
    $new_email = $conn->real_escape_string($_POST['email']);
    $new_phone = $conn->real_escape_string($_POST['phone']);
    $new_specialization = $conn->real_escape_string($_POST['specialization']);
    $new_region = $conn->real_escape_string($_POST['region']);
    $password  = $_POST['password'];
    
    // Profile image upload
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0){
        $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $filename = "expert_{$expert_id}_" . time() . "." . $ext;
        $target_path = "../../uploads/profiles/".$filename;
        
        if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_path)){
            // Delete old image if exists
            if($expert['profile_image'] && file_exists("../../uploads/profiles/".$expert['profile_image'])){
                unlink("../../uploads/profiles/".$expert['profile_image']);
            }
            $conn->query("UPDATE experts SET profile_image='$filename' WHERE id='$expert_id'");
        }
    }

    // Update info
    $update_sql = "UPDATE experts SET full_name='$new_name', email='$new_email', phone='$new_phone', specialization='$new_specialization', region='$new_region'";
    if(!empty($password)){
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $update_sql .= ", password='$hashed'";
    }
    $update_sql .= " WHERE id='$expert_id'";
    
    if($conn->query($update_sql)){
        $message = "Profile updated successfully!";
        $messageType = "success";
        $_SESSION['full_name'] = $new_name;
        // Refresh data
        $fullname = $new_name;
        $email = $new_email;
        $phone = $new_phone;
        $specialization = $new_specialization;
        $region = $new_region;
    } else {
        $message = "Error updating profile: " . $conn->error;
        $messageType = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Profile Settings | Expert Dashboard</title>

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
        --warning-bg: #fef3c7;
        --danger: #ef4444;
        --danger-bg: #fee2e2;
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

    /* Main Content Area - Accounts for Sidebar */
    .main-content {
        margin-left: 280px;
        padding: 32px 40px;
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

    /* Settings Container */
    .settings-container {
        max-width: 800px;
    }

    /* Settings Card */
    .settings-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .settings-card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header {
        padding: 24px 28px;
        border-bottom: 1px solid var(--gray-200);
        background: var(--gray-50);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-header i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .card-header h2 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray-800);
        margin: 0;
    }

    .card-header p {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin-top: 4px;
        margin-bottom: 0;
    }

    .card-body {
        padding: 28px;
    }

    /* Profile Section */
    .profile-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--gray-200);
    }

    .profile-avatar {
        position: relative;
        margin-bottom: 16px;
    }

    .avatar-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--white);
        box-shadow: var(--shadow-md);
        background: var(--gray-200);
    }

    .avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        box-shadow: var(--shadow-md);
    }

    .upload-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        background: var(--primary);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        border: 2px solid var(--white);
    }

    .upload-btn:hover {
        background: var(--primary-dark);
        transform: scale(1.05);
    }

    .upload-btn i {
        color: white;
        font-size: 0.8rem;
    }

    .profile-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .profile-role {
        font-size: 0.8rem;
        color: var(--gray-500);
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 8px;
    }

    .form-group label i {
        color: var(--primary);
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 10px 14px;
        font-size: 0.85rem;
        font-family: inherit;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        transition: var(--transition);
        background: var(--white);
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Info Text */
    .info-text {
        font-size: 0.7rem;
        color: var(--gray-500);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Buttons */
    .btn-save {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 0.85rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
    }

    /* Alert Messages */
    .alert {
        padding: 14px 20px;
        border-radius: var(--radius);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease;
    }

    .alert-success {
        background: var(--success-bg);
        color: var(--success);
        border-left: 4px solid var(--success);
    }

    .alert-danger {
        background: var(--danger-bg);
        color: var(--danger);
        border-left: 4px solid var(--danger);
    }

    .alert i {
        font-size: 1.2rem;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 24px 0;
        color: var(--gray-400);
        font-size: 0.7rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--gray-200);
    }

    .divider::before {
        margin-right: 16px;
    }

    .divider::after {
        margin-left: 16px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 24px;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
        }
        
        .card-header {
            padding: 18px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .page-header h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .main-content {
            padding: 16px;
        }
        
        .card-body {
            padding: 16px;
        }
        
        .form-group {
            margin-bottom: 16px;
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

    .settings-card {
        animation: fadeInUp 0.4s ease;
    }

    /* File Input Styling */
    input[type="file"] {
        padding: 8px;
        font-size: 0.8rem;
    }

    input[type="file"]::file-selector-button {
        padding: 6px 12px;
        border-radius: var(--radius-sm);
        border: none;
        background: var(--gray-100);
        color: var(--gray-700);
        font-weight: 500;
        margin-right: 12px;
        cursor: pointer;
        transition: var(--transition);
    }

    input[type="file"]::file-selector-button:hover {
        background: var(--primary);
        color: white;
    }
</style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-gear-fill"></i>
            Profile Settings
        </h1>
        <p>Manage your account information and preferences</p>
    </div>

    <div class="settings-container">
        <!-- Success/Error Messages -->
        <?php if($message): ?>
            <div class="alert alert-<?= $messageType ?>">
                <i class="bi bi-<?= $messageType == 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?>"></i>
                <span><?= $message ?></span>
            </div>
        <?php endif; ?>

        <!-- Settings Form -->
        <div class="settings-card">
            <div class="card-header">
                <i class="bi bi-person-circle"></i>
                <div>
                    <h2>Personal Information</h2>
                    <p>Update your profile details and contact information</p>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Profile Image Section -->
                    <div class="profile-section">
                        <div class="profile-avatar">
                            <?php if($profile_image): ?>
                                <img src="<?= $profile_image ?>" class="avatar-image" alt="Profile" id="profilePreview">
                            <?php else: ?>
                                <div class="avatar-placeholder" id="profilePreview">
                                    <?= $abbrName ?>
                                </div>
                            <?php endif; ?>
                            <label class="upload-btn" for="profileImage">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                        <div class="profile-name"><?= $fullname ?></div>
                        <div class="profile-role"><?= $specialization ?></div>
                        <input type="file" name="profile_image" id="profileImage" class="form-control mt-3" accept="image/*" style="display: none;">
                        <div class="info-text">
                            <i class="bi bi-info-circle"></i>
                            Click the camera icon to change your profile picture
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="form-group">
                        <label><i class="bi bi-person"></i> Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= $fullname ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-envelope"></i> Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-telephone"></i> Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="<?= $phone ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="bi bi-star"></i> Specialization</label>
                                <input type="text" name="specialization" class="form-control" value="<?= $specialization ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="bi bi-geo-alt"></i> Region</label>
                                <select name="region" class="form-select">
                                    <option value="Centre" <?= $region == 'Centre' ? 'selected' : '' ?>>Centre</option>
                                    <option value="Littoral" <?= $region == 'Littoral' ? 'selected' : '' ?>>Littoral</option>
                                    <option value="West" <?= $region == 'West' ? 'selected' : '' ?>>West</option>
                                    <option value="North West" <?= $region == 'North West' ? 'selected' : '' ?>>North West</option>
                                    <option value="South West" <?= $region == 'South West' ? 'selected' : '' ?>>South West</option>
                                    <option value="Adamawa" <?= $region == 'Adamawa' ? 'selected' : '' ?>>Adamawa</option>
                                    <option value="North" <?= $region == 'North' ? 'selected' : '' ?>>North</option>
                                    <option value="Far North" <?= $region == 'Far North' ? 'selected' : '' ?>>Far North</option>
                                    <option value="East" <?= $region == 'East' ? 'selected' : '' ?>>East</option>
                                    <option value="South" <?= $region == 'South' ? 'selected' : '' ?>>South</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="divider">
                        <span>Security</span>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-lock"></i> New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                        <div class="info-text">
                            <i class="bi bi-shield-lock"></i>
                            Password must be at least 8 characters long
                        </div>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Image preview functionality
    const profileImageInput = document.getElementById('profileImage');
    const profilePreview = document.getElementById('profilePreview');
    
    profileImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (profilePreview.tagName === 'IMG') {
                    profilePreview.src = e.target.result;
                } else {
                    // Replace placeholder with image
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'avatar-image';
                    img.id = 'profilePreview';
                    profilePreview.parentNode.replaceChild(img, profilePreview);
                }
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
    
    // Password strength indicator (optional)
    const passwordInput = document.querySelector('input[name="password"]');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = getPasswordStrength(password);
            // You can add visual feedback here if desired
        });
    }
    
    function getPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;
        return strength;
    }
    
    // Trigger file input when clicking upload button
    const uploadBtn = document.querySelector('.upload-btn');
    if (uploadBtn) {
        uploadBtn.addEventListener('click', function() {
            profileImageInput.click();
        });
    }
</script>

</body>
</html>