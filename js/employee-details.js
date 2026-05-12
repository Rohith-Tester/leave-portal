function filterEmployeeTable(){

let searchId =
document.getElementById("searchId").value.toLowerCase();

let searchFullname =
document.getElementById("searchFullname").value.toLowerCase();

let searchUsername =
document.getElementById("searchUsername").value.toLowerCase();

let searchEmail =
document.getElementById("searchEmail").value.toLowerCase();

let searchMobile =
document.getElementById("searchMobile").value.toLowerCase();

let searchDepartment =
document.getElementById("searchDepartment").value.toLowerCase();

let searchDesignation =
document.getElementById("searchDesignation").value.toLowerCase();

let searchRole =
document.getElementById("searchRole").value.toLowerCase();

let rows =
document.querySelectorAll(".small-table tbody tr");

rows.forEach(function(row){

let cols = row.getElementsByTagName("td");

if(cols.length < 8){
return;
}

let id =
cols[0].innerText.toLowerCase();

let fullname =
cols[1].innerText.toLowerCase();

let username =
cols[2].innerText.toLowerCase();

let email =
cols[3].innerText.toLowerCase();

let mobile =
cols[4].innerText.toLowerCase();

let department =
cols[5].innerText.toLowerCase();

let designation =
cols[6].innerText.toLowerCase();

let role =
cols[7].innerText.toLowerCase();

if(
id.includes(searchId) &&
fullname.includes(searchFullname) &&
username.includes(searchUsername) &&
email.includes(searchEmail) &&
mobile.includes(searchMobile) &&
department.includes(searchDepartment) &&
designation.includes(searchDesignation) &&
role.includes(searchRole)
){

row.classList.remove("hide-row");

}else{

row.classList.add("hide-row");

}

});

}