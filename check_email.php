<?php
include 'db.php';

$contact = $_POST['contact'] ?? "";

$contact = trim($contact);

if($contact == ""){
    echo "invalid";
    exit;
}

// 🔍 Check if email
if(filter_var($contact, FILTER_VALIDATE_EMAIL)){

    $query = mysqli_query($conn, "SELECT id FROM users WHERE email='$contact'");

}
// 🔍 Check if mobile
else{

    $query = mysqli_query($conn, "SELECT id FROM users WHERE mobile='$contact'");

}

// ✅ RESULT
if(mysqli_num_rows($query) > 0){
    echo "exists";
}else{
    echo "available";
}
?>