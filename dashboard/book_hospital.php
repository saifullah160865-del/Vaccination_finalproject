<?php
include("base/header.php");

$parent_id = $_SESSION['user_id'];
$msg = "";
$err = "";

$selected_child_id = isset($_GET['child_id']) ? $_GET['child_id'] : "";
$selected_vaccination_id = isset($_GET['vaccination_id']) ? $_GET['vaccination_id'] : "";

if (isset($_POST['book_appointment'])) {
  extract($_POST);

  if ($child_id == "" || $hospital_id == "" || $booking_date == "") {
    $err = "Please select child, hospital, and booking date.";
  } else {
    $v_id = $vaccination_id;
    if ($v_id == "" && isset($vaccine_id) && $vaccine_id != "") {
      $sched_q = "INSERT INTO vaccination_dates (child_id, vaccine_id, vaccination_date, status) VALUES ('$child_id', '$vaccine_id', '$booking_date', 'Pending')";
      mysqli_query($conn, $sched_q);
      $v_id = mysqli_insert_id($conn);
    }

    if ($v_id != "") {
      $book_sql = "INSERT INTO bookings (parent_id, child_id, hospital_id, vaccination_id, booking_date, status) 
                   VALUES ('$parent_id', '$child_id', '$hospital_id', '$v_id', '$booking_date', 'Pending')";
      if (mysqli_query($conn, $book_sql)) {
        echo "<script>location.assign('my_bookings.php');</script>";
      } else {
        $err = "Could not complete booking request.";
      }
    } else {
      $err = "Please select a vaccine or scheduled date.";
    }
  }
}
?>

<div class="row">
  <div class="col-lg-8 mx-auto">
    <div class="card card-primary card-outline mb-4">
      <div class="card-header">
        <h3 class="card-title text-primary"><i class="bi bi-calendar-plus me-2"></i> Book Hospital Vaccination Appointment</h3>
      </div>

      <?php if ($err != "") { ?>
        <div class="alert alert-danger m-3"><?php echo $err; ?></div>
      <?php } ?>

      <form method="POST">
        <div class="card-body">
          <div class="mb-3">
            <label>Select Child</label>
            <select name="child_id" class="form-control" required>
              <option value="">Select Child</option>
              <?php
              $c_res = mysqli_query($conn, "SELECT * FROM children WHERE parent_id='$parent_id'");
              while ($c = mysqli_fetch_array($c_res)) {
                $sel = ($c['id'] == $selected_child_id) ? "selected" : "";
                echo "<option value='".$c['id']."' $sel>".$c['child_name']." (DOB: ".$c['date_of_birth'].")</option>";
              }
              ?>
            </select>
          </div>

          <?php if ($selected_vaccination_id != "") { ?>
            <input type="hidden" name="vaccination_id" value="<?php echo $selected_vaccination_id; ?>">
            <div class="mb-3">
              <label>Vaccination Schedule ID</label>
              <input type="text" class="form-control" value="Schedule #<?php echo $selected_vaccination_id; ?>" readonly>
            </div>
          <?php } else { ?>
            <div class="mb-3">
              <label>Select Vaccine</label>
              <select name="vaccine_id" class="form-control" required>
                <option value="">Select Vaccine</option>
                <?php
                $v_res = mysqli_query($conn, "SELECT * FROM vaccines WHERE status='Available'");
                while ($v = mysqli_fetch_array($v_res)) {
                  echo "<option value='".$v['id']."'>".$v['vaccine_name']."</option>";
                }
                ?>
              </select>
            </div>
          <?php } ?>

          <div class="mb-3">
            <label>Select Hospital</label>
            <select name="hospital_id" class="form-control" required>
              <option value="">Select Hospital</option>
              <?php
              $h_res = mysqli_query($conn, "SELECT * FROM hospitals");
              while ($h = mysqli_fetch_array($h_res)) {
                echo "<option value='".$h['id']."'>".$h['hospital_name']." (".$h['location']." - ".$h['address'].")</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label>Preferred Booking Date</label>
            <input type="date" name="booking_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" name="book_appointment" class="btn btn-primary">Submit Booking Request</button>
          <a href="my_bookings.php" class="btn btn-secondary">My Bookings</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include("base/footer.php");
?>
