<?php
session_start();
include("../model/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin'){
    header("Location: ../view/login.php?error=Please login first");
    exit();
}

$admin_id = $_SESSION['user_id'];

// UPDATE PROFILE + SETTINGS
if(isset($_POST['save_settings'])){
    $theme = $_POST['theme'];
    $dashboard_name = $_POST['dashboard_name'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE admins SET theme=?, dashboard_name=?, full_name=?, email=? WHERE id=?");
    $stmt->bind_param("ssssi", $theme, $dashboard_name, $full_name, $email, $admin_id);
    $stmt->execute();

    header("Location: settings.php?success=1");
    exit();
}

// CHANGE PASSWORD
if(isset($_POST['change_password'])){
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE id=?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if(password_verify($current, $result['password'])){
        $new_hash = password_hash($new, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE admins SET password=? WHERE id=?");
        $update->bind_param("si", $new_hash, $admin_id);
        $update->execute();

        header("Location: settings.php?password=success");
    } else {
        header("Location: settings.php?password=error");
    }
    exit();
}

// FETCH DATA
$stmt = $conn->prepare("SELECT * FROM admins WHERE id=?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Account Settings | Cameroon Pro</title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

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
        margin: 0;
    }

    /* Settings Card */
    .settings-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .settings-card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header {
        padding: 20px 28px;
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
    }

    .card-body {
        padding: 28px;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 24px;
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
        font-size: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        font-size: 0.9rem;
        font-family: inherit;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        transition: var(--transition);
        background: var(--white);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
        border: none;
        width: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: var(--white);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
    }

    .btn-secondary {
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
    }

    .btn-secondary:hover {
        background: var(--gray-200);
        transform: translateY(-2px);
    }

    /* Alerts */
    .alert {
        padding: 14px 20px;
        border-radius: var(--radius);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.85rem;
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

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 24px 0;
        color: var(--gray-400);
        font-size: 0.75rem;
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

    /* Animation */
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

    /* Responsive */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 24px;
        }
        
        .settings-container {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
        }
        
        .card-header {
            padding: 16px 20px;
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
            margin-bottom: 18px;
        }
        
        .btn {
            padding: 10px 20px;
        }
    }

    /* Theme Preview */
    .theme-preview {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .theme-option {
        flex: 1;
        padding: 12px;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius);
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .theme-option.active {
        border-color: var(--primary);
        background: var(--primary-bg);
    }

    .theme-option:hover {
        border-color: var(--primary);
    }

    /* Password Strength Indicator */
    .password-strength {
        margin-top: 8px;
        height: 4px;
        background: var(--gray-200);
        border-radius: 2px;
        overflow: hidden;
    }

    .strength-bar {
        height: 100%;
        width: 0;
        transition: var(--transition);
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
            Account Settings
        </h1>
        <p>Manage your profile information, dashboard preferences, and security settings</p>
    </div>

    <div class="settings-container">
        <!-- Success/Error Messages -->
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>Profile updated successfully! Your changes have been saved.</span>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['password']) && $_GET['password']=='success'): ?>
            <div class="alert alert-success">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Password changed successfully! Your account is now more secure.</span>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['password']) && $_GET['password']=='error'): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>Current password is incorrect. Please try again.</span>
            </div>
        <?php endif; ?>

        <!-- Profile & Settings Form -->
        <div class="settings-card">
            <div class="card-header">
                <i class="bi bi-person-circle"></i>
                <div>
                    <h2>Profile Information</h2>
                    <p>Update your personal details and dashboard preferences</p>
                </div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label><i class="bi bi-person"></i> Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-envelope"></i> Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-palette"></i> Dashboard Theme</label>
                        <select name="theme" class="form-control">
                            <option value="light" <?php if($user['theme']=='light') echo 'selected'; ?>>☀️ Light Mode</option>
                            <option value="dark" <?php if($user['theme']=='dark') echo 'selected'; ?>>🌙 Dark Mode</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-speedometer2"></i> Dashboard Name</label>
                        <input type="text" name="dashboard_name" class="form-control" value="<?php echo htmlspecialchars($user['dashboard_name']); ?>" placeholder="e.g., Admin Dashboard">
                        <small style="color: var(--gray-500); font-size: 0.7rem; margin-top: 4px; display: block;">This appears as your dashboard title</small>
                    </div>

                    <button type="submit" name="save_settings" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>

        <!-- Password Change Form -->
        <div class="settings-card">
            <div class="card-header">
                <i class="bi bi-shield-lock"></i>
                <div>
                    <h2>Security Settings</h2>
                    <p>Change your password to keep your account secure</p>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" id="passwordForm">
                    <div class="form-group">
                        <label><i class="bi bi-lock"></i> Current Password</label>
                        <input type="password" name="current_password" class="form-control" id="currentPassword" required>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-key"></i> New Password</label>
                        <input type="password" name="new_password" class="form-control" id="newPassword" required>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                        <small style="color: var(--gray-500); font-size: 0.7rem; margin-top: 4px; display: block;">
                            Use at least 8 characters with a mix of letters, numbers, and symbols
                        </small>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-check-circle"></i> Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirmPassword" required>
                        <small id="passwordMatch" style="font-size: 0.7rem; margin-top: 4px; display: none;"></small>
                    </div>

                    <button type="submit" name="change_password" class="btn btn-danger" id="changePasswordBtn">
                        <i class="bi bi-shield-check"></i> Change Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <a href="admindashboard.php" class="back-button">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

