function checkUsername(){

let username = document.getElementById("username").value.trim();
let status = document.getElementById("userStatus");

if(username === ""){
status.innerHTML = "";
return;
}

let xhr = new XMLHttpRequest();

xhr.open("POST","check_username.php",true);
xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xhr.onreadystatechange = function(){

if(xhr.readyState == 4 && xhr.status == 200){

let res = xhr.responseText.trim();

if(res === "exists"){
status.innerHTML = "Username already exists";
status.style.color = "red";
}
else if(res === "available"){
status.innerHTML = "Username available";
status.style.color = "green";
}
else{
status.innerHTML = "";
}

}

};

xhr.send("username=" + encodeURIComponent(username));

}