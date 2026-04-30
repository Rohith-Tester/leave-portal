<?php
session_start();

if($_POST['otp'] == $_SESSION['otp']){
    $_SESSION['otp_verified'] = true;
    echo "Verified";
}else{
    echo "Invalid OTP";
}