<?php
include("config/db.php");
include("header/db.php");

$parent_id = $_SESSION['user_id'];

if (isset($_POST['add_child'])) {

  $child_name = $_POST['child_name'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];

  if ($child_name == "" || $dob == "" || $gender == "") {
    $error = "Please fill all fields";
  } else {
    $sql = "INSERT INTO children (parent_id, child_name, date_of_birth, gender) VALUES ('$parent_id', '$child_name', '$dob', '$gender')";
    if (mysqli_query($conn, $sql)) {
      $message = "Child added successfully";
    } else {
      $error = "Something went wrong, child not added";
    }
  }
}

?>



<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Childrens</h3>
  </div>


  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">Add Child</h3>
    </div>

    <div class="card-body">

      <form method="POST">

        <!-- <div class="mb-3">
          <label>Parent</label>
          <input type="text" name="parent_id" class="form-control">
        </div> -->

        <div class="mb-3">
          <label>Child Name</label>
          <input type="text" name="child_name" class="form-control">
        </div>

        <div class="mb-3">
          <label>Date of Birth</label>
          <input type="date" name="dob" class="form-control">
        </div>

        <div class="mb-3">
          <label>Gender</label>
          <select name="gender" class="form-control">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <button type="submit" name="add_child" class="btn btn-primary">
          Add Child
        </button>

      </form>

    </div>
  </div>

  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Parent</th>
          <th>Child Name</th>
          <th>DOB</th>
          <th>Gender</th>
          <th style="width: 40px">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="align-middle">
          <td>1.</td>
          <td>Update software</td>
          <td>
            abc
          </td>
          <td>55%</td>
          <td>123</td>
          <td class="text-nowrap" >
            <button class="btn btn-danger btn-sm btn-outline-light">Edit</button>
            <button class="btn btn-primary btn-sm btn-outline-light">Delete</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-end">
      <li class="page-item">
        <a class="page-link" href="#">&laquo;</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">1</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">3</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">&raquo;</a>
      </li>
    </ul>
  </div>
</div>
<!-- /.card -->

<?php
include("base/footer.php");
?>