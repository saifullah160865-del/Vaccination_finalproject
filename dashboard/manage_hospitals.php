<?php
include("base/header.php");

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $hosp_q = mysqli_query($conn, "SELECT user_id FROM hospitals WHERE id='$delete_id'");
  if ($h_row = mysqli_fetch_array($hosp_q)) {
    $uid = $h_row['user_id'];
    mysqli_query($conn, "DELETE FROM hospitals WHERE id='$delete_id'");
    mysqli_query($conn, "DELETE FROM users WHERE id='$uid'");
  } else {
    mysqli_query($conn, "DELETE FROM hospitals WHERE id='$delete_id'");
  }
  echo "<script>location.assign('manage_hospitals.php');</script>";
}

if (isset($_POST['update_hospital'])) {
  extract($_POST);
  mysqli_query($conn, "UPDATE hospitals SET hospital_name='$hospital_name', address='$address', location='$location', phone='$phone' WHERE id='$hospital_id'");
  if (isset($user_id) && $user_id != "") {
    mysqli_query($conn, "UPDATE users SET name='$hospital_name', email='$email' WHERE id='$user_id'");
  }
  echo "<script>location.assign('manage_hospitals.php');</script>";
}

$edit_data = null;
if (isset($_GET['edit_id'])) {
  $edit_id = $_GET['edit_id'];
  $q = mysqli_query($conn, "SELECT hospitals.*, users.email FROM hospitals LEFT JOIN users ON hospitals.user_id = users.id WHERE hospitals.id='$edit_id'");
  $edit_data = mysqli_fetch_array($q);
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Manage Hospitals (Update / Delete)</h3>
  </div>

  <?php if ($edit_data) { ?>
  <div class="card mb-4 m-3">
    <div class="card-header">
      <h3 class="card-title text-primary"><i class="bi bi-pencil-square me-2"></i> Update Hospital Details</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <input type="hidden" name="hospital_id" value="<?php echo $edit_data['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $edit_data['user_id']; ?>">
        <div class="mb-3">
          <label>Hospital Name</label>
          <input type="text" name="hospital_name" class="form-control" value="<?php echo $edit_data['hospital_name']; ?>" required>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $edit_data['email']; ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $edit_data['phone']; ?>">
          </div>
        </div>
        <div class="mb-3">
          <label>Location</label>
          <input type="text" name="location" class="form-control" value="<?php echo $edit_data['location']; ?>" required>
        </div>
        <div class="mb-3">
          <label>Address</label>
          <textarea name="address" class="form-control" rows="2" required><?php echo $edit_data['address']; ?></textarea>
        </div>
        <button type="submit" name="update_hospital" class="btn btn-primary">Save Changes</button>
        <a href="manage_hospitals.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
  <?php } ?>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Hospital Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Address</th>
          <th style="width: 150px">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT hospitals.*, users.email FROM hospitals LEFT JOIN users ON hospitals.user_id = users.id";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        while ($display = mysqli_fetch_array($execute)) {
        ?>
          <tr class="align-middle">
            <td><?php echo $count++; ?></td>
            <td><strong><?php echo $display['hospital_name']; ?></strong></td>
            <td><?php echo $display['email']; ?></td>
            <td><?php echo $display['phone']; ?></td>
            <td><span class="badge badge-soft-blue"><?php echo $display['location']; ?></span></td>
            <td><?php echo $display['address']; ?></td>
            <td class="text-nowrap">
              <a href="manage_hospitals.php?edit_id=<?php echo $display['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
              <a href="manage_hospitals.php?delete_id=<?php echo $display['id']; ?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
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
