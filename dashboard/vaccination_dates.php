<?php
include("base/header.php");

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  mysqli_query($conn, "DELETE FROM vaccination_dates WHERE id='$delete_id'");
  echo "<script>location.assign('vaccination_dates.php');</script>";
}

if (isset($_GET['toggle_id']) && isset($_GET['new_status'])) {
  $toggle_id = $_GET['toggle_id'];
  $new_status = $_GET['new_status'];
  mysqli_query($conn, "UPDATE vaccination_dates SET status='$new_status' WHERE id='$toggle_id'");
  echo "<script>location.assign('vaccination_dates.php');</script>";
}

if (isset($_POST['schedule_date'])) {
  extract($_POST);
  if ($child_id != "" && $vaccine_id != "" && $vaccination_date != "") {
    $insert_query = "INSERT INTO vaccination_dates (child_id, vaccine_id, vaccination_date, status) VALUES ('$child_id', '$vaccine_id', '$vaccination_date', 'Pending')";
    mysqli_query($conn, $insert_query);
    echo "<script>location.assign('vaccination_dates.php');</script>";
  }
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Vaccination Schedule & Dates</h3>
  </div>

  <?php if ($_SESSION['role'] == 'admin') { ?>
  <div class="card mb-4 m-3">
    <div class="card-header">
      <h3 class="card-title">Schedule Vaccination Date for Child</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label>Select Child</label>
            <select name="child_id" class="form-control" required>
              <option value="">Select Child</option>
              <?php
              $c_query = mysqli_query($conn, "SELECT children.*, users.name AS parent_name FROM children LEFT JOIN users ON children.parent_id = users.id");
              while ($crow = mysqli_fetch_array($c_query)) {
                echo "<option value='".$crow['id']."'>".$crow['child_name']." (Parent: ".$crow['parent_name'].")</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-md-4 mb-3">
            <label>Select Vaccine</label>
            <select name="vaccine_id" class="form-control" required>
              <option value="">Select Vaccine</option>
              <?php
              $v_query = mysqli_query($conn, "SELECT * FROM vaccines WHERE status='Available'");
              while ($vrow = mysqli_fetch_array($v_query)) {
                echo "<option value='".$vrow['id']."'>".$vrow['vaccine_name']."</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-md-4 mb-3">
            <label>Vaccination Date</label>
            <input type="date" name="vaccination_date" class="form-control" required>
          </div>
        </div>

        <button type="submit" name="schedule_date" class="btn btn-primary">Add Schedule</button>
      </form>
    </div>
  </div>
  <?php } ?>

  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Child Name</th>
          <th>Parent Name</th>
          <th>Vaccine Name</th>
          <th>Scheduled Date</th>
          <th>Status</th>
          <?php if ($_SESSION['role'] == 'admin') { ?>
          <th style="width: 220px">Actions</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($_SESSION['role'] == 'parent') {
          $uid = $_SESSION['user_id'];
          $query = "SELECT vaccination_dates.*, children.child_name, users.name AS parent_name, vaccines.vaccine_name 
                    FROM vaccination_dates 
                    JOIN children ON vaccination_dates.child_id = children.id 
                    JOIN users ON children.parent_id = users.id 
                    JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                    WHERE children.parent_id='$uid' 
                    ORDER BY vaccination_dates.vaccination_date ASC";
        } else {
          $query = "SELECT vaccination_dates.*, children.child_name, users.name AS parent_name, vaccines.vaccine_name 
                    FROM vaccination_dates 
                    JOIN children ON vaccination_dates.child_id = children.id 
                    JOIN users ON children.parent_id = users.id 
                    JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                    ORDER BY vaccination_dates.vaccination_date ASC";
        }
        $execute = mysqli_query($conn, $query);
        $count = 1;
        while ($display = mysqli_fetch_array($execute)) {
          $status_class = ($display['status'] == 'Completed') ? 'bg-success' : 'bg-warning text-dark';
        ?>
          <tr class="align-middle">
            <td><?php echo $count++; ?></td>
            <td><strong><?php echo $display['child_name']; ?></strong></td>
            <td><?php echo $display['parent_name']; ?></td>
            <td><?php echo $display['vaccine_name']; ?></td>
            <td><?php echo $display['vaccination_date']; ?></td>
            <td><span class="badge <?php echo $status_class; ?>"><?php echo $display['status']; ?></span></td>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <td class="text-nowrap">
              <?php if ($display['status'] == 'Pending') { ?>
                <a href="vaccination_dates.php?toggle_id=<?php echo $display['id']; ?>&new_status=Completed" class="btn btn-success btn-sm">Mark Completed</a>
              <?php } else { ?>
                <a href="vaccination_dates.php?toggle_id=<?php echo $display['id']; ?>&new_status=Pending" class="btn btn-warning btn-sm">Mark Pending</a>
              <?php } ?>
              <a href="vaccination_dates.php?delete_id=<?php echo $display['id']; ?>" class="btn btn-primary btn-sm btn-outline-light" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
            <?php } ?>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include("base/footer.php");
?>
