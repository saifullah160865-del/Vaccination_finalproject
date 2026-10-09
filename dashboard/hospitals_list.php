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
  echo "<script>location.assign('hospitals_list.php');</script>";
}
?>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">List of Hospitals</h3>
    <?php if ($_SESSION['role'] == 'admin') { ?>
    <a href="add_hospital.php" class="btn btn-primary btn-sm ms-auto">Add New Hospital</a>
    <?php } ?>
  </div>

  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Hospital Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Address</th>
          <?php if ($_SESSION['role'] == 'admin') { ?>
          <th style="width: 150px">Actions</th>
          <?php } ?>
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
            <td><?php echo $display['location']; ?></td>
            <td><?php echo $display['address']; ?></td>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <td class="text-nowrap">
              <a href="manage_hospitals.php?edit_id=<?php echo $display['id']; ?>" class="btn btn-danger btn-sm btn-outline-light">Edit</a>
              <a href="hospitals_list.php?delete_id=<?php echo $display['id']; ?>" class="btn btn-primary btn-sm btn-outline-light" onclick="return confirm('Are you sure you want to delete this hospital?')">Delete</a>
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
