<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<title>User Login | Cameroon Education Connect</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome 6 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        font-family: 'Inter', 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        position: relative;
    }

    /* Background pattern overlay */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background-image: 
            linear-gradient(rgba(56, 189, 248, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(56, 189, 248, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
        z-index: 0;
    }

    /* Decorative blobs */
    body::after {
        content: '';
        position: fixed;
        top: -20%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    /* Main Glass Card - matches original form-box functionality */
    .form-box {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 440px;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 2rem;
        border: 1px solid rgba(56, 189, 248, 0.25);
        box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.5), 0 0 0 0.5px rgba(56, 189, 248, 0.1) inset;
        padding: 2rem 2rem 2.2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .form-box:hover {
        box-shadow: 0 30px 55px -15px rgba(56, 189, 248, 0.2);
    }

    /* TABS - matches original structure but styled */
    .tabs {
        display: flex;
        justify-content: space-around;
        margin-bottom: 1.8rem;
        background: rgba(30, 41, 59, 0.5);
        border-radius: 3rem;
        padding: 0.3rem;
    }
    
    .tabs a {
        flex: 1;
        text-align: center;
        padding: 0.7rem 1rem;
        border-radius: 2rem;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        color: #94a3b8;
        text-decoration: none;
        display: block;
    }
    
    .tabs a.active {
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        color: white;
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
        border-bottom: none;
    }
    
    .tabs a:not(.active):hover {
        color: #cbd5e1;
        background: rgba(56, 189, 248, 0.1);
    }

    /* Alert Styling - matches original bootstrap alert but styled */
    .alert {
        border-radius: 1rem;
        border: none;
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }
    
    .alert-danger {
        background: rgba(239, 68, 68, 0.15);
        color: #fecaca;
        border-left: 3px solid #ef4444;
    }
    
    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        color: #bbf7d0;
        border-left: 3px solid #22c55e;
    }
    
    .alert-danger.text-center, .alert-success.text-center {
        text-align: center;
    }

    /* INPUT - matches original input-box structure */
    .input-box {
        position: relative;
        margin-bottom: 1.25rem;
    }
    
    .input-box input {
        width: 100%;
        background: rgba(30, 41, 59, 0.6);
        border: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 1rem;
        padding: 0.85rem 1.2rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: #f1f5f9;
        outline: none;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }
    
    .input-box input:focus {
        border-color: #38bdf8;
        background: rgba(51, 65, 85, 0.8);
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }
    
    .input-box input::placeholder {
        color: rgba(148, 163, 184, 0.7);
        font-weight: 400;
    }

    /* ICON - toggle password */
    .toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #38bdf8;
        font-size: 1rem;
        transition: color 0.2s;
        z-index: 3;
    }
    
    .toggle:hover {
        color: #7dd3fc;
    }

    /* BUTTON - matches original btn-submit */
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        border: none;
        border-radius: 1rem;
        padding: 0.9rem;
        font-weight: 700;
        font-size: 1rem;
        font-family: 'Plus Jakarta Sans', monospace;
        letter-spacing: 0.5px;
        color: white;
        transition: all 0.25s ease;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #2ea5e0, #6f6af0);
        box-shadow: 0 8px 20px rgba(56, 189, 248, 0.4);
    }
    
    .btn-submit:active {
        transform: translateY(1px);
    }

    /* LINKS - matches original links structure */
    .links {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
    }
    
    .links label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #cbd5e6;
        cursor: pointer;
    }
    
    .links input[type="checkbox"] {
        width: 1rem;
        height: 1rem;
        accent-color: #38bdf8;
        cursor: pointer;
    }
    
    .links a {
        color: #7dd3fc;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s;
    }
    
    .links a:hover {
        color: #38bdf8;
        text-decoration: underline;
    }
    
    .mb-2 {
        margin-bottom: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .form-box {
            padding: 1.5rem;
            border-radius: 1.5rem;
        }
        .tabs a {
            padding: 0.6rem 0.5rem;
            font-size: 0.85rem;
        }
    }
</style>
</head>
<body>

<div class="form-box">

    <!-- Tabs - exactly same structure as original -->
    <div class="tabs">
        <a class="active">SIGN IN</a>
        <a href="register.php">SIGN UP</a>
    </div>

    <!-- Error - exactly same PHP logic as original -->
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Form - exactly same action and method as original -->
    <form action="login-process.php" method="POST">

        <!-- Email - same as original -->
        <div class="input-box">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <!-- Password - same as original with toggle -->
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i class="fa fa-eye toggle" onclick="togglePassword()"></i>
        </div>

        <!-- Options - exactly same as original -->
        <div class="links mb-2">
            <label><input type="checkbox" name="remember_me" value="1"> Remember me</label>
            <a href="forgot-password.php">Forgot Password?</a>
        </div>

        <!-- Submit - same button name as original -->
        <button type="submit" name="login" class="btn-submit">
            LOGIN
        </button>

    </form>

</div>

<script>
// SHOW / HIDE PASSWORD - exactly same function as original
function togglePassword(){
    let input = document.getElementById("password");
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

// Additional: auto-remove error message when user starts typing (UX improvement, doesn't affect original logic)
const errorAlert = document.querySelector('.alert-danger');
const emailInput = document.querySelector('input[name="email"]');
const pwdInput = document.querySelector('input[name="password"]');

if (errorAlert && emailInput && pwdInput) {
    function removeErrorOnTyping() {
        if (errorAlert && errorAlert.parentNode) {
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                if (errorAlert.parentNode) errorAlert.remove();
                // Clean URL from error param without affecting form submission
                if (window.history && history.pushState && window.location.search.includes('error')) {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('error');
                    window.history.replaceState({}, '', url.toString());
                }
            }, 300);
        }
    }
    emailInput.addEventListener('input', removeErrorOnTyping);
    pwdInput.addEventListener('input', removeErrorOnTyping);
}
</script>

</body>
</html>