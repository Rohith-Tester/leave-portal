let contactVerified = false;

function checkContactForOTP(){

let value = document.getElementById("contact").value.trim();
let error = document.getElementById("emailError");
let status = document.getElementById("emailStatus");
let btn = document.getElementById("verifyBtn");

let emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
let mobilePattern = /^[0-9]{10}$/;

contactVerified = false;
checkRegisterReady();

document.getElementById("otpArea").innerHTML = "";

if(value==""){
error.innerHTML="";
status.innerHTML="";
btn.classList.remove("active");
return;
}

// ❌ invalid input
if(!emailPattern.test(value) && !mobilePattern.test(value)){
error.innerHTML="Enter valid Email or Mobile";
status.innerHTML="";
btn.classList.remove("active");
return;
}

error.innerHTML="";

// 🔍 check availability
fetch("check_contact.php",{
method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},
body:"contact="+encodeURIComponent(value)
})
.then(res=>res.text())
.then(data=>{

if(data.trim()=="exists"){
status.innerHTML="Already exists";
status.style.color="red";
btn.classList.remove("active");
}else{
status.innerHTML="Available";
status.style.color="green";
btn.classList.add("active");
btn.onclick = sendOTP;
}

});

}

// 🔥 OTP UI
function sendOTP(){

document.getElementById("otpArea").innerHTML = `
<div class="mini-otp-box">
<input type="text" id="enteredOtp" placeholder="Enter OTP" maxlength="6">
<button type="button" class="mini-btn" onclick="verifyOtp()">Verify</button>
</div>
`;

}

// 🔥 VERIFY OTP
function verifyOtp(){

let otp = document.getElementById("enteredOtp").value.trim();

if(otp=="123456"){

contactVerified = true;

document.getElementById("emailStatus").innerHTML="✔ Verified";
document.getElementById("emailStatus").style.color="green";

checkRegisterReady();

}else{
alert("Wrong OTP");
}

}

// 🔥 ENABLE REGISTER
function checkRegisterReady(){

let btn = document.getElementById("registerBtn");

if(contactVerified){
btn.disabled = false;
btn.style.opacity = "1";
btn.style.cursor = "pointer";
}else{
btn.disabled = true;
btn.style.opacity = "0.6";
btn.style.cursor = "not-allowed";
}

}