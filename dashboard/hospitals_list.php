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
    <table class="table table-bordered table-striped datatable">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Hospital Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Address</th>
          <?php if ($_SESSION['role'] == 'admin') { ?>
          <th style="width: 100px">Actions</th>
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
            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle"><i class="bi bi-geo-alt me-1"></i><?php echo $display['location']; ?></span></td>
            <td><?php echo $display['address']; ?></td>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <td class="text-nowrap">
              <a href="manage_hospitals.php?edit_id=<?php echo $display['id']; ?>" class="btn btn-outline-primary btn-sm me-1" title="Edit Hospital">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="javascript:void(0)" onclick="confirmDelete('hospitals_list.php?delete_id=<?php echo $display['id']; ?>', 'Delete this hospital and its account?');" class="btn btn-outline-danger btn-sm" title="Delete Hospital">
                <i class="bi bi-trash"></i>
              </a>
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
