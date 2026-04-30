function checkPasswordMatch(){

let pass=document.getElementById("password").value;
let cpass=document.getElementById("confirm_password").value;
let status=document.getElementById("matchStatus");

if(cpass==""){
status.innerHTML="";
return;
}

if(pass==cpass){
status.innerHTML="Password matched";
status.style.color="green";
}else{
status.innerHTML="Password not matched";
status.style.color="red";
}

}