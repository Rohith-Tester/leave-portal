<script>

const searchInputs = document.querySelectorAll(
".bottom-search-row input"
);

const tableBody =
document.getElementById("leaveTableBody");

const tableRows =
tableBody.querySelectorAll("tr");

searchInputs.forEach(input => {

input.addEventListener("keyup", filterTable);

});

function filterTable(){

let type =
document.getElementById("searchType")
.value.toLowerCase();

let from =
document.getElementById("searchFrom")
.value.toLowerCase();

let to =
document.getElementById("searchTo")
.value.toLowerCase();

let status =
document.getElementById("searchStatus")
.value.toLowerCase();

let visibleCount = 0;

/* remove old no record row */
const oldNoRow =
document.querySelector(".filter-no-record");

if(oldNoRow){
oldNoRow.remove();
}

tableRows.forEach(row => {

const cells = row.querySelectorAll("td");

if(cells.length < 4) return;

let typeText =
cells[0].innerText.toLowerCase();

let fromText =
cells[1].innerText.toLowerCase();

let toText =
cells[2].innerText.toLowerCase();

let statusText =
cells[3].innerText.toLowerCase();

let match =
typeText.includes(type) &&
fromText.includes(from) &&
toText.includes(to) &&
statusText.includes(status);

if(match){

row.style.display = "";

visibleCount++;

}else{

row.style.display = "none";

}

});

/* no records found */
if(visibleCount === 0){

let newRow =
document.createElement("tr");

newRow.classList.add("filter-no-record");

newRow.innerHTML = `
<td colspan="4" class="no-data-cell">
No records found
</td>
`;

tableBody.appendChild(newRow);

}

}

</script>

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