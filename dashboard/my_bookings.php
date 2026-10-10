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
    <table class="table table-bordered table-striped">
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
          ?>
            <tr class="align-middle">
              <td><?php echo $count++; ?></td>
              <td><strong><?php echo $display['child_name']; ?></strong></td>
              <td><?php echo $display['hospital_name']; ?></td>
              <td><span class="badge badge-soft-blue"><?php echo $display['location']; ?></span></td>
              <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
              <td><?php echo $display['booking_date']; ?></td>
              <td><span class="badge badge-soft-blue"><?php echo $display['status']; ?></span></td>
              <td>
                <?php if ($display['status'] == 'Pending') { ?>
                  <a href="my_bookings.php?cancel_id=<?php echo $display['id']; ?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Cancel this booking request?')">Cancel</a>
                <?php } else { ?>
                  <span class="text-muted"><?php echo $display['status']; ?></span>
                <?php } ?>
              </td>
            </tr>
          <?php
          }
        } else {
          echo "<tr><td colspan='8' class='text-center text-muted'>No booking requests found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include("base/footer.php");
?>
