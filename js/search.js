var searchC = document.getElementById("pesquisarC");

searchC.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchData();
  }
});

function searchData() {
  window.location = "cadastros.php?pagina=1&search=" + searchC.value;
}
