<script>
document.addEventListener("DOMContentLoaded", function(){

    // find the search input automatically
    const input = document.querySelector("input[name='search']");
    const table = document.querySelector("table");

    if(!input || !table) return;

    const rows = table.querySelectorAll("tr");

    input.addEventListener("input", function(){

        let value = input.value.toLowerCase();

        rows.forEach((row, index) => {

            // skip header row
            if(index === 0) return;

            let text = row.innerText.toLowerCase();

            if(text.includes(value)){
                row.style.display = "";
            } else {
                row.style.display = "none";
            }

        });

    });

});
</script>
</body>
</html>