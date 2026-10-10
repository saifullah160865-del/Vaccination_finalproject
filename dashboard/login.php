<?php

include("config/db.php");

if(isset($_POST['login'])){

    extract($_POST);

    $login_query = "SELECT * FROM users WHERE email='$email' AND password=sha1('$password')";

    $execute = mysqli_query($conn, $login_query);

    if(mysqli_num_rows($execute) > 0){

        $user = mysqli_fetch_array($execute);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

            header("Location: index.php");
    }
    else{
        echo "Invalid Email or Password";
    }
}

?>


<!doctype html>
<html lang="en" data-bs-theme="light">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vaxcare | Medical Login</title>

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
    <meta name="title" content="AdminLTE 4 | Login Page" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="../css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!--begin::Medical Theme-->
    <link rel="stylesheet" href="css/medical-theme.css" />
    <!--end::Medical Theme-->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="login-page">
    <main class="login-box">
      <h1 class="login-logo mb-4">
        <a href="index.php" class="text-primary fw-bold text-decoration-none fs-2">
          <i class="bi bi-heart-pulse-fill me-2"></i>Vaxcare
        </a>
      </h1>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg text-secondary fw-semibold">Sign in to your medical session</p>

          <form method="post">
            <label class="visually-hidden" for="loginEmail">Email</label>
            <div class="input-group mb-3">
              <input id="loginEmail" type="email" class="form-control" placeholder="Email" name="email" />
              <div class="input-group-text">
                <span class="bi bi-envelope"></span>
              </div>
            </div>
            <label class="visually-hidden" for="loginPassword">Password</label>
            <div class="input-group mb-3">
              <input
                id="loginPassword"
                type="password"
                class="form-control"
                placeholder="Password"
                name="password"
              />
              <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
              </div>
            </div>
            <!--begin::Row-->
            <div class="row">
              
              <div class="col-12">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </main>
    <!-- /.login-box -->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->

    <!--begin::Color Mode Toggle-->
    <!-- The light/dark/auto switcher ships in adminlte.js as the ColorMode
     module (since 4.1) — no page script needed. Only the no-flash snippet
     in <head> stays inline, because it must run before first paint. -->
    <!--end::Color Mode Toggle-->

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