<script>
    // Password strength checker
    const newPassword = document.getElementById('newPassword');
    const strengthBar = document.getElementById('strengthBar');
    
    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;
        
        let width = (strength / 5) * 100;
        strengthBar.style.width = width + '%';
        
        if (strength <= 2) {
            strengthBar.style.backgroundColor = '#ef4444';
        } else if (strength <= 4) {
            strengthBar.style.backgroundColor = '#f59e0b';
        } else {
            strengthBar.style.backgroundColor = '#10b981';
        }
        
        return strength;
    }
    
    if (newPassword) {
        newPassword.addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
    }
    
    // Password confirmation
    const confirmPassword = document.getElementById('confirmPassword');
    const passwordMatch = document.getElementById('passwordMatch');
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    
    function checkPasswordMatch() {
        if (newPassword.value !== confirmPassword.value) {
            passwordMatch.style.display = 'block';
            passwordMatch.style.color = '#ef4444';
            passwordMatch.innerHTML = '<i class="bi bi-x-circle"></i> Passwords do not match';
            changePasswordBtn.disabled = true;
            changePasswordBtn.style.opacity = '0.5';
            return false;
        } else if (newPassword.value.length > 0 && confirmPassword.value.length > 0) {
            passwordMatch.style.display = 'block';
            passwordMatch.style.color = '#10b981';
            passwordMatch.innerHTML = '<i class="bi bi-check-circle"></i> Passwords match';
            changePasswordBtn.disabled = false;
            changePasswordBtn.style.opacity = '1';
            return true;
        } else {
            passwordMatch.style.display = 'none';
            changePasswordBtn.disabled = false;
            changePasswordBtn.style.opacity = '1';
            return true;
        }
    }
    
    if (confirmPassword) {
        confirmPassword.addEventListener('input', checkPasswordMatch);
        newPassword.addEventListener('input', checkPasswordMatch);
    }
    
    // Form validation before submit
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            if (newPassword.value !== confirmPassword.value) {
                e.preventDefault();
                alert('❌ Passwords do not match. Please make sure both passwords are identical.');
            } else if (newPassword.value.length < 8) {
                e.preventDefault();
                alert('🔐 Password must be at least 8 characters long for security.');
            }
        });
    }
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>

</body>
</html>