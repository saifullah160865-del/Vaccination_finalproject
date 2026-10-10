<?php
include("base/header.php");

$role = $_SESSION['role'];
$uid = $_SESSION['user_id'];
?>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Dashboard <span class="highlight">(<?php echo ucfirst($role); ?> Panel)</span></h1>
        </div>
        <div class="col-sm-6 text-sm-end mt-2 mt-sm-0">
          <span class="badge-accredited"><i class="bi bi-shield-check"></i> Accredited</span>
          <span class="badge-emergency ms-2"><i class="bi bi-clock"></i> 24/7 Emergency</span>
          <span class="trust-badge-pill ms-2"><i class="bi bi-star-fill star-highlight"></i> 4.9/5 Rating</span>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <?php if ($role == 'admin') { 
        $total_children = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM children"));
        $total_hospitals = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM hospitals"));
        $total_vaccines = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM vaccines WHERE status='Available'"));
        $total_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bookings"));
      ?>
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $total_children; ?></h3>
              <p>Total Children</p>
            </div>
            <a href="childrens.php" class="small-box-footer">
              <span>View Children</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $total_hospitals; ?></h3>
              <p>Total Hospitals</p>
            </div>
            <a href="hospitals_list.php" class="small-box-footer">
              <span>View Hospitals</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $total_vaccines; ?></h3>
              <p>Available Vaccines</p>
            </div>
            <a href="vaccines_list.php" class="small-box-footer">
              <span>Manage Vaccines</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $total_bookings; ?></h3>
              <p>Total Bookings</p>
            </div>
            <a href="parent_requests.php" class="small-box-footer">
              <span>Review Requests</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Pending Parent Requests</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Parent</th>
                    <th>Child</th>
                    <th>Hospital</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $p_req = mysqli_query($conn, "SELECT bookings.*, users.name as parent_name, children.child_name, hospitals.hospital_name 
                                                FROM bookings 
                                                JOIN users ON bookings.parent_id=users.id 
                                                JOIN children ON bookings.child_id=children.id 
                                                JOIN hospitals ON bookings.hospital_id=hospitals.id 
                                                WHERE bookings.status='Pending' LIMIT 5");
                  if (mysqli_num_rows($p_req) > 0) {
                    while ($r = mysqli_fetch_array($p_req)) {
                      echo "<tr>
                              <td><strong>".$r['parent_name']."</strong></td>
                              <td>".$r['child_name']."</td>
                              <td>".$r['hospital_name']."</td>
                              <td>".$r['booking_date']."</td>
                              <td><a href='parent_requests.php' class='btn btn-sm btn-primary'>View</a></td>
                            </tr>";
                    }
                  } else {
                    echo "<tr><td colspan='5' class='text-center text-muted'>No pending requests</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Upcoming Vaccination Dates</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Child</th>
                    <th>Vaccine</th>
                    <th>Scheduled Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $up_q = mysqli_query($conn, "SELECT vaccination_dates.*, children.child_name, vaccines.vaccine_name 
                                               FROM vaccination_dates 
                                               JOIN children ON vaccination_dates.child_id=children.id 
                                               JOIN vaccines ON vaccination_dates.vaccine_id=vaccines.id 
                                               WHERE vaccination_dates.status='Pending' 
                                               ORDER BY vaccination_dates.vaccination_date ASC LIMIT 5");
                  if (mysqli_num_rows($up_q) > 0) {
                    while ($u = mysqli_fetch_array($up_q)) {
                      echo "<tr>
                              <td><strong>".$u['child_name']."</strong></td>
                              <td>".$u['vaccine_name']."</td>
                              <td>".$u['vaccination_date']."</td>
                              <td><span class='badge badge-soft-blue'>".$u['status']."</span></td>
                            </tr>";
                    }
                  } else {
                    echo "<tr><td colspan='4' class='text-center text-muted'>No upcoming schedules</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <?php } else if ($role == 'parent') { 
        $p_children = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM children WHERE parent_id='$uid'"));
        $p_upcoming = mysqli_num_rows(mysqli_query($conn, "SELECT vaccination_dates.id FROM vaccination_dates JOIN children ON vaccination_dates.child_id=children.id WHERE children.parent_id='$uid' AND vaccination_dates.status='Pending'"));
        $p_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bookings WHERE parent_id='$uid'"));
        $p_reports = mysqli_num_rows(mysqli_query($conn, "SELECT vaccination_reports.id FROM vaccination_reports JOIN children ON vaccination_reports.child_id=children.id WHERE children.parent_id='$uid' AND vaccination_reports.status='Vaccinated'"));
      ?>
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $p_children; ?></h3>
              <p>My Registered Children</p>
            </div>
            <a href="childrens.php" class="small-box-footer">
              <span>Manage Children</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $p_upcoming; ?></h3>
              <p>Upcoming Vaccinations</p>
            </div>
            <a href="vaccination_dates.php" class="small-box-footer">
              <span>View Schedules</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $p_bookings; ?></h3>
              <p>My Hospital Bookings</p>
            </div>
            <a href="my_bookings.php" class="small-box-footer">
              <span>Booking Status</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $p_reports; ?></h3>
              <p>Vaccinations Completed</p>
            </div>
            <a href="my_reports.php" class="small-box-footer">
              <span>View Reports</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="card card-primary card-outline mb-4">
        <div class="card-header">
          <h3 class="card-title text-primary"><i class="bi bi-bell-fill me-2"></i> Upcoming Vaccination Notifications</h3>
        </div>
        <div class="card-body">
          <?php
          $notif_q = mysqli_query($conn, "SELECT vaccination_dates.*, children.child_name, vaccines.vaccine_name 
                                          FROM vaccination_dates 
                                          JOIN children ON vaccination_dates.child_id=children.id 
                                          JOIN vaccines ON vaccination_dates.vaccine_id=vaccines.id 
                                          WHERE children.parent_id='$uid' AND vaccination_dates.status='Pending' 
                                          ORDER BY vaccination_dates.vaccination_date ASC");
          if (mysqli_num_rows($notif_q) > 0) {
            echo "<div class='list-group'>";
            while ($n = mysqli_fetch_array($notif_q)) {
              echo "<div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                      <div>
                        <h6 class='mb-1'><strong>".$n['child_name']."</strong> is scheduled for <span class='highlight'>".$n['vaccine_name']."</span></h6>
                        <small class='text-muted'>Scheduled Date: ".$n['vaccination_date']."</small>
                      </div>
                      <a href='book_hospital.php?child_id=".$n['child_id']."&vaccination_id=".$n['id']."' class='btn btn-sm btn-primary'>Book Hospital Now</a>
                    </div>";
            }
            echo "</div>";
          } else {
            echo "<p class='text-muted mb-0'>No pending upcoming vaccinations scheduled at this moment.</p>";
          }
          ?>
        </div>
      </div>

      <?php } else if ($role == 'hospital') {
        $h_id_res = mysqli_query($conn, "SELECT id FROM hospitals WHERE user_id='$uid'");
        $h_row = mysqli_fetch_array($h_id_res);
        $my_hosp_id = isset($h_row['id']) ? $h_row['id'] : 0;

        $h_total_b = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bookings WHERE hospital_id='$my_hosp_id'"));
        $h_pending_b = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bookings WHERE hospital_id='$my_hosp_id' AND status='Approved'"));
        $h_done_b = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM vaccination_reports WHERE hospital_id='$my_hosp_id' AND status='Vaccinated'"));
        $h_vaccines = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM vaccines WHERE status='Available'"));
      ?>
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $h_total_b; ?></h3>
              <p>Total Bookings</p>
            </div>
            <a href="hospital_bookings.php" class="small-box-footer">
              <span>View Appointments</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $h_pending_b; ?></h3>
              <p>Pending Vaccinations</p>
            </div>
            <a href="hospital_bookings.php" class="small-box-footer">
              <span>Update Status</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $h_done_b; ?></h3>
              <p>Completed Vaccinations</p>
            </div>
            <a href="hospital_bookings.php" class="small-box-footer">
              <span>View Reports</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box stat-card-medical">
            <div class="inner">
              <h3 class="stat-number"><?php echo $h_vaccines; ?></h3>
              <p>Available Vaccines</p>
            </div>
            <a href="vaccines_list.php" class="small-box-footer">
              <span>Check Vaccines</span> <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
</main>

<?php
include("base/footer.php");
?>