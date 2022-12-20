function ativaMenu() {
  var menu = document.getElementById("navigation-sub");
  var menu2 = document.getElementById("navigation-sub2");
  var menu3 = document.getElementById("navigation-sub3");
  var imgCad = document.querySelector("#img-cadastro");

  if (
    typeof menu != "undefined" &&
    typeof menu2 != "undefined" &&
    typeof menu3 != "undefined"
  ) {
    if (
      menu.style.display == "block" &&
      menu2.style.display == "block" &&
      menu3.style.display == "block"
    ) {
      menu.style.display = "none";
      menu2.style.display = "none";
      menu3.style.display = "none";
      imgCad.setAttribute("src", "/img/geral/cadastro-files-full.svg");
    } else {
      menu.style.display = "block";
      menu2.style.display = "block";
      menu3.style.display = "block";
      imgCad.setAttribute("src", "/img/geral/cadastro-files.svg");
    }
  }
  // object exists
  else if (
    typeof menu != "undefined" &&
    typeof menu2 != "undefined" &&
    typeof menu3 == "undefined"
  ) {
    if (menu.style.display == "block" && menu2.style.display == "block") {
      menu.style.display = "none";
      menu2.style.display = "none";
      img.setAttribute("src", "/img/geral/cadastro-files-full.svg");
    } else {
      menu.style.display = "block";
      menu2.style.display = "block";
      img.setAttribute("src", "/img/geral/cadastro-files.svg");
    }
  }
  // object does not exist
}
function ativaRelatorio() {
  var relatorio = document.getElementById("navigation-sub-relatorio");
  var relatorio2 = document.getElementById("navigation-sub2-relatorio");
  var relatorio3 = document.getElementById("navigation-sub3-relatorio");
  var img = document.querySelector("#img-relatorio");
  if (
    typeof relatorio != "undefined" &&
    typeof relatorio2 != "undefined" &&
    typeof relatorio3 != "undefined"
  ) {
    if (
      relatorio.style.display == "block" &&
      relatorio2.style.display == "block" &&
      relatorio3.style.display == "block"
    ) {
      relatorio.style.display = "none";
      relatorio2.style.display = "none";
      relatorio3.style.display = "none";
      img.setAttribute("src", "/img/geral/pasta-relatorio.svg");
    } else {
      relatorio.style.display = "block";
      relatorio2.style.display = "block";
      relatorio3.style.display = "block";
      img.setAttribute("src", "/img/geral/pasta-relatorio-open.svg");
    }
  }
  // object exists
  else if (
    typeof relatorio != "undefined" &&
    typeof relatorio2 != "undefined" &&
    typeof relatorio3 == "undefined"
  ) {
    if (
      relatorio.style.display == "block" &&
      relatorio2.style.display == "block"
    ) {
      relatorio.style.display = "none";
      relatorio2.style.display = "none";
      img.setAttribute("src", "/img/geral/pasta-relatorio.svg");
    } else {
      relatorio.style.display = "block";
      relatorio2.style.display = "block";
      img.setAttribute("src", "/img/geral/pasta-relatorio-open.svg");
    }
  }
  // object does not exist
}

/*function ativarelatorio() {
  var menu = document.querySelector(".navigation-sub");
  var menu2 = document.querySelector(".navigation-sub2");
  var menu3 = document.querySelector(".navigation-sub3");
  menu.classList.add("ativado");
  menu2.classList.add("ativado");
  menu3.classList.add("ativado");
}
*/
