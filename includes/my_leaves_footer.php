<script>
document.addEventListener("DOMContentLoaded", function(){

    const inputs = {
        type: document.getElementById("searchType"),
        from: document.getElementById("searchFrom"),
        to: document.getElementById("searchTo"),
        status: document.getElementById("searchStatus")
    };

    const rows = document.querySelectorAll(".leave-table tbody tr");

    function filterTable(){
        rows.forEach(row => {

            const cols = row.querySelectorAll("td");

            if(cols.length < 4) return;

            let type = cols[0].innerText.toLowerCase();
            let from = cols[1].innerText.toLowerCase();
            let to = cols[2].innerText.toLowerCase();
            let status = cols[3].innerText.toLowerCase();

            let match =
                type.includes(inputs.type.value.toLowerCase()) &&
                from.includes(inputs.from.value.toLowerCase()) &&
                to.includes(inputs.to.value.toLowerCase()) &&
                status.includes(inputs.status.value.toLowerCase());

            row.style.display = match ? "" : "none";
        });
    }

    Object.values(inputs).forEach(input => {
        input.addEventListener("input", filterTable);
    });

});
</script>
</body>
</html>