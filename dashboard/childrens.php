<?php
include("base/header.php");
include("config/db.php");

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $select="DELETE FROM children WHERE id='$delete_id'";
  $execute = mysqli_query($conn,$select);
  echo "<script>location.assign('childrens.php');</script>";
}

if (isset($_POST['add_child'])) {
  extract($_POST);
  if ($_SESSION['role'] == 'admin') {
    $p_id = $parent_id;
  } else {
    $p_id = $_SESSION['user_id'];
  }

  if ($child_name == "" || $dob == "" || $gender == "") {
    $error = "Please fill all fields";
  } else {
    $sql = "INSERT INTO children (parent_id, child_name, date_of_birth, gender) VALUES ('$p_id', '$child_name', '$dob', '$gender')";
    mysqli_query($conn, $sql);
    echo "<script>location.assign('childrens.php');</script>";
  }
}

if (isset($_POST['update_child'])) {
  extract($_POST);
  if ($child_name != "" && $dob != "" && $gender != "") {
    $update_sql = "UPDATE children SET child_name='$child_name', date_of_birth='$dob', gender='$gender' WHERE id='$child_id'";
    mysqli_query($conn, $update_sql);
    echo "<script>location.assign('childrens.php');</script>";
  }
}

$edit_data = null;
if (isset($_GET['edit_id'])) {
  $edit_id = $_GET['edit_id'];
  $edit_res = mysqli_query($conn, "SELECT * FROM children WHERE id='$edit_id'");
  $edit_data = mysqli_fetch_array($edit_res);
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Children</h3>
  </div>

  <?php if ($edit_data) { ?>
  <div class="card mb-4 m-3">
    <div class="card-header bg-warning text-dark">
      <h3 class="card-title">Edit Child</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <input type="hidden" name="child_id" value="<?php echo $edit_data['id']; ?>">
        <div class="mb-3">
          <label>Child Name</label>
          <input type="text" name="child_name" class="form-control" value="<?php echo $edit_data['child_name']; ?>" required>
        </div>
        <div class="mb-3">
          <label>Date of Birth</label>
          <input type="date" name="dob" class="form-control" value="<?php echo $edit_data['date_of_birth']; ?>" required>
        </div>
        <div class="mb-3">
          <label>Gender</label>
          <select name="gender" class="form-control" required>
            <option value="Male" <?php if ($edit_data['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($edit_data['gender'] == 'Female') echo 'selected'; ?>>Female</option>
          </select>
        </div>
        <button type="submit" name="update_child" class="btn btn-warning">Update Child</button>
        <a href="childrens.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
  <?php } else { ?>
  <div class="card mb-4 m-3">
    <div class="card-header">
      <h3 class="card-title">Add Child</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <?php if ($_SESSION['role'] == 'admin') { ?>
        <div class="mb-3">
          <label>Select Parent</label>
          <select name="parent_id" class="form-control" required>
            <option value="">Select Parent</option>
            <?php
            $parents_q = mysqli_query($conn, "SELECT id, name, email FROM users WHERE role='parent'");
            while ($p_row = mysqli_fetch_array($parents_q)) {
              echo "<option value='".$p_row['id']."'>".$p_row['name']." (".$p_row['email'].")</option>";
            }
            ?>
          </select>
        </div>
        <?php } ?>
        <div class="mb-3">
          <label>Child Name</label>
          <input type="text" name="child_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Date of Birth</label>
          <input type="date" name="dob" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Gender</label>
          <select name="gender" class="form-control" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <button type="submit" name="add_child" class="btn btn-primary">Add Child</button>
      </form>
    </div>
  </div>
  <?php } ?>

  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Parent Name</th>
          <th>Child Name</th>
          <th>DOB</th>
          <th>Gender</th>
          <th style="width: 150px">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($_SESSION['role'] == 'parent') {
          $uid = $_SESSION['user_id'];
          $query = "SELECT children.*, users.name AS parent_name FROM children LEFT JOIN users ON children.parent_id = users.id WHERE children.parent_id='$uid'";
        } else {
          $query = "SELECT children.*, users.name AS parent_name FROM children LEFT JOIN users ON children.parent_id = users.id";
        }
        $execute = mysqli_query($conn, $query);
        $count = 1;
        while ($display = mysqli_fetch_array($execute)) {
        ?>
          <tr class="align-middle">
            <td><?php echo $count++; ?></td>
            <td><?php echo $display['parent_name']; ?></td>
            <td><?php echo $display['child_name']; ?></td>
            <td><?php echo $display['date_of_birth']; ?></td>
            <td><?php echo $display['gender']; ?></td>
            <td class="text-nowrap">
              <a href="childrens.php?edit_id=<?php echo $display['id']; ?>" class="btn btn-danger btn-sm btn-outline-light">Edit</a>
              <a href="childrens.php?delete_id=<?php echo $display['id']; ?>" class="btn btn-primary btn-sm btn-outline-light" onclick="return confirm('Are you sure?')">Delete</a>
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