<?php

include 'db.php';

if(isset($_POST['contact'])){
    $contact = trim($_POST['contact']);
}else{
    $contact = "";
}

if($contact == ""){
    echo "invalid";
    exit;
}

/* CHECK EMAIL */
if(filter_var($contact, FILTER_VALIDATE_EMAIL)){

    $query = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE email='$contact'"
    );

}
/* CHECK MOBILE */
else{

    $query = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE mobile='$contact'"
    );

}

/* RESULT */
if(mysqli_num_rows($query) > 0){

    echo "exists";

}else{

    echo "not_found";

}

?>