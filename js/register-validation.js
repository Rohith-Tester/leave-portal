document.getElementById("registerForm").addEventListener("submit",function(e){

let valid=true;

let fields=[
["fullname","nameError"],
["username","userError"],
["email","emailError"],
["mobile","mobileError"],
["password","passError"],
["confirm_password","cpassError"]
];

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

let role = document.getElementById("role");
let roleError = document.getElementById("roleError");

role.classList.remove("input-error");
roleError.innerHTML = "";

if(role.value.trim() == ""){

role.classList.add("input-error");
role.style.border = "1px solid red";
role.style.animation = "shake 0.3s linear 2";

roleError.innerHTML = "Select role";

valid = false;

}else{

role.style.border = "";
role.style.animation = "";

}

if(role.value==""){
roleError.innerHTML="Select role";
valid=false;
}

if(!valid){
e.preventDefault();
}

});