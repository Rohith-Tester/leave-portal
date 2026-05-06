document.getElementById("forgetForm").addEventListener("submit",function(e){

let fields=[
["username","userError"],
["verify","verifyError"],
["newpass","passError"],
["confirmpass","cpassError"]
];

let valid=true;

fields.forEach(function(item){

let input=document.getElementById(item[0]);
let error=document.getElementById(item[1]);

input.classList.remove("input-error");
error.innerHTML="";

if(input.value.trim()==""){
input.classList.add("input-error");
error.innerHTML="Enter the details";
valid=false;
}

});

if(!valid){
e.preventDefault();
}

});

/* Email Verify OTP */



function sendForgetOTP(){

let btn=document.getElementById("verifyMailBtn");

if(btn.style.pointerEvents=="none"){
alert("Enter registered Email / Mobile");
return;
}

document.getElementById("forgetOtpArea").innerHTML=`
<div class="mini-otp-box">
<input type="text" id="forgetOtp" placeholder="Enter OTP" maxlength="6">
<button type="button" class="mini-btn" onclick="verifyForgetOTP()">Verify</button>
</div>
`;

alert("OTP Sent Successfully");

}

/* OTP Verify */

function verifyForgetOTP(){

let otp=document.getElementById("forgetOtp").value.trim();

if(otp==""){
alert("Enter OTP");
return;
}

if(otp=="123456"){

document.getElementById("verifyStatus").innerHTML="✔ Email Verified";
document.getElementById("verifyStatus").style.color="green";

alert("Email Verified Successfully");

}else{

alert("Wrong OTP");

}

}

/* Password Strength */

function checkForgetStrength(){

let pass = document.getElementById("newpass").value;
let box = document.getElementById("forgetStrength");

if(!box) return;

if(pass.trim()==""){
box.innerHTML="";
return;
}

let score = 0;

if(pass.length >= 8) score++;
if(/[A-Z]/.test(pass)) score++;
if(/[0-9]/.test(pass)) score++;
if(/[@$!%*#?&]/.test(pass)) score++;

if(score <= 1){
box.innerHTML = "Weak Password";
box.style.color = "red";
}
else if(score <= 3){
box.innerHTML = "Medium Password";
box.style.color = "orange";
}
else{
box.innerHTML = "Strong Password";
box.style.color = "green";
}

}

/* Password Match */

function checkForgetMatch(){

let p1 = document.getElementById("newpass").value;
let p2 = document.getElementById("confirmpass").value;
let box = document.getElementById("forgetMatch");

if(!box) return;

if(p2.trim()==""){
box.innerHTML="";
return;
}

if(p1 === p2){
box.innerHTML = "Password match";
box.style.color = "green";
}else{
box.innerHTML = "Password doesn't match";
box.style.color = "red";
}

}
