function relatoriosOp() {
  var relatorio = document.getElementById("relatorio-1");
  var imgSeta = document.querySelector("#img-seta");
  if (relatorio.style.display == "block") {
    relatorio.style.display = "none";
    imgSeta.setAttribute("src", "/img/geral/seta-cima.svg");
  } else {
    relatorio.style.display = "block";
    relatorio.style.border = "none";
    imgSeta.setAttribute("src", "/img/geral/seta-baixo.svg");
  }
}
function relatorios2Op() {
  var relatorio = document.getElementById("relatorio-2");
  var imgSeta = document.querySelector("#img-seta2");

  if (relatorio.style.display == "block") {
    relatorio.style.display = "none";
    imgSeta.setAttribute("src", "/img/geral/seta-cima.svg");
  } else {
    relatorio.style.display = "block";
    relatorio.style.border = "none";
    imgSeta.setAttribute("src", "/img/geral/seta-baixo.svg");
  }
}

function relatorios3Op() {
  var relatorio = document.getElementById("relatorio-3");
  var imgSeta = document.querySelector("#img-seta3");

  if (relatorio.style.display == "block") {
    relatorio.style.display = "none";
    imgSeta.setAttribute("src", "/img/geral/seta-cima.svg");
  } else {
    relatorio.style.display = "block";
    relatorio.style.border = "none";
    imgSeta.setAttribute("src", "/img/geral/seta-baixo.svg");
  }
}
