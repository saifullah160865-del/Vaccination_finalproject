<?php
include("config/db.php");
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> Vaxcare | Medical Dashboard</title>

  <!--begin::Theme Init-->
  <script>
    (() => {
      'use strict';
      const root = document.documentElement;
      root.setAttribute('data-bs-theme', 'light');
      root.style.colorScheme = 'light';
    })();
  </script>
  <!--end::Theme Init-->

  <!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <!--end::Accessibility Meta Tags-->

  <!--begin::Primary Meta Tags-->
  <meta name="title" content="AdminLTE v4 | Dashboard" />
  <meta name="author" content="ColorlibHQ" />
  <meta
    name="description"
    content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind." />
  <meta
    name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel" />
  <!--end::Primary Meta Tags-->

  <!--begin::Accessibility Features-->
  <!-- Skip links will be dynamically added by accessibility.js -->
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="./css/adminlte.css" as="style" />
  <!--end::Accessibility Features-->

  <!--begin::Fonts-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
    crossorigin="anonymous"
    media="print"
    onload="this.media = 'all'" />
  <!--end::Fonts-->

  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="./css/adminlte.css" />
  <!--end::Required Plugin(AdminLTE)-->

  <!--begin::Medical Theme (Royal Blue, Pure White/Soft Blue, Charcoal/Navy)-->
  <link rel="stylesheet" href="./css/medical-theme.css" />
  <!--end::Medical Theme-->

  <!-- jsvectormap -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
    crossorigin="anonymous" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-white">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a
              class="nav-link"
              data-lte-toggle="sidebar"
              href="#"
              role="button"
              aria-label="Toggle sidebar">
              <i class="bi bi-list"></i>
            </a>
          </li>

        </ul>

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
          <!--begin::Search (small screens: the field above is hidden, so link to the search page)-->
          <li class="nav-item d-md-none">
            <a class="nav-link" href="./pages/search-results.html" aria-label="Search">
              <i class="bi bi-search" aria-hidden="true"></i>
            </a>
          </li>

          <!--begin::User Menu Dropdown-->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img
                src="./assets/img/user2-160x160.jpg"
                class="user-image rounded-circle shadow"
                alt="User Image" />
              <span class="d-none d-md-inline"><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <!--begin::User Image-->
              <li class="user-header text-bg-primary">
                <img
                  src="./assets/img/user2-160x160.jpg"
                  class="rounded-circle shadow"
                  alt="User Image" />
                <p>
                  <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; ?> - <?php echo isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : ''; ?>
                  <small>Infant Vaccination Management System</small>
                </p>
              </li>
              <!--end::User Image-->
              <!--begin::Menu Footer-->
              <li class="user-footer">
                <a href="profile.php" class="btn btn-outline-secondary">Profile</a>
                <a href="logout.php" class="btn btn-outline-danger float-end">Sign out</a>
              </li>
              <!--end::Menu Footer-->
            </ul>
          </li>
          <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-white shadow-sm border-end" data-bs-theme="light">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="index.php" class="brand-link">
          <!--begin::Brand Image-->
          <img
            src="./assets/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow" />
          <!--end::Brand Image-->
          <!--begin::Brand Text-->
          <span class="brand-text fw-bold text-primary">Vaxcare</span>
          <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Search-->
      <div class="sidebar-search" role="search">
        <label for="sidebar-search-input" class="visually-hidden">Filter menu</label>
        <input
          type="search"
          id="sidebar-search-input"
          class="form-control form-control-sm"
          placeholder="Filter menu…"
          autocomplete="off"
          data-lte-toggle="sidebar-search"
          data-lte-target="#navigation" />
        <p class="fs-7 text-secondary mt-2 mb-0" data-lte-search-empty role="status" hidden>
          No matching pages.
        </p>
      </div>
      <!--end::Sidebar Search-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">


          <!--begin::Sidebar Menu-->
          <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            data-accordion="false"
            id="navigation">  

            <?php
            if ($_SESSION['role'] == "admin") {
            ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-people"></i>
                  <p>
                    Children
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="childrens.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Child Details</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="vaccination_dates.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Vaccination Dates</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-capsule"></i>
                  <p>
                    Vaccination
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="vaccination_dates.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Date & Time</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="vaccination_reports.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Vaccination Reports</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="vaccination_reports.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Date Wise Report</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="vaccines_list.php" class="nav-link">
                  <i class="nav-icon bi bi-prescription2"></i>
                  <p>
                    Vaccines
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Vaccine List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Available / Unavailable</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="parent_requests.php" class="nav-link">
                  <i class="nav-icon bi bi-person-check"></i>
                  <p>
                    Parent Requests
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="parent_requests.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="parent_requests.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Approve / Reject</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="add_hospital.php" class="nav-link">
                  <i class="nav-icon bi bi-hospital"></i>
                  <p>
                    Hospitals
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="add_hospital.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Hospital</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="hospitals_list.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>List of Hospitals</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="manage_hospitals.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Update / Delete Hospital</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="bookings.php" class="nav-link">
                  <i class="nav-icon bi bi-calendar-check"></i>
                  <p>Booking Details</p>
                </a>
              </li>

            <?php
            } else if ($_SESSION['role'] == "parent") {
            ?>
              <li class="nav-item">
                <a href="childrens.php" class="nav-link">
                  <i class="nav-icon bi bi-people"></i>
                  <p>My Children</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="vaccines_list.php" class="nav-link">
                  <i class="nav-icon bi bi-calendar-date"></i>
                  <p>Vaccination Dates</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="book_hospital.php" class="nav-link">
                  <i class="nav-icon bi bi-hospital"></i>
                  <p>Book Hospital</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="my_bookings.php" class="nav-link">
                  <i class="nav-icon bi bi-clock-history"></i>
                  <p>Booking Status</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="my_reports.php" class="nav-link">
                  <i class="nav-icon bi bi-file-earmark-medical"></i>
                  <p>Vaccination Reports</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="profile.php" class="nav-link">
                  <i class="nav-icon bi bi-person"></i>
                  <p>My Profile</p>
                </a>
              </li>

            <?php
            } else if ($_SESSION['role'] == "hospital") {
            ?>
              <li class="nav-item">
                <a href="hospital_bookings.php" class="nav-link">
                  <i class="nav-icon bi bi-calendar2-check"></i>
                  <p>Appointments & Status</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="vaccines_list.php" class="nav-link">
                  <i class="nav-icon bi bi-prescription2"></i>
                  <p>Vaccine Availability</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="profile.php" class="nav-link">
                  <i class="nav-icon bi bi-hospital"></i>
                  <p>Hospital Profile</p>
                </a>
              </li>
            <?php
            }
            ?>






          </ul>
          <!--end::Sidebar Menu-->




        </nav>
      </div>
      <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->