<?php
include 'db.php';

if(isset($_POST['username'])){

$username = trim($_POST['username']);

$q = mysqli_query($conn,"SELECT id FROM users WHERE username='$username'");

if(mysqli_num_rows($q) > 0){
echo "exists";
}else{
echo "available";
}

}
?>