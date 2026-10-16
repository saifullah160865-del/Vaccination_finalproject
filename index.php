  <?php
    include("base/header.php");
  ?> 

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">
              <div class="trust-badges mb-4" data-aos="fade-right" data-aos-delay="200">
                <div class="badge-item">
                  <i class="bi bi-shield-check"></i>
                  <span>WHO Standards</span>
                </div>
                <div class="badge-item">
                  <i class="bi bi-hospital"></i>
                  <span>Certified Hospitals</span>
                </div>
                <div class="badge-item">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Safe Immunization</span>
                </div>
              </div>

              <h1 data-aos="fade-right" data-aos-delay="300">
                Protecting Every Child With <span class="highlight">Timely Vaccination</span> & Care
              </h1>

              <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                A comprehensive digital child vaccination management system. Track scheduled immunization milestones, book appointments with verified pediatric hospitals, and maintain secure digital vaccination records effortlessly.
              </p>

              <?php
                $c_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM children"));
                $h_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM hospitals"));
                $v_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM vaccines"));
              ?>
              <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="<?php echo max($c_count, 150); ?>" data-purecounter-duration="2"
                      class="purecounter"></span>+</h3>
                  <p>Children Protected</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="<?php echo max($h_count, 25); ?>" data-purecounter-duration="2"
                      class="purecounter"></span>+</h3>
                  <p>Partner Hospitals</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="<?php echo max($v_count, 14); ?>" data-purecounter-duration="2"
                      class="purecounter"></span>+</h3>
                  <p>Vaccines Tracked</p>
                </div>
              </div>

              <div class="hero-actions" data-aos="fade-right" data-aos-delay="600">
                <a href="dashboard/register.php" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i> Register Child</a>
                <a href="dashboard/login.php" class="btn btn-outline-primary ms-2">
                  <i class="bi bi-box-arrow-in-right me-1"></i> Sign In Portal
                </a>
              </div>

              <div class="emergency-contact" data-aos="fade-right" data-aos-delay="700">
                <div class="emergency-icon">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="emergency-info">
                  <small>Emergency Hotline</small>
                  <strong>+92 300 2160865</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
              <div class="main-image">
                <img src="assets/img/health/staff-10.webp" alt="Modern Healthcare Facility" class="img-fluid">
                <div class="floating-card appointment-card">
                  <div class="card-icon">
                    <i class="bi bi-calendar-check"></i>
                  </div>
                  <div class="card-content">
                    <h6>Next Available</h6>
                    <p>Today 2:30 PM</p>
                    <small>Dr. Sarah Johnson</small>
                  </div>
                </div>
                <div class="floating-card rating-card">
                  <div class="card-content">
                    <div class="rating-stars">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </div>
                    <h6>4.9/5</h6>
                    <small>1,234 Reviews</small>
                  </div>
                </div>
              </div>
              <div class="background-elements">
                <div class="element element-1"></div>
                <div class="element element-2"></div>
                <div class="element element-3"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
            <div class="about-content">
              <h2 class="section-heading">Dedicated to Child Health & Universal Immunization</h2>
              <p class="lead-text">Vaxcare empowers families and healthcare providers with automated vaccination schedules, ensuring every infant receives vital protection on time.</p>

              <p>Our intelligent system calculates vaccination timelines from birth, connects parents directly with accredited hospitals, and maintains certified digital immunization records. We bridge the gap between parents and healthcare facilities to make pediatric care simple, safe, and reliable.</p>

              <div class="stats-grid">
                <div class="stat-item">
                <?php
                  $select_query = "SELECT * FROM children";
                  $result = mysqli_query($conn, $select_query);
                  $count = mysqli_num_rows($result);
                ?>
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="<?php echo max($count, 150); ?>"
                    data-purecounter-duration="1"></div>
                  <div class="stat-label">Children Enrolled</div>
                </div>
                <div class="stat-item">
                <?php
                  $select_query = "SELECT * FROM hospitals";
                  $result = mysqli_query($conn, $select_query);
                  $count_hospitals = mysqli_num_rows($result);
                ?>
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="<?php echo max($count_hospitals, 25); ?>"
                    data-purecounter-duration="1"></div>
                  <div class="stat-label">Partner Hospitals</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="<?php echo max($v_count, 14); ?>"
                    data-purecounter-duration="1"></div>
                  <div class="stat-label">Essential Vaccines</div>
                </div>
              </div>

              <div class="cta-section">
                <a href="#featured-services" class="btn-primary">Explore Our Services</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="about-visual">
              <div class="main-image">
                <img src="assets/img/health/facilities-9.webp" alt="Modern medical facility" class="img-fluid">
              </div>
              <div class="floating-card">
                <div class="card-content">
                  <div class="icon">
                    <i class="bi bi-heart-pulse"></i>
                  </div>
                  <div class="card-text">
                    <h4>24/7 Emergency Care</h4>
                    <p>Always here when you need us most</p>
                  </div>
                </div>
              </div>
              <div class="experience-badge">
                <div class="badge-content">
                  <span class="years">25+</span>
                  <span class="text">Years of Trusted Care</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Home About Section -->

    <!-- Featured Departments Section -->
    <section id="featured-departments" class="featured-departments section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Essential Child Vaccines</h2>
        <p>Key immunizations safeguarding infants and young children against preventable illnesses</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <?php
          $vac_q = mysqli_query($conn, "SELECT * FROM vaccines WHERE status='Available' ORDER BY id ASC LIMIT 6");
          if (mysqli_num_rows($vac_q) > 0) {
            while ($v = mysqli_fetch_array($vac_q)) {
          ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2"><?php echo htmlspecialchars($v['vaccine_name']); ?></h4>
                <p class="text-secondary small mb-3"><?php echo htmlspecialchars($v['description']); ?></p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available
                  </span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>
          <?php
            }
          } else {
          ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">BCG Vaccine</h4>
                <p class="text-secondary small mb-3">Administered at birth to provide vital, lifelong protection against severe childhood tuberculosis.</p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available
                  </span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">Hepatitis B</h4>
                <p class="text-secondary small mb-3">Crucial birth dose and infant booster sequence guarding against chronic liver inflammation and infections.</p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available
                  </span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">OPV &amp; IPV (Polio)</h4>
                <p class="text-secondary small mb-3">Oral and injectable polio vaccines ensuring complete immunity and prevention of poliomyelitis.</p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available</span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">Pentavalent</h4>
                <p class="text-secondary small mb-3">Combined five-in-one vaccine protecting against Diphtheria, Pertussis, Tetanus, Hepatitis B, and Hib.</p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available
                  </span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">PCV (Pneumococcal)</h4>
                <p class="text-secondary small mb-3">Protects infants against severe pneumococcal disease, pneumonia, and related bacterial infections.</p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available
                  </span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
              <div class="department-highlight h-100 p-4 rounded shadow-sm bg-white border">
                <div class="highlight-icon mb-3 text-primary" style="font-size: 36px;">
                  <i class="bi bi-shield-plus"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">Measles &amp; MMR</h4>
                <p class="text-secondary small mb-3">Administered at 9 and 15 months to build long-term immunity against measles, mumps, and rubella.</p>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                  <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small">
                    <i class="bi bi-check-circle me-1"></i> Available
                  </span>
                  <a href="dashboard/login.php" class="small text-primary fw-semibold text-decoration-none">Book Slot &rarr;</a>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>

        <div class="emergency-banner mt-5" data-aos="fade-up" data-aos-delay="400">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <div class="emergency-content">
                <h3>Pediatric Vaccination Helpline</h3>
                <p>Have questions about vaccination schedules, delayed doses, or hospital bookings? Our support team and participating hospitals are here to help.</p>
              </div>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="tel:+923002160865" class="emergency-btn">
                <i class="bi bi-telephone-fill"></i>
                Helpline: 0300 2160865
              </a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Featured Departments Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Comprehensive Vaccination Services</h2>
        <p>Reliable healthcare and automated immunization management for parents and accredited hospitals</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
            <div class="featured-service-main">
              <div class="service-image-wrapper">
                <img src="assets/img/health/consultation-4.webp" alt="Child Vaccination Services" class="img-fluid"
                  loading="lazy">
                <div class="service-overlay">
                  <div class="service-badge">
                    <i class="bi bi-shield-check"></i>
                    <span>Automated Milestones</span>
                  </div>
                </div>
              </div>
              <div class="service-details">
                <h2>Precision Child Immunization Scheduling</h2>
                <p>Our intelligent system automatically calculates immunization schedules from birth for essential vaccines like BCG, Polio, Pentavalent, PCV, and MMR, preventing missed doses and ensuring complete pediatric protection.</p>
                <a href="dashboard/register.php" class="main-cta"><i class="bi bi-person-plus me-1"></i> Register Your Child</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
            <div class="services-sidebar">

              <div class="service-item" data-aos="fade-up" data-aos-delay="400">
                <div class="service-icon-wrapper">
                  <i class="bi bi-hospital"></i>
                </div>
                <div class="service-info">
                  <h4>Hospital Booking</h4>
                  <p>Book convenient vaccination slots at accredited hospitals and certified pediatric medical centers.</p>
                  <a href="dashboard/login.php" class="service-link">Book Now <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="service-item" data-aos="fade-up" data-aos-delay="500">
                <div class="service-icon-wrapper">
                  <i class="bi bi-file-earmark-medical"></i>
                </div>
                <div class="service-info">
                  <h4>Digital Vaccination Records</h4>
                  <p>Certified digital history and status reports for every administered vaccine, accessible anytime.</p>
                  <a href="dashboard/login.php" class="service-link">Access Records <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="service-item" data-aos="fade-up" data-aos-delay="600">
                <div class="service-icon-wrapper">
                  <i class="bi bi-bell"></i>
                </div>
                <div class="service-info">
                  <h4>Milestone Reminders</h4>
                  <p>Proactive alerts and dashboard notices to guarantee your infant never misses a scheduled dose.</p>
                  <a href="dashboard/login.php" class="service-link">View Dates <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

            </div>
          </div>

        </div>

        <div class="specialties-grid" data-aos="fade-up" data-aos-delay="300">
          <div class="row align-items-center">

            <div class="col-lg-3 col-md-6">
              <div class="specialty-card">
                <div class="specialty-image">
                  <img src="assets/img/health/maternal-2.webp" alt="Maternal Care" class="img-fluid" loading="lazy">
                </div>
                <div class="specialty-content">
                  <h5>Maternal Care</h5>
                  <span>Expert pregnancy &amp; delivery support</span>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="specialty-card">
                <div class="specialty-image">
                  <img src="assets/img/health/vaccination-3.webp" alt="Vaccination" class="img-fluid" loading="lazy">
                </div>
                <div class="specialty-content">
                  <h5>Vaccination</h5>
                  <span>Complete immunization programs</span>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="specialty-card">
                <div class="specialty-image">
                  <img src="assets/img/health/emergency-1.webp" alt="Emergency Care" class="img-fluid" loading="lazy">
                </div>
                <div class="specialty-content">
                  <h5>Emergency Care</h5>
                  <span>24/7 critical care services</span>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="specialty-card">
                <div class="specialty-image">
                  <img src="assets/img/health/facilities-6.webp" alt="Advanced Tech" class="img-fluid" loading="lazy">
                </div>
                <div class="specialty-content">
                  <h5>Advanced Technology</h5>
                  <span>State-of-the-art medical equipment</span>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- Find A Doctor Section -->
    <section id="find-a-doctor" class="find-a-doctor section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Partner Hospitals &amp; Vaccination Centers</h2>
        <p>Certified medical centers and pediatric clinics committed to safe, timely child immunization</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-8 text-center">
            <div class="search-section py-3">
              <h3 class="search-title">Accredited Medical Centers</h3>
              <p class="search-subtitle">Connect with verified hospitals and pediatric clinics equipped for routine and booster child immunizations</p>
            </div>
          </div>
        </div>

        <div class="doctors-grid" data-aos="fade-up" data-aos-delay="300">
          <?php
          $hosp_q = mysqli_query($conn, "SELECT * FROM hospitals ORDER BY id DESC LIMIT 6");
          if (mysqli_num_rows($hosp_q) > 0) {
            while ($h = mysqli_fetch_array($hosp_q)) {
          ?>
            <div class="doctor-profile" data-aos="zoom-in">
              <div class="profile-header">
                <div class="doctor-avatar bg-primary-subtle text-primary d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 70px; height: 70px; font-size: 32px;">
                  <i class="bi bi-hospital"></i>
                </div>
                <div class="doctor-details">
                  <h4><?php echo htmlspecialchars($h['hospital_name']); ?></h4>
                  <span class="specialty-tag"><i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($h['location']); ?></span>
                  <div class="experience-info">
                    <i class="bi bi-telephone"></i>
                    <span><?php echo htmlspecialchars($h['phone']); ?></span>
                  </div>
                </div>
              </div>
              <div class="p-2 bg-light rounded mt-3 mb-2 small text-secondary">
                <i class="bi bi-pin-map me-1 text-primary"></i><?php echo htmlspecialchars($h['address']); ?>
              </div>
              <div class="action-buttons">
                <a href="dashboard/login.php" class="btn-primary w-100 text-center">
                  <i class="bi bi-calendar-check me-1"></i> Book Vaccination
                </a>
              </div>
            </div>
          <?php
            }
          } else {
          ?>
            <div class="doctor-profile" data-aos="zoom-in">
              <div class="profile-header">
                <div class="doctor-avatar bg-primary-subtle text-primary d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 70px; height: 70px; font-size: 32px;">
                  <i class="bi bi-hospital"></i>
                </div>
                <div class="doctor-details">
                  <h4>City Children Hospital</h4>
                  <span class="specialty-tag"><i class="bi bi-geo-alt me-1"></i>Central District</span>
                  <div class="experience-info">
                    <i class="bi bi-telephone"></i>
                    <span>+92 300 2160865</span>
                  </div>
                </div>
              </div>
              <div class="p-2 bg-light rounded mt-3 mb-2 small text-secondary">
                <i class="bi bi-pin-map me-1 text-primary"></i>Main Healthcare Boulevard, Block 4
              </div>
              <div class="action-buttons">
                <a href="dashboard/login.php" class="btn-primary w-100 text-center">
                  <i class="bi bi-calendar-check me-1"></i> Book Vaccination
                </a>
              </div>
            </div>

            <div class="doctor-profile" data-aos="zoom-in">
              <div class="profile-header">
                <div class="doctor-avatar bg-primary-subtle text-primary d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 70px; height: 70px; font-size: 32px;">
                  <i class="bi bi-hospital"></i>
                </div>
                <div class="doctor-details">
                  <h4>National Pediatric Medical Center</h4>
                  <span class="specialty-tag"><i class="bi bi-geo-alt me-1"></i>North Zone</span>
                  <div class="experience-info">
                    <i class="bi bi-telephone"></i>
                    <span>+92 321 8899221</span>
                  </div>
                </div>
              </div>
              <div class="p-2 bg-light rounded mt-3 mb-2 small text-secondary">
                <i class="bi bi-pin-map me-1 text-primary"></i>Sector 8, Medical Enclave
              </div>
              <div class="action-buttons">
                <a href="dashboard/login.php" class="btn-primary w-100 text-center">
                  <i class="bi bi-calendar-check me-1"></i> Book Vaccination
                </a>
              </div>
            </div>

            <div class="doctor-profile" data-aos="zoom-in">
              <div class="profile-header">
                <div class="doctor-avatar bg-primary-subtle text-primary d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 70px; height: 70px; font-size: 32px;">
                  <i class="bi bi-hospital"></i>
                </div>
                <div class="doctor-details">
                  <h4>St. Jude Infant Care Clinic</h4>
                  <span class="specialty-tag"><i class="bi bi-geo-alt me-1"></i>East Medical City</span>
                  <div class="experience-info">
                    <i class="bi bi-telephone"></i>
                    <span>+92 333 4455667</span>
                  </div>
                </div>
              </div>
              <div class="p-2 bg-light rounded mt-3 mb-2 small text-secondary">
                <i class="bi bi-pin-map me-1 text-primary"></i>Avenue 12, Pediatric Health Park
              </div>
              <div class="action-buttons">
                <a href="dashboard/login.php" class="btn-primary w-100 text-center">
                  <i class="bi bi-calendar-check me-1"></i> Book Vaccination
                </a>
              </div>
            </div>
          <?php
          }
          ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
          <a href="dashboard/login.php" class="btn-view-all">
            View All Partner Centers
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </section><!-- /Find A Doctor Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="hero-content">
          <div class="row align-items-center">

            <div class="col-lg-6">
              <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                <h1>Keep Your Child's Immunization On Track</h1>
                <p>Register today to generate your infant's personalized vaccination roadmap, connect with certified hospitals, and track immunization progress in one secure portal.</p>

                <div class="cta-wrapper">
                  <a href="dashboard/register.php" class="primary-cta">
                    <span>Register Your Child</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                  <a href="#featured-services" class="secondary-cta">
                    <span>Explore Services</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                <img src="assets/img/health/facilities-9.webp" alt="Medical Excellence" class="img-fluid">
              </div>
            </div>

          </div>
        </div>

        <div class="features-section">

          <div class="row g-0">

            <div class="col-lg-4">
              <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h3>Certified Vaccines</h3>
                <p>Every vaccine in our database follows international pediatric health protocols and safety standards.</p>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                  <i class="bi bi-clock"></i>
                </div>
                <h3>Automated Milestones</h3>
                <p>Timely notifications and automatic date generation ensure your child receives every dose on schedule.</p>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="feature-block" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                  <i class="bi bi-hospital"></i>
                </div>
                <h3>Verified Hospitals</h3>
                <p>Partnering with registered pediatric clinics and general hospitals across multiple cities.</p>
              </div>
            </div>

          </div>

        </div>

        <div class="contact-block">
          <div class="row">

            <div class="col-lg-8">
              <div class="contact-content" data-aos="fade-up" data-aos-delay="200">
                <h2>Need Immediate Medical Assistance?</h2>
                <p>Our emergency response team is available around the clock to provide immediate medical support when
                  you need it most.</p>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="contact-actions" data-aos="fade-up" data-aos-delay="300">
                <a href="tel:+923002160865" class="emergency-call">
                  <i class="bi bi-telephone"></i>
                  <span>+92 300 2160865</span>
                </a>
                <a href="#footer" class="contact-link">Find Location</a>
              </div>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

  </main>
  <?php
    include("base/footer.php");
  ?>
 