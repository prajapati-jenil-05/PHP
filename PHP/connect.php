<?php
try {
    $con = mysqli_connect("localhost", "root", "", "my_database");
} catch (Exception $e) {
    die("Connection failed: " . $con->connect_error);
}
