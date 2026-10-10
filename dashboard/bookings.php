<?php
include("base/header.php");
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Booking Details</h3>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Parent Name</th>
          <th>Child Name</th>
          <th>Hospital</th>
          <th>Vaccine</th>
          <th>Booking Date</th>
          <th>Status</th>
          <th>Submitted On</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT bookings.*, users.name AS parent_name, users.email AS parent_email, children.child_name, hospitals.hospital_name, vaccines.vaccine_name 
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
            <td><?php echo $display['parent_name']; ?><br><small class="text-muted"><?php echo $display['parent_email']; ?></small></td>
            <td><strong><?php echo $display['child_name']; ?></strong></td>
            <td><?php echo $display['hospital_name']; ?></td>
            <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
            <td><?php echo $display['booking_date']; ?></td>
            <td><span class="badge badge-soft-blue"><?php echo $display['status']; ?></span></td>
            <td><?php echo $display['created_at']; ?></td>
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
