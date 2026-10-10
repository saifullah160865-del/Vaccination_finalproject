<?php
include("base/header.php");

$uid = $_SESSION['user_id'];
$h_q = mysqli_query($conn, "SELECT id, hospital_name FROM hospitals WHERE user_id='$uid'");
$h_data = mysqli_fetch_array($h_q);
$hosp_id = isset($h_data['id']) ? $h_data['id'] : 0;

if (isset($_POST['save_status'])) {
  extract($_POST);

  $check_rep = mysqli_query($conn, "SELECT id FROM vaccination_reports WHERE booking_id='$booking_id'");
  if (mysqli_num_rows($check_rep) > 0) {
    mysqli_query($conn, "UPDATE vaccination_reports SET status='$vaccine_status', remarks='$remarks', vaccination_date='$vaccination_date' WHERE booking_id='$booking_id'");
  } else {
    mysqli_query($conn, "INSERT INTO vaccination_reports (booking_id, child_id, vaccine_id, hospital_id, vaccination_date, status, remarks) 
                         VALUES ('$booking_id', '$child_id', '$vaccine_id', '$hosp_id', '$vaccination_date', '$vaccine_status', '$remarks')");
  }

  if ($vaccine_status == 'Vaccinated') {
    mysqli_query($conn, "UPDATE bookings SET status='Completed' WHERE id='$booking_id'");
    mysqli_query($conn, "UPDATE vaccination_dates SET status='Completed' WHERE id='$vaccination_id'");
  }
  echo "<script>location.assign('hospital_bookings.php');</script>";
}

$update_data = null;
if (isset($_GET['update_id'])) {
  $up_id = $_GET['update_id'];
  $up_q = mysqli_query($conn, "SELECT bookings.*, children.child_name, vaccines.vaccine_name, vaccination_dates.id AS v_sched_id, vaccination_dates.vaccine_id 
                              FROM bookings 
                              JOIN children ON bookings.child_id = children.id 
                              JOIN vaccination_dates ON bookings.vaccination_id = vaccination_dates.id 
                              JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                              WHERE bookings.id='$up_id' AND bookings.hospital_id='$hosp_id'");
  $update_data = mysqli_fetch_array($up_q);
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Hospital Appointments & Vaccine Status</h3>
  </div>

  <?php if ($update_data) { ?>
  <div class="card mb-4 m-3">
    <div class="card-header bg-primary text-white">
      <h3 class="card-title">Update Vaccination Status - Booking #<?php echo $update_data['id']; ?></h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <input type="hidden" name="booking_id" value="<?php echo $update_data['id']; ?>">
        <input type="hidden" name="child_id" value="<?php echo $update_data['child_id']; ?>">
        <input type="hidden" name="vaccine_id" value="<?php echo $update_data['vaccine_id']; ?>">
        <input type="hidden" name="vaccination_id" value="<?php echo $update_data['v_sched_id']; ?>">

        <div class="row">
          <div class="col-md-4 mb-3">
            <label>Child Name</label>
            <input type="text" class="form-control" value="<?php echo $update_data['child_name']; ?>" readonly>
          </div>
          <div class="col-md-4 mb-3">
            <label>Vaccine</label>
            <input type="text" class="form-control" value="<?php echo $update_data['vaccine_name']; ?>" readonly>
          </div>
          <div class="col-md-4 mb-3">
            <label>Date Administered</label>
            <input type="date" name="vaccination_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Vaccination Status</label>
            <select name="vaccine_status" class="form-control" required>
              <option value="Vaccinated">Vaccinated</option>
              <option value="Not Vaccinated">Not Vaccinated</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label>Remarks / Notes</label>
            <input type="text" name="remarks" class="form-control" placeholder="e.g. Dose 1 successfully administered">
          </div>
        </div>

        <button type="submit" name="save_status" class="btn btn-primary">Save Vaccination Status</button>
        <a href="hospital_bookings.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
  <?php } ?>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Child Name</th>
          <th>Parent Name</th>
          <th>Vaccine</th>
          <th>Booking Date</th>
          <th>Appointment Status</th>
          <th>Vaccine Status</th>
          <th>Remarks</th>
          <th style="width: 160px">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT bookings.*, children.child_name, children.date_of_birth, users.name AS parent_name, vaccines.vaccine_name,
                         vaccination_reports.status AS rep_status, vaccination_reports.remarks 
                  FROM bookings 
                  JOIN children ON bookings.child_id = children.id 
                  JOIN users ON bookings.parent_id = users.id 
                  JOIN vaccination_dates ON bookings.vaccination_id = vaccination_dates.id 
                  JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                  LEFT JOIN vaccination_reports ON bookings.id = vaccination_reports.booking_id 
                  WHERE bookings.hospital_id='$hosp_id' 
                  ORDER BY bookings.id DESC";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        if (mysqli_num_rows($execute) > 0) {
          while ($display = mysqli_fetch_array($execute)) {
            $v_status = $display['rep_status'] ? $display['rep_status'] : "Pending";
          ?>
            <tr class="align-middle">
              <td><?php echo $count++; ?></td>
              <td><strong><?php echo $display['child_name']; ?></strong><br><small class="text-muted">DOB: <?php echo $display['date_of_birth']; ?></small></td>
              <td><?php echo $display['parent_name']; ?></td>
              <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
              <td><?php echo $display['booking_date']; ?></td>
              <td><span class="badge badge-soft-blue"><?php echo $display['status']; ?></span></td>
              <td><span class="badge badge-soft-blue"><?php echo $v_status; ?></span></td>
              <td><?php echo $display['remarks'] ? $display['remarks'] : '-'; ?></td>
              <td>
                <a href="hospital_bookings.php?update_id=<?php echo $display['id']; ?>" class="btn btn-primary btn-sm">Update Status</a>
              </td>
            </tr>
          <?php
          }
        } else {
          echo "<tr><td colspan='9' class='text-center text-muted'>No appointments currently assigned to your hospital.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include("base/footer.php");
?>
