<?php
include("base/header.php");

$uid = $_SESSION['user_id'];
?>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">My Children Vaccination Dates</h3>
    <a href="book_hospital.php" class="btn btn-primary btn-sm ms-auto">Book Hospital</a>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Child Name</th>
          <th>Vaccine Name</th>
          <th>Scheduled Date</th>
          <th>Status</th>
          <th style="width: 150px">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT vaccination_dates.*, children.child_name, vaccines.vaccine_name 
                  FROM vaccination_dates 
                  JOIN children ON vaccination_dates.child_id = children.id 
                  JOIN vaccines ON vaccination_dates.vaccine_id = vaccines.id 
                  WHERE children.parent_id='$uid' 
                  ORDER BY vaccination_dates.vaccination_date ASC";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        if (mysqli_num_rows($execute) > 0) {
          while ($display = mysqli_fetch_array($execute)) {
          ?>
            <tr class="align-middle">
              <td><?php echo $count++; ?></td>
              <td><strong><?php echo $display['child_name']; ?></strong></td>
              <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
              <td><?php echo $display['vaccination_date']; ?></td>
              <td><span class="badge badge-soft-blue"><?php echo $display['status']; ?></span></td>
              <td>
                <?php if ($display['status'] == 'Pending') { ?>
                  <a href="book_hospital.php?child_id=<?php echo $display['child_id']; ?>&vaccination_id=<?php echo $display['id']; ?>" class="btn btn-primary btn-sm">Book Hospital</a>
                <?php } else { ?>
                  <span class="text-primary fw-semibold"><i class="bi bi-check-circle-fill"></i> Completed</span>
                <?php } ?>
              </td>
            </tr>
          <?php
          }
        } else {
          echo "<tr><td colspan='6' class='text-center text-muted'>No vaccination schedules found for your children.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include("base/footer.php");
?>
