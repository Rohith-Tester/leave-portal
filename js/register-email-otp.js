let emailVerified = false;

function checkEmailForOTP(){

let email = document.getElementById("email").value.trim();
let error = document.getElementById("emailError");
let status = document.getElementById("emailStatus");
let btn = document.getElementById("verifyBtn");

let gmailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

emailVerified = false;
checkRegisterReady();

document.getElementById("otpArea").innerHTML = "";

if(email==""){
error.innerHTML="";
status.innerHTML="";
btn.classList.remove("active");
return;
}

if(!gmailPattern.test(email)){
error.innerHTML="Wrong email";
status.innerHTML="";
btn.classList.remove("active");
return;
}

error.innerHTML="";

fetch("check_email.php",{
method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},
body:"email="+encodeURIComponent(email)
})
.then(res=>res.text())
.then(data=>{

if(data.trim()=="exists"){
status.innerHTML="Email already exists";
status.style.color="red";
btn.classList.remove("active");
}else{
status.innerHTML="Email available";
status.style.color="green";
btn.classList.add("active");
btn.onclick = sendOTP;
}

});

}

function sendOTP(){

document.getElementById("otpArea").innerHTML = `
<div class="mini-otp-box">
<input type="text" id="enteredOtp" placeholder="Enter OTP" maxlength="6">
<button type="button" class="mini-btn" onclick="verifyOtp()">Verify</button>
</div>
`;

}

function verifyOtp(){

let otp = document.getElementById("enteredOtp").value.trim();

if(otp=="123456"){

emailVerified = true;

document.getElementById("emailStatus").innerHTML="✔ Email Verified";
document.getElementById("emailStatus").style.color="green";

checkRegisterReady();

}else{
alert("Wrong OTP");
}

}

function checkRegisterReady(){

let btn = document.getElementById("registerBtn");

if(emailVerified){
btn.disabled = false;
btn.style.opacity = "1";
btn.style.cursor = "pointer";
}else{
btn.disabled = true;
btn.style.opacity = "0.6";
btn.style.cursor = "not-allowed";
}

}