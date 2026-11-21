<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <!-- Brand with Icon -->
    <a class="navbar-brand" href="../home/index.php">
      <div class="brand-icon">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <div class="brand-text">
        <span class="brand-title">Cameroon Education</span>
        <span class="brand-subtitle">Connect</span>
      </div>
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cecNavbar" aria-controls="cecNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
    </button>

    <!-- Nav links -->
    <div class="collapse navbar-collapse" id="cecNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../home/index.php">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../institute/institute.php">
            <i class="fas fa-building"></i>
            <span>Institutes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../expert/experts.php">
            <i class="fas fa-chalkboard-user"></i>
            <span>Experts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../student/students.php">
            <i class="fas fa-users"></i>
            <span>Students</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../about/about.php">
            <i class="fas fa-info-circle"></i>
            <span>About</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact/contact.php">
            <i class="fas fa-envelope"></i>
            <span>Contact</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link login-btn" href="../login.php">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  /* Modern Navbar Styling - Dashboard Theme */
  .navbar {
    background: rgba(15, 23, 42, 0.92);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(56, 189, 248, 0.2);
    padding: 0.75rem 0;
    transition: all 0.3s ease;
  }

  .navbar.scrolled {
    padding: 0.5rem 0;
    background: rgba(15, 23, 42, 0.98);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  }

  /* Brand Styling */
  .navbar-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    transition: transform 0.3s ease;
  }

  .navbar-brand:hover {
    transform: translateY(-1px);
  }

  .brand-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(56, 189, 248, 0.3);
  }

  .brand-icon i {
    font-size: 1.3rem;
    color: white;
  }

  .brand-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
  }

  .brand-title {
    font-size: 0.9rem;
    font-weight: 500;
    color: #94a3b8;
    letter-spacing: 0.5px;
  }

  .brand-subtitle {
    font-size: 1.1rem;
    font-weight: 800;
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    letter-spacing: -0.3px;
  }

  /* Navigation Links */
  .nav-item {
    margin: 0 0.25rem;
  }

  .nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.2rem;
    border-radius: 2rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: #cbd5e1;
    transition: all 0.3s ease;
    position: relative;
  }

  .nav-link i {
    font-size: 0.9rem;
    transition: transform 0.2s;
  }

  .nav-link span {
    transition: all 0.3s;
  }

  .nav-link:hover {
    color: white;
    background: rgba(56, 189, 248, 0.1);
    transform: translateY(-2px);
  }

  .nav-link:hover i {
    transform: translateY(-1px);
    color: #38bdf8;
  }

  /* Active link indicator */
  .nav-link.active {
    background: linear-gradient(135deg, rgba(56, 189, 248, 0.15), rgba(129, 140, 248, 0.1));
    color: #38bdf8;
    border: 1px solid rgba(56, 189, 248, 0.3);
  }

  /* Login Button Special Styling */
  .login-btn {
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    color: white;
    box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
  }

  .login-btn i {
    color: white;
  }

  .login-btn:hover {
    background: linear-gradient(135deg, #2ea5e0, #6f6af0);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(56, 189, 248, 0.4);
  }

  .login-btn:hover i {
    color: white;
  }

  /* Mobile Toggler */
  .navbar-toggler {
    border: 1px solid rgba(56, 189, 248, 0.4);
    padding: 0.5rem 0.75rem;
    background: rgba(56, 189, 248, 0.05);
  }

  .navbar-toggler-icon {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .navbar-toggler-icon i {
    font-size: 1.2rem;
    color: #38bdf8;
  }

  .navbar-toggler:focus {
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.3);
    outline: none;
  }

  /* Responsive Adjustments */
  @media (max-width: 991px) {
    .navbar-collapse {
      margin-top: 1rem;
      padding: 0.5rem 0;
    }
    
    .nav-item {
      margin: 0.25rem 0;
    }
    
    .nav-link {
      justify-content: center;
      padding: 0.7rem 1rem;
    }
    
    .navbar-brand {
      margin-left: 0.5rem;
    }
    
    .brand-title {
      font-size: 0.8rem;
    }
    
    .brand-subtitle {
      font-size: 1rem;
    }
  }

  @media (max-width: 576px) {
    .brand-icon {
      width: 32px;
      height: 32px;
    }
    
    .brand-icon i {
      font-size: 1rem;
    }
    
    .brand-title {
      font-size: 0.7rem;
    }
    
    .brand-subtitle {
      font-size: 0.85rem;
    }
    
    .nav-link {
      font-size: 0.85rem;
      padding: 0.5rem 0.8rem;
    }
  }

  /* Scroll effect */
  .navbar.scrolled .brand-icon {
    width: 35px;
    height: 35px;
  }
</style>

<script>
  // Add scroll effect to navbar
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });

  // Set active link based on current page
  document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const links = document.querySelectorAll('.nav-link');
    
    links.forEach(link => {
      const href = link.getAttribute('href');
      if (href && href.includes(currentPage)) {
        link.classList.add('active');
      } else if (currentPage === '' || currentPage === 'index.php') {
        if (href && href.includes('index.php')) {
          link.classList.add('active');
        }
      }
    });
  });
</script>

<!-- Font Awesome for icons (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">