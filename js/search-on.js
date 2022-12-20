var search = document.getElementById("pesquisar");
search.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchDataUsr();
  }
});

function searchDataUsr() {
  window.location = "online.php?search=" + search.value;
}

/*
var searchAdm = document.getElementById("pesquisarAdm");
searchAdm.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchDataAdm();
  }
});

function searchDataAdm() {
  window.location = "administradores.php?search=" + searchAdm.value;
}
*/
