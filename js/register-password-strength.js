function checkPasswordStrength(){

let pass=document.getElementById("password").value;
let status=document.getElementById("passwordStrength");

let score=0;

if(pass.length>=8) score++;
if(/[A-Z]/.test(pass)) score++;
if(/[0-9]/.test(pass)) score++;
if(/[!@#$%^&*]/.test(pass)) score++;

if(pass.length==0){
status.innerHTML="";
return;
}

if(score<=1){
status.innerHTML="Weak Password";
status.style.color="red";
}
else if(score<=3){
status.innerHTML="Medium Password";
status.style.color="orange";
}
else{
status.innerHTML="Strong Password";
status.style.color="green";
}

}