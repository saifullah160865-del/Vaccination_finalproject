<?php
include("protectedRoute.php");
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

  <!-- DataTables Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
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
            <a class="nav-link" href="#" aria-label="Search">
              <i class="bi bi-search" aria-hidden="true"></i>
            </a>
          </li>

          <!--begin::User Menu Dropdown-->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
              <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center me-2 shadow-sm fw-bold" style="width: 32px; height: 32px; font-size: 14px;">
                <?php echo strtoupper(substr(isset($_SESSION['name']) ? $_SESSION['name'] : 'U', 0, 1)); ?>
              </span>
              <span class="d-none d-md-inline fw-semibold"><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow border-0">
              <!--begin::User Header-->
              <li class="user-header text-bg-primary d-flex flex-column align-items-center justify-content-center p-3">
                <span class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center shadow mb-2 fw-bold" style="width: 60px; height: 60px; font-size: 24px;">
                  <?php echo strtoupper(substr(isset($_SESSION['name']) ? $_SESSION['name'] : 'U', 0, 1)); ?>
                </span>
                <p class="mb-1 fw-bold fs-6">
                  <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; ?>
                </p>
                <span class="badge bg-light text-primary text-uppercase px-2 py-1">
                  <?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>
                </span>
              </li>
              <!--end::User Header-->
              <!--begin::Menu Footer-->
              <li class="user-footer p-2 bg-light d-flex justify-content-between align-items-center">
                <a href="profile.php" class="btn btn-sm btn-outline-secondary"><i class="bi bi-person me-1"></i>Profile</a>
                <a href="logout.php" class="btn btn-sm btn-outline-danger"><i class="bi bi-box-arrow-right me-1"></i>Sign out</a>
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
                <a href="childrens.php" class="nav-link">
                  <i class="nav-icon bi bi-people"></i>
                  <p>All Child Details</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="vaccination_dates.php" class="nav-link">
                  <i class="nav-icon bi bi-calendar2-week"></i>
                  <p>Vaccination Schedule</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="vaccines_list.php" class="nav-link">
                  <i class="nav-icon bi bi-prescription2"></i>
                  <p>Vaccines List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-hospital"></i>
                  <p>
                    Hospitals
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="hospitals_list.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>List of Hospitals</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="add_hospital.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Hospital</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="parent_requests.php" class="nav-link">
                  <i class="nav-icon bi bi-person-check"></i>
                  <p>Parent Requests</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="bookings.php" class="nav-link">
                  <i class="nav-icon bi bi-calendar-check"></i>
                  <p>Booking Details</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="vaccination_reports.php" class="nav-link">
                  <i class="nav-icon bi bi-file-earmark-medical"></i>
                  <p>Vaccination Reports</p>
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
                <a href="my_vaccination_dates.php" class="nav-link">
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