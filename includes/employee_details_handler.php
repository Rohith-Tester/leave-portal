<?php

include 'db.php';

$employees = mysqli_query($conn,
"SELECT * FROM users");

$totalEmployees =
mysqli_num_rows($employees);

?>