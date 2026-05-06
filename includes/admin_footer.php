<?php if(isset($_SESSION['msg'])){ ?>

<script>
document.addEventListener("DOMContentLoaded", function(){

Swal.fire({
    title: "Success!",
    text: "<?php echo $_SESSION['msg']; ?>",
    icon: "success",
    confirmButtonColor: "#2563eb"
});

});
</script>

<?php unset($_SESSION['msg']); } ?>

<?php if($msg=="approved" || $msg=="rejected"){ ?>

<div class="popup-bg" id="popup">

    <div class="popup-box">

        <?php if($msg=="approved"){ ?>
            <h3>✅ Approved</h3>
            <p>Leave Approved Successfully</p>
        <?php } else { ?>
            <h3>❌ Rejected</h3>
            <p>Leave Rejected Successfully</p>
        <?php } ?>

        <button onclick="closePopup()">OK</button>

    </div>

</div>

<?php } ?>

<script src="js/admin-popup.js"></script>

<script>

function filterTable(){

let user = document.getElementById("searchUser").value.toLowerCase();
let type = document.getElementById("searchType").value.toLowerCase();
let from = document.getElementById("searchFrom").value.toLowerCase();
let to = document.getElementById("searchTo").value.toLowerCase();
let status = document.getElementById("searchStatus").value.toLowerCase();

let rows = document.querySelectorAll("#leaveTable tbody tr.leave-row");

let visibleCount = 0;

rows.forEach(function(row){

let cols = row.getElementsByTagName("td");

let cUser = cols[0].textContent.toLowerCase();
let cType = cols[1].textContent.toLowerCase();
let cFrom = cols[2].textContent.toLowerCase();
let cTo = cols[3].textContent.toLowerCase();
let cStatus = cols[4].textContent.toLowerCase();

let match =
cUser.includes(user) &&
cType.includes(type) &&
cFrom.includes(from) &&
cTo.includes(to) &&
cStatus.includes(status);

if(match){

row.classList.remove("filtered-hide");
visibleCount++;

}else{

row.classList.add("filtered-hide");

}

});

let noSearchData = document.getElementById("noSearchData");

let filtering =
user || type || from || to || status;

if(filtering && visibleCount === 0){

noSearchData.classList.remove("filtered-hide");

}else{

noSearchData.classList.add("filtered-hide");

}

}

</script>

</body>
</html>