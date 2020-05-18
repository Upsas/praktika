// Search
const searchBox = document.getElementById("searchBar");
const data = document.querySelectorAll(".value");
// Results
let rowCount = document.querySelector(".table").rows.length - 1;

searchBox.addEventListener("keyup", (e) => {
  const term = e.target.value.toLowerCase();
  let count = 0;
  data.forEach(function (item) {
    if (item.textContent.toLowerCase().indexOf(term) != -1) {
      item.closest(".value").style.display = "table-row";
      let a = item.closest(".value");

      if (a.childNodes.length > 0 && count < rowCount) {
        count++;
      } else {
        count = 0;
      }
    } else {
      item.closest(".value").style.display = "none";
    }
    let results = document.querySelector(".results");
    results.innerHTML = `<h3>${term} ( ${count} result(s))</h3>`;
  });
});
