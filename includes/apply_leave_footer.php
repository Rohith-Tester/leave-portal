<?php if(isset($_SESSION['error'])){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $_SESSION['error']; ?>",
    icon: "error"
});
</script>
<?php unset($_SESSION['error']); } ?>

<?php if(isset($_SESSION['msg'])){ ?>

<script>
document.addEventListener("DOMContentLoaded", function(){

    Swal.fire({
        title: "Success!",
        text: "<?php echo $_SESSION['msg']; ?>",
        icon: "success",
        confirmButtonColor: "#2563eb",
        confirmButtonText: "OK"
    });

});
</script>

<?php unset($_SESSION['msg']); } ?>

<script>
const from = document.getElementById("fromDate");
const to = document.getElementById("toDate");
const days = document.getElementById("days");

function calculateDays(){
    if(from && to && days && from.value && to.value){
        let d1 = new Date(from.value);
        let d2 = new Date(to.value);

        let diff = (d2 - d1) / (1000 * 60 * 60 * 24) + 1;

        days.value = diff > 0 ? diff + " Days" : "0 Days";
    }
}

/* ✅ SAFE EVENT BINDING */
if(from && to){
    from.addEventListener("change", calculateDays);
    to.addEventListener("change", calculateDays);
}
</script>
</body>
</html>