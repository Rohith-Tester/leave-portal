<?php
include 'db.php';

$email = isset($_POST['email']) ? trim($_POST['email']) : '';

$q = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");

if(mysqli_num_rows($q) > 0){
echo "exists";
}else{
echo "available";
}
?>