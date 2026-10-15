<?php
include("base/header.php");

$parent_id = $_SESSION['user_id'];

if (isset($_GET['cancel_id'])) {
  $cancel_id = $_GET['cancel_id'];
  mysqli_query($conn, "DELETE FROM bookings WHERE id='$cancel_id' AND parent_id='$parent_id' AND status='Pending'");
  echo "<script>location.assign('my_bookings.php');</script>";
}
?>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">My Hospital Bookings & Request Status</h3>
    <a href="book_hospital.php" class="btn btn-primary btn-sm ms-auto">New Booking Request</a>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped datatable">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Child Name</th>
          <th>Hospital Name</th>
          <th>Location</th>
          <th>Vaccine</th>
          <th>Booking Date</th>
          <th>Status</th>
          <th style="width: 120px">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT bookings.*, children.child_name, hospitals.hospital_name, hospitals.location, vaccines.vaccine_name 
                  FROM bookings 
                  JOIN children ON bookings.child_id = children.id 
                  JOIN hospitals ON bookings.hospital_id = hospitals.id 
                  JOIN vaccination_dates ON bookings.vaccination_id = vaccination_dates.id 
                  JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                  WHERE bookings.parent_id='$parent_id' 
                  ORDER BY bookings.id DESC";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        if (mysqli_num_rows($execute) > 0) {
          while ($display = mysqli_fetch_array($execute)) {
            if ($display['status'] == 'Approved') {
              $b_badge = 'bg-primary';
            } else if ($display['status'] == 'Completed') {
              $b_badge = 'bg-success';
            } else if ($display['status'] == 'Rejected') {
              $b_badge = 'bg-danger';
            } else {
              $b_badge = 'bg-warning text-dark';
            }
          ?>
            <tr class="align-middle">
              <td><?php echo $count++; ?></td>
              <td><strong><?php echo $display['child_name']; ?></strong></td>
              <td><?php echo $display['hospital_name']; ?></td>
              <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle"><i class="bi bi-geo-alt me-1"></i><?php echo $display['location']; ?></span></td>
              <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
              <td><?php echo $display['booking_date']; ?></td>
              <td><span class="badge <?php echo $b_badge; ?>"><?php echo $display['status']; ?></span></td>
              <td>
                <?php if ($display['status'] == 'Pending') { ?>
                  <a href="javascript:void(0)" onclick="confirmDelete('my_bookings.php?cancel_id=<?php echo $display['id']; ?>', 'Cancel this booking request?');" class="btn btn-outline-danger btn-sm" title="Cancel Booking">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                  </a>
                <?php } else { ?>
                  <span class="text-muted small"><?php echo $display['status']; ?></span>
                <?php } ?>
              </td>
            </tr>
          <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include("base/footer.php");
?>
