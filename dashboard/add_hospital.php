<?php
include("base/header.php");
$message = "";
$error = "";

if (isset($_POST['add_hospital'])) {
  extract($_POST);

  if ($hospital_name == "" || $email == "" || $password == "" || $location == "") {
    $error = "Please fill all required fields";
  } else {
    $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
      $error = "Email already registered for another user";
    } else {
      $user_query = "INSERT INTO users (name, email, password, role) VALUES ('$hospital_name', '$email', sha1('$password'), 'hospital')";
      if (mysqli_query($conn, $user_query)) {
        $user_id = mysqli_insert_id($conn);
        $hosp_query = "INSERT INTO hospitals (user_id, hospital_name, address, location, phone) VALUES ('$user_id', '$hospital_name', '$address', '$location', '$phone')";
        mysqli_query($conn, $hosp_query);
        echo "<script>location.assign('hospitals_list.php');</script>";
      } else {
        $error = "Error adding hospital account";
      }
    }
  }
}
?>

<div class="col-lg-8 mx-auto">
  <div class="card card-primary card-outline mb-4">
    <div class="card-header">
      <h3 class="card-title text-primary"><i class="bi bi-hospital me-2"></i> Add Hospital Account</h3>
    </div>

    <?php if ($error != "") { ?>
      <div class="alert alert-danger m-3"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
      <div class="card-body">
        <div class="mb-3">
          <label>Hospital Name</label>
          <input type="text" name="hospital_name" class="form-control" required placeholder="Enter hospital name">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Login Email</label>
            <input type="email" name="email" class="form-control" required placeholder="Enter login email">
          </div>
          <div class="col-md-6 mb-3">
            <label>Login Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Enter login password">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
          </div>
          <div class="col-md-6 mb-3">
            <label>City / Location</label>
            <input type="text" name="location" class="form-control" required placeholder="e.g. Lahore, Karachi, Islamabad">
          </div>
        </div>

        <div class="mb-3">
          <label>Full Address</label>
          <textarea name="address" class="form-control" rows="2" placeholder="Enter complete hospital address" required></textarea>
        </div>
      </div>

      <div class="card-footer">
        <button type="submit" name="add_hospital" class="btn btn-primary">Add Hospital</button>
        <a href="hospitals_list.php" class="btn btn-secondary">Back to List</a>
      </div>
    </form>
  </div>
</div>

<?php
include("base/footer.php");
?>
