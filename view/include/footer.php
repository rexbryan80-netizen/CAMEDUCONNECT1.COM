<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <!-- Brand Column -->
      <div class="footer-brand">
        <div class="footer-logo">
          <i class="fas fa-graduation-cap"></i>
          <span>Cameroon Education Connect</span>
        </div>
        <p class="footer-description">
          Bridging the gap between students, institutes, and experts across Cameroon. Empowering the next generation through quality education and mentorship.
        </p>
        <div class="social-links">
          <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Quick Links Column -->
      <div class="footer-links">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="../home/index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
          <li><a href="../institute/institutes.php"><i class="fas fa-chevron-right"></i> Institutes</a></li>
          <li><a href="../expert/experts.php"><i class="fas fa-chevron-right"></i> Experts</a></li>
          <li><a href="../student/students.php"><i class="fas fa-chevron-right"></i> Students</a></li>
        </ul>
      </div>

      <!-- Support Column -->
      <div class="footer-links">
        <h5>Support</h5>
        <ul>
          <li><a href="../about/about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
          <li><a href="../contact/contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
          <li><a href="../login.php"><i class="fas fa-chevron-right"></i> Login</a></li>
          <li><a href="../register.php"><i class="fas fa-chevron-right"></i> Register</a></li>
        </ul>
      </div>

      <!-- Contact & Newsletter Column -->
      <div class="footer-contact">
        <h5>Get In Touch</h5>
        <ul class="contact-list">
          <li><i class="fas fa-phone-alt"></i> <span>+237 675 544 181</span></li>
          <li><i class="fas fa-phone-alt"></i> <span>+237 687 115 819</span></li>
          <li><i class="fas fa-envelope"></i> <span>info@camerooneduconnect.cm</span></li>
          <li><i class="fas fa-map-marker-alt"></i> <span>Yaoundé, Cameroon</span></li>
        </ul>
        <!-- Newsletter Signup -->
        <div class="newsletter">
          <p class="newsletter-text">Subscribe for updates</p>
          <form class="newsletter-form" action="#" method="POST">
            <input type="email" placeholder="Your email address" required>
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
      <p>&copy; 2026 Cameroon Education Connect. All rights reserved.</p>
      <div class="footer-bottom-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>

<style>
  /* Modern Footer Styling - Dashboard Theme */
  .site-footer {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #e2e8f0;
    margin-top: 4rem;
    padding: 3rem 0 1.5rem;
    position: relative;
    border-top: 1px solid rgba(56, 189, 248, 0.2);
  }

  .site-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #38bdf8, #818cf8, #38bdf8);
  }

  .footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
  }

  /* Brand Section */
  .footer-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }

  .footer-logo i {
    font-size: 2rem;
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .footer-logo span {
    font-size: 1.25rem;
    font-weight: 700;
    background: linear-gradient(135deg, #fff, #cbd5e1);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .footer-description {
    font-size: 0.85rem;
    line-height: 1.6;
    color: #94a3b8;
    margin-bottom: 1.25rem;
  }

  /* Social Icons */
  .social-links {
    display: flex;
    gap: 0.75rem;
  }

  .social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgba(56, 189, 248, 0.1);
    border-radius: 50%;
    color: #38bdf8;
    transition: all 0.3s ease;
    border: 1px solid rgba(56, 189, 248, 0.2);
  }

  .social-icon:hover {
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    color: white;
    transform: translateY(-3px);
    border-color: transparent;
  }

  /* Links Sections */
  .footer-links h5, .footer-contact h5 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 1.25rem;
    color: white;
    position: relative;
    display: inline-block;
  }

  .footer-links h5::after, .footer-contact h5::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    border-radius: 2px;
  }

  .footer-links ul, .contact-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-links li {
    margin-bottom: 0.7rem;
  }

  .footer-links a {
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .footer-links a i {
    font-size: 0.7rem;
    color: #38bdf8;
    transition: transform 0.2s;
  }

  .footer-links a:hover {
    color: #38bdf8;
    transform: translateX(5px);
  }

  .footer-links a:hover i {
    transform: translateX(3px);
  }

  /* Contact List */
  .contact-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.8rem;
    font-size: 0.85rem;
    color: #94a3b8;
  }

  .contact-list li i {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(56, 189, 248, 0.1);
    border-radius: 50%;
    color: #38bdf8;
    font-size: 0.8rem;
  }

  /* Newsletter */
  .newsletter {
    margin-top: 1rem;
  }

  .newsletter-text {
    font-size: 0.8rem;
    color: #cbd5e1;
    margin-bottom: 0.6rem;
    font-weight: 500;
  }

  .newsletter-form {
    display: flex;
    gap: 0.5rem;
  }

  .newsletter-form input {
    flex: 1;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(56, 189, 248, 0.3);
    border-radius: 2rem;
    padding: 0.6rem 1rem;
    font-size: 0.8rem;
    color: white;
    outline: none;
    transition: all 0.3s;
  }

  .newsletter-form input::placeholder {
    color: #64748b;
  }

  .newsletter-form input:focus {
    border-color: #38bdf8;
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
  }

  .newsletter-form button {
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    border: none;
    border-radius: 2rem;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
  }

  .newsletter-form button:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(56, 189, 248, 0.4);
  }

  /* Footer Bottom */
  .footer-bottom {
    border-top: 1px solid rgba(56, 189, 248, 0.15);
    padding-top: 1.5rem;
    margin-top: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .footer-bottom p {
    font-size: 0.75rem;
    color: #64748b;
    margin: 0;
  }

  .footer-bottom-links {
    display: flex;
    gap: 1.5rem;
  }

  .footer-bottom-links a {
    font-size: 0.75rem;
    color: #64748b;
    text-decoration: none;
    transition: color 0.3s;
  }

  .footer-bottom-links a:hover {
    color: #38bdf8;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .site-footer {
      padding: 2rem 0 1rem;
    }
    
    .footer-grid {
      gap: 1.5rem;
    }
    
    .footer-bottom {
      flex-direction: column;
      text-align: center;
    }
    
    .footer-bottom-links {
      justify-content: center;
    }
  }
</style>