<?php
include("base/header.php");

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  mysqli_query($conn, "DELETE FROM vaccines WHERE id='$delete_id'");
  echo "<script>location.assign('vaccines_list.php');</script>";
}

if (isset($_GET['toggle_id']) && isset($_GET['new_status'])) {
  $toggle_id = $_GET['toggle_id'];
  $new_status = $_GET['new_status'];
  mysqli_query($conn, "UPDATE vaccines SET status='$new_status' WHERE id='$toggle_id'");
  echo "<script>location.assign('vaccines_list.php');</script>";
}

if (isset($_POST['add_vaccine'])) {
  extract($_POST);
  if ($vaccine_name != "") {
    $insert_sql = "INSERT INTO vaccines (vaccine_name, description, status) VALUES ('$vaccine_name', '$description', '$status')";
    mysqli_query($conn, $insert_sql);
    echo "<script>location.assign('vaccines_list.php');</script>";
  }
}

if (isset($_POST['update_vaccine'])) {
  extract($_POST);
  if ($vaccine_name != "") {
    $update_sql = "UPDATE vaccines SET vaccine_name='$vaccine_name', description='$description', status='$status' WHERE id='$vaccine_id'";
    mysqli_query($conn, $update_sql);
    echo "<script>location.assign('vaccines_list.php');</script>";
  }
}

$edit_data = null;
if (isset($_GET['edit_id'])) {
  $edit_id = $_GET['edit_id'];
  $res = mysqli_query($conn, "SELECT * FROM vaccines WHERE id='$edit_id'");
  $edit_data = mysqli_fetch_array($res);
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Vaccines Management</h3>
  </div>

  <?php if ($edit_data) { ?>
  <div class="card mb-4 m-3">
    <div class="card-header">
      <h3 class="card-title text-primary"><i class="bi bi-pencil-square me-2"></i> Edit Vaccine</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <input type="hidden" name="vaccine_id" value="<?php echo $edit_data['id']; ?>">
        <div class="mb-3">
          <label>Vaccine Name</label>
          <input type="text" name="vaccine_name" class="form-control" value="<?php echo $edit_data['vaccine_name']; ?>" required>
        </div>
        <div class="mb-3">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="3"><?php echo $edit_data['description']; ?></textarea>
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control" required>
            <option value="Available" <?php if ($edit_data['status'] == 'Available') echo 'selected'; ?>>Available</option>
            <option value="Unavailable" <?php if ($edit_data['status'] == 'Unavailable') echo 'selected'; ?>>Unavailable</option>
          </select>
        </div>
        <button type="submit" name="update_vaccine" class="btn btn-primary">Update Vaccine</button>
        <a href="vaccines_list.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
  <?php } else if ($_SESSION['role'] == 'admin') { ?>
  <div class="card mb-4 m-3">
    <div class="card-header">
      <h3 class="card-title text-primary"><i class="bi bi-plus-circle me-2"></i> Add New Vaccine</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label>Vaccine Name</label>
          <input type="text" name="vaccine_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Description</label>
          <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control" required>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
          </select>
        </div>
        <button type="submit" name="add_vaccine" class="btn btn-primary">Add Vaccine</button>
      </form>
    </div>
  </div>
  <?php } ?>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Vaccine Name</th>
          <th>Description</th>
          <th>Status</th>
          <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'hospital') { ?>
          <th style="width: 220px">Actions</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM vaccines";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        while ($display = mysqli_fetch_array($execute)) {
          $status_badge = ($display['status'] == 'Available') ? 'badge-soft-blue' : 'badge-soft-secondary';
        ?>
          <tr class="align-middle">
            <td><?php echo $count++; ?></td>
            <td><strong><?php echo $display['vaccine_name']; ?></strong></td>
            <td><?php echo $display['description']; ?></td>
            <td>
              <span class="badge <?php echo $status_badge; ?>">
                <?php echo $display['status']; ?>
              </span>
            </td>
            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'hospital') { ?>
            <td class="text-nowrap">
              <?php if ($display['status'] == 'Available') { ?>
                <a href="vaccines_list.php?toggle_id=<?php echo $display['id']; ?>&new_status=Unavailable" class="btn btn-outline-secondary btn-sm">Mark Unavailable</a>
              <?php } else { ?>
                <a href="vaccines_list.php?toggle_id=<?php echo $display['id']; ?>&new_status=Available" class="btn btn-outline-primary btn-sm">Mark Available</a>
              <?php } ?>
              <?php if ($_SESSION['role'] == 'admin') { ?>
                <a href="vaccines_list.php?edit_id=<?php echo $display['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                <a href="vaccines_list.php?delete_id=<?php echo $display['id']; ?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
              <?php } ?>
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
