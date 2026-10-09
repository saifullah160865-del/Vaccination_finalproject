<?php
include("base/header.php");

$uid = $_SESSION['user_id'];
$role = $_SESSION['role'];
$msg = "";
$err = "";

if (isset($_POST['update_profile'])) {
  extract($_POST);

  if ($name != "" && $email != "") {
    if ($password != "") {
      $up_sql = "UPDATE users SET name='$name', email='$email', password=sha1('$password') WHERE id='$uid'";
    } else {
      $up_sql = "UPDATE users SET name='$name', email='$email' WHERE id='$uid'";
    }

    if (mysqli_query($conn, $up_sql)) {
      $_SESSION['name'] = $name;

      if ($role == 'hospital') {
        mysqli_query($conn, "UPDATE hospitals SET hospital_name='$name', address='$address', location='$location', phone='$phone' WHERE user_id='$uid'");
      }

      $msg = "Profile updated successfully!";
    } else {
      $err = "Failed to update profile.";
    }
  } else {
    $err = "Name and email cannot be empty.";
  }
}

$user_q = mysqli_query($conn, "SELECT * FROM users WHERE id='$uid'");
$user_data = mysqli_fetch_array($user_q);

$hosp_data = null;
if ($role == 'hospital') {
  $h_q = mysqli_query($conn, "SELECT * FROM hospitals WHERE user_id='$uid'");
  $hosp_data = mysqli_fetch_array($h_q);
}
?>

<div class="row">
  <div class="col-lg-8 mx-auto">
    <div class="card card-primary card-outline mb-4">
      <div class="card-header">
        <h3 class="card-title">My Profile</h3>
      </div>

      <?php if ($msg != "") { ?>
        <div class="alert alert-success m-3"><?php echo $msg; ?></div>
      <?php } ?>
      <?php if ($err != "") { ?>
        <div class="alert alert-danger m-3"><?php echo $err; ?></div>
      <?php } ?>

      <form method="POST">
        <div class="card-body">
          <div class="mb-3">
            <label>Role</label>
            <input type="text" class="form-control" value="<?php echo ucfirst($user_data['role']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label><?php echo ($role == 'hospital') ? 'Hospital Name' : 'Full Name'; ?></label>
            <input type="text" name="name" class="form-control" value="<?php echo $user_data['name']; ?>" required>
          </div>

          <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="<?php echo $user_data['email']; ?>" required>
          </div>

          <div class="mb-3">
            <label>New Password (leave blank to keep current password)</label>
            <input type="password" name="password" class="form-control" placeholder="Enter new password">
          </div>

          <?php if ($role == 'hospital') { ?>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Phone Number</label>
              <input type="text" name="phone" class="form-control" value="<?php echo isset($hosp_data['phone']) ? $hosp_data['phone'] : ''; ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label>City / Location</label>
              <input type="text" name="location" class="form-control" value="<?php echo isset($hosp_data['location']) ? $hosp_data['location'] : ''; ?>">
            </div>
          </div>
          <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="2"><?php echo isset($hosp_data['address']) ? $hosp_data['address'] : ''; ?></textarea>
          </div>
          <?php } ?>
        </div>

        <div class="card-footer">
          <button type="submit" name="update_profile" class="btn btn-primary">Save Profile Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include("base/footer.php");
?>
