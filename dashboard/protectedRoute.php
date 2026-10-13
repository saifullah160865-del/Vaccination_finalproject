<?php

include("config/db.php");

if(!isset($_SESSION['name'])) {
          echo "<script>
          location.assign('login.php');</script>";
    }

?>