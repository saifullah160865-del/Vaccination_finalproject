<?php
include("base/header.php");

$where_clause = "";
$from_date = "";
$to_date = "";

if (isset($_GET['filter_date'])) {
  $from_date = $_GET['from_date'];
  $to_date = $_GET['to_date'];
  if ($from_date != "" && $to_date != "") {
    $where_clause = " WHERE vaccination_reports.vaccination_date BETWEEN '$from_date' AND '$to_date'";
  } else if ($from_date != "") {
    $where_clause = " WHERE vaccination_reports.vaccination_date >= '$from_date'";
  } else if ($to_date != "") {
    $where_clause = " WHERE vaccination_reports.vaccination_date <= '$to_date'";
  }
}
?>

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Vaccination Reports (Date Wise)</h3>
  </div>

  <div class="card-body">
    <form method="GET" class="row g-3 mb-4">
      <div class="col-md-4">
        <label>From Date</label>
        <input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>">
      </div>
      <div class="col-md-4">
        <label>To Date</label>
        <input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>">
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button type="submit" name="filter_date" class="btn btn-primary me-2">Filter Report</button>
        <a href="vaccination_reports.php" class="btn btn-secondary">Reset</a>
      </div>
    </form>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Child Name</th>
          <th>Parent Name</th>
          <th>Vaccine Name</th>
          <th>Hospital Name</th>
          <th>Vaccination Date</th>
          <th>Status</th>
          <th>Remarks</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT vaccination_reports.*, children.child_name, users.name AS parent_name, vaccines.vaccine_name, hospitals.hospital_name 
                  FROM vaccination_reports 
                  JOIN children ON vaccination_reports.child_id = children.id 
                  JOIN users ON children.parent_id = users.id 
                  JOIN vaccines ON vaccination_reports.vaccine_id = vaccines.id 
                  JOIN hospitals ON vaccination_reports.hospital_id = hospitals.id 
                  $where_clause 
                  ORDER BY vaccination_reports.vaccination_date DESC";
        $execute = mysqli_query($conn, $query);
        $count = 1;
        if (mysqli_num_rows($execute) > 0) {
          while ($display = mysqli_fetch_array($execute)) {
          ?>
            <tr class="align-middle">
              <td><?php echo $count++; ?></td>
              <td><strong><?php echo $display['child_name']; ?></strong></td>
              <td><?php echo $display['parent_name']; ?></td>
              <td><span class="highlight"><?php echo $display['vaccine_name']; ?></span></td>
              <td><?php echo $display['hospital_name']; ?></td>
              <td><?php echo $display['vaccination_date']; ?></td>
              <td><span class="badge badge-soft-blue"><?php echo $display['status']; ?></span></td>
              <td><?php echo $display['remarks']; ?></td>
            </tr>
          <?php
          }
        } else {
          echo "<tr><td colspan='8' class='text-center text-muted'>No vaccination reports found for the selected date range.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include("base/footer.php");
?>
