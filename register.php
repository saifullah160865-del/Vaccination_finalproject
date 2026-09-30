<?php

include "config/db.php";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, role)
          VALUES ('$name', '$email', '$password', '$role')";

    mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Registration</h2>

    <form method="POST">

        <label>Name</label>

        <input type="text" name="name" required>
        <br><br>

        <label>Email</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Password</label>
        <input type="password" name="password" required>
        <br><br>

        <label>Role</label>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="parent">Parent</option>
            <option value="hospital">Hospital</option>
        </select>
        <br><br>

        <button type="submit" name="register">Register</button>

    </form>

</body>

</html>