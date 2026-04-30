function checkMobileForOTP(){

let mobile = document.getElementById("mobile").value.trim();
let error = document.getElementById("mobileError");
let btn = document.getElementById("mobileVerifyBtn");

mobile = mobile.replace(/\D/g,'');

document.getElementById("mobile").value = mobile;

if(mobile==""){
error.innerHTML="";
btn.classList.remove("active");
return;
}

if(mobile.length==10){
error.innerHTML="";
btn.classList.add("active");
}else{
error.innerHTML="Enter valid mobile number";
btn.classList.remove("active");
}

}

function sendMobileOTP(){

let btn = document.getElementById("mobileVerifyBtn");

if(!btn.classList.contains("active")){
return;
}

document.getElementById("mobileOtpArea").innerHTML = `
<div class="mini-otp-box">
<input type="text" id="enteredMobileOtp" placeholder="Enter OTP" maxlength="6">
<button type="button" class="mini-btn" onclick="verifyMobileOtp()">Verify</button>
</div>
`;

}

function verifyMobileOtp(){

let otp = document.getElementById("enteredMobileOtp").value.trim();

if(otp==""){
alert("Enter OTP");
return;
}

alert("Mobile OTP Verified (Demo)");

}