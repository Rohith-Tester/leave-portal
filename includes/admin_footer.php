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
    let to   = document.getElementById("searchTo").value.toLowerCase();
    let status = document.getElementById("searchStatus").value.toLowerCase();

    let rows = document.querySelectorAll(".small-table tbody tr");

    rows.forEach(row => {

        let cols = row.getElementsByTagName("td");

        if(cols.length < 6) return; // skip empty row

        let cUser = cols[0].innerText.toLowerCase();
        let cType = cols[1].innerText.toLowerCase();
        let cFrom = cols[2].innerText.toLowerCase();
        let cTo   = cols[3].innerText.toLowerCase();
        let cStatus = cols[4].innerText.toLowerCase();

        let match =
            cUser.includes(user) &&
            cType.includes(type) &&
            cFrom.includes(from) &&
            cTo.includes(to) &&
            cStatus.includes(status);

        row.style.display = match ? "" : "none";

    });

}
</script>

</body>
</html>