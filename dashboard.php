<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <?php

    if ($_SESSION['role'] == 'parent') {
        echo "<p>Parent Dashboard</p>";
    }

    if ($_SESSION['role'] == 'hospital') {
        echo "<p>Hospital Dashboard</p>";
    }

    ?>

    <h2>Welcome to Dashboard</h2>

    <p>You are logged in successfully.</p>

</body>

</html>
