<?php
include("base/header.php");

if (isset($_GET['action']) && isset($_GET['booking_id'])) {
  $b_id = $_GET['booking_id'];
  $action = $_GET['action'];
  if ($action == 'approve') {
    mysqli_query($conn, "UPDATE bookings SET status='Approved' WHERE id='$b_id'");
  } else if ($action == 'reject') {
    mysqli_query($conn, "UPDATE bookings SET status='Rejected' WHERE id='$b_id'");
  }
  echo "<script>location.assign('parent_requests.php');</script>";
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Parent Appointment & Booking Requests</h3>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Parent Name</th>
          <th>Child Name</th>
          <th>Hospital Name</th>
          <th>Vaccine</th>
          <th>Booking Date</th>
          <th>Current Status</th>
          <th style="width: 200px">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT bookings.*, users.name AS parent_name, children.child_name, hospitals.hospital_name, vaccines.vaccine_name 
                  FROM bookings 
                  JOIN users ON bookings.parent_id = users.id 
                  JOIN children ON bookings.child_id = children.id 
                  JOIN hospitals ON bookings.hospital_id = hospitals.id 
                  JOIN vaccination_dates ON bookings.vaccination_id = vaccination_dates.id 
                  JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                  ORDER BY bookings.id DESC";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        while ($display = mysqli_fetch_array($execute)) {
        ?>
          <tr class="align-middle">
            <td><?php echo $count++; ?></td>
            <td><strong><?php echo $display['parent_name']; ?></strong></td>
            <td><?php echo $display['child_name']; ?></td>
            <td><?php echo $display['hospital_name']; ?></td>
            <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
            <td><?php echo $display['booking_date']; ?></td>
            <td><span class="badge badge-soft-blue"><?php echo $display['status']; ?></span></td>
            <td class="text-nowrap">
              <?php if ($display['status'] == 'Pending') { ?>
                <a href="parent_requests.php?action=approve&booking_id=<?php echo $display['id']; ?>" class="btn btn-primary btn-sm">Approve</a>
                <a href="parent_requests.php?action=reject&booking_id=<?php echo $display['id']; ?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure you want to reject this request?')">Reject</a>
              <?php } else { ?>
                <span class="text-secondary"><?php echo $display['status']; ?></span>
              <?php } ?>
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
