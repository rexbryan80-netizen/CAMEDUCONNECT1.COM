<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<title>Student Register | Cameroon Education Connect</title>

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

    /* FORM CARD - matches original structure */
    .form-box {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
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

    /* Custom Scrollbar */
    .form-box::-webkit-scrollbar {
        width: 6px;
    }
    .form-box::-webkit-scrollbar-track {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 10px;
    }
    .form-box::-webkit-scrollbar-thumb {
        background: rgba(56, 189, 248, 0.5);
        border-radius: 10px;
    }
    .form-box::-webkit-scrollbar-thumb:hover {
        background: rgba(56, 189, 248, 0.8);
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

    /* Alert Styling */
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
    
    .alert-danger.text-center {
        text-align: center;
    }

    /* INPUT - matches original input-box structure */
    .input-box {
        position: relative;
        margin-bottom: 1.25rem;
    }
    
    .input-box input, .input-box select {
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
    
    .input-box select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2338bdf8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1.2rem center;
    }
    
    .input-box select option {
        background: #1e293b;
        color: #e2e8f0;
    }
    
    .input-box input:focus, .input-box select:focus {
        border-color: #38bdf8;
        background: rgba(51, 65, 85, 0.8);
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }
    
    .input-box input::placeholder {
        color: rgba(148, 163, 184, 0.7);
        font-weight: 400;
    }

    /* File Input Styling */
    .input-box input[type="file"] {
        padding: 0.7rem 1rem;
        cursor: pointer;
    }
    
    .input-box input[type="file"]::file-selector-button {
        background: linear-gradient(135deg, #38bdf8, #818cf8);
        border: none;
        border-radius: 0.7rem;
        padding: 0.4rem 1rem;
        color: white;
        font-weight: 600;
        margin-right: 1rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .input-box input[type="file"]::file-selector-button:hover {
        transform: translateY(-1px);
        background: linear-gradient(135deg, #2ea5e0, #6f6af0);
    }

    /* PASSWORD ICON */
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
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #2ea5e0, #6f6af0);
        box-shadow: 0 8px 20px rgba(56, 189, 248, 0.4);
    }
    
    .btn-submit:active {
        transform: translateY(1px);
    }

    /* CHECKBOX */
    .check {
        font-size: 0.8rem;
        margin: 1rem 0 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #cbd5e6;
    }
    
    .check input[type="checkbox"] {
        width: 1rem;
        height: 1rem;
        accent-color: #38bdf8;
        cursor: pointer;
    }
    
    .mb-2 {
        margin-bottom: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 520px) {
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
        <a href="login.php">SIGN IN</a>
        <a class="active">SIGN UP</a>
    </div>

    <!-- Error - exactly same PHP logic as original -->
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Form - exactly same action, method, and enctype as original -->
    <form action="register_process.php" method="POST" enctype="multipart/form-data">

        <!-- Full Name - same as original -->
        <div class="input-box">
            <input type="text" name="fullname" placeholder="Full Name" required>
        </div>

        <!-- Email - same as original -->
        <div class="input-box">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <!-- Phone - same as original -->
        <div class="input-box">
            <input type="text" name="phone" placeholder="Phone Number" required>
        </div>

        <!-- Gender - same as original -->
        <div class="input-box">
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>

        <!-- Region - same as original -->
        <div class="input-box">
            <input type="text" name="region" placeholder="Region" required>
        </div>

        <!-- Profile Image - same as original -->
        <div class="input-box">
            <input type="file" name="profile_image">
        </div>

        <!-- Password - same as original with toggle -->
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password (min 8 characters)" required minlength="8">
            <i class="fa fa-eye toggle" onclick="togglePassword('password')"></i>
        </div>

        <!-- Confirm Password - same as original with toggle -->
        <div class="input-box">
            <input type="password" id="confirm" placeholder="Confirm Password" required>
            <i class="fa fa-eye toggle" onclick="togglePassword('confirm')"></i>
        </div>

        <!-- Agreement - exactly same as original -->
        <div class="check mb-2">
            <input type="checkbox" required> I agree to the terms
        </div>

        <!-- Submit - same button as original -->
        <button class="btn-submit">REGISTER</button>

    </form>
</div>

<script>
// TOGGLE PASSWORD - exactly same function as original
function togglePassword(id){
    let input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

// CONFIRM PASSWORD VALIDATION - exactly same logic as original
document.querySelector("form").addEventListener("submit", function(e){
    let pass = document.getElementById("password").value;
    let confirm = document.getElementById("confirm").value;

    if(pass !== confirm){
        alert("Passwords do not match!");
        e.preventDefault();
    }
});

// Additional: auto-remove error message when user starts typing (UX improvement, doesn't affect original logic)
const errorAlert = document.querySelector('.alert-danger');
const formInputs = document.querySelectorAll('.input-box input, .input-box select');

if (errorAlert) {
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
    formInputs.forEach(input => {
        input.addEventListener('input', removeErrorOnTyping);
    });
}
</script>

</body>
</html>