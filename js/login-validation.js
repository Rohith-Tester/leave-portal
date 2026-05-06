function setRole(role){

document.getElementById("login_role").value = role;

const userBtn =
document.getElementById("userBtn");

const adminBtn =
document.getElementById("adminBtn");

userBtn.classList.remove("active-role");
adminBtn.classList.remove("active-role");

if(role === "admin"){

adminBtn.classList.add("active-role");

}else{

userBtn.classList.add("active-role");

}

}

document.getElementById("loginForm").addEventListener("submit",function(e){

let user=document.getElementById("username");
let pass=document.getElementById("password");

let userError=document.getElementById("userError");
let passError=document.getElementById("passError");

userError.innerHTML="";
passError.innerHTML="";
user.classList.remove("input-error");
pass.classList.remove("input-error");

let valid=true;

if(user.value.trim()==""){
user.classList.add("input-error");
userError.innerHTML="Enter the details";
valid=false;
}

if(pass.value.trim()==""){
pass.classList.add("input-error");
passError.innerHTML="Enter the details";
valid=false;
}

if(!valid){
e.preventDefault();
}

});