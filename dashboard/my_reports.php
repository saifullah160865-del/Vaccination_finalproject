<?php
include("base/header.php");

$parent_id = $_SESSION['user_id'];
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">My Children Vaccination Reports (History)</h3>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped datatable">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Child Name</th>
          <th>Vaccine Name</th>
          <th>Administering Hospital</th>
          <th>Date Vaccinated</th>
          <th>Status</th>
          <th>Remarks / Notes</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT vaccination_reports.*, children.child_name, vaccines.vaccine_name, hospitals.hospital_name 
                  FROM vaccination_reports 
                  JOIN children ON vaccination_reports.child_id = children.id 
                  JOIN vaccines ON vaccination_reports.vaccine_id = vaccines.id 
                  JOIN hospitals ON vaccination_reports.hospital_id = hospitals.id 
                  WHERE children.parent_id='$parent_id' 
                  ORDER BY vaccination_reports.vaccination_date DESC";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        if (mysqli_num_rows($execute) > 0) {
          while ($display = mysqli_fetch_array($execute)) {
            $status_badge = ($display['status'] == 'Vaccinated') ? 'bg-success' : 'bg-danger';
          ?>
            <tr class="align-middle">
              <td><?php echo $count++; ?></td>
              <td><strong><?php echo $display['child_name']; ?></strong></td>
              <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
              <td><?php echo $display['hospital_name']; ?></td>
              <td><?php echo $display['vaccination_date']; ?></td>
              <td><span class="badge <?php echo $status_badge; ?>"><i class="bi bi-shield-check me-1"></i><?php echo $display['status']; ?></span></td>
              <td><?php echo $display['remarks']; ?></td>
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
