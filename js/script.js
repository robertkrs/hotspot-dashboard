const nome = document.querySelector("#nome");

nome.addEventListener("keydown", function (e) {
  if (e.key >= "0" && e.key <= "9") {
    e.preventDefault();
  }
});

const cpf = document.querySelector("#cpf");

cpf.addEventListener("keydown", function (e) {
  if (e.key >= "a" && e.key <= "z") {
    e.preventDefault();
  }
});

cpf.addEventListener("blur", function (e) {
  //Remove tudo que não é digito
  let validar_cpf = this.value.replace(/\D/g, "");

  //verificação da quantidade numeros
  //verificação da quantidade números
  if (validar_cpf.length == 11) {
    // verificação de CPF valido
    var Soma;
    var Resto;

    Soma = 0;
    for (i = 1; i <= 9; i++)
      Soma = Soma + parseInt(validar_cpf.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(validar_cpf.substring(9, 10)))
      return alert("CPF Inválido!");

    Soma = 0;
    for (i = 1; i <= 10; i++)
      Soma = Soma + parseInt(validar_cpf.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(validar_cpf.substring(10, 11)))
      return alert("CPF Inválido!");

    //formatação final
    cpf_final = validar_cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf_final = cpf_final.replace(/(\d{3})(\d)/, "$1.$2");
    cpf_final = cpf_final.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    document.getElementById("cpf").value = cpf_final;
  } else {
    alert("CPF Inválido! É esperado 11 dígitos numéricos.");
  }
});

/**Celular */
let celular_campo = document.querySelector("#telefone");

celular_campo.addEventListener("blur", function (e) {
  //Remove tudo o que não é dígito
  let celular = this.value.replace(/\D/g, "");

  if (celular.length == 11) {
    celular = celular.replace(/^(\d{2})(\d)/g, "($1) $2");
    resultado_celular = celular.replace(/(\d)(\d{4})$/, "$1-$2");
    document.getElementById("telefone").value = resultado_celular;
  } else {
    alert("Digite 11 números.");
  }
});

let download = document.querySelector("#download");

/** valida o cep */

function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById("rua").value = "";
  document.getElementById("bairro").value = "";
  document.getElementById("cidade").value = "";
  document.getElementById("estado").value = "";
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById("rua").value = conteudo.logradouro;
    document.getElementById("bairro").value = conteudo.bairro;
    document.getElementById("cidade").value = conteudo.localidade;
    document.getElementById("estado").value = conteudo.uf;
  } //end if.
  else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
  }
}

function pesquisacep(valor) {
  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, "");

  //Verifica se campo cep possui valor informado.
  if (cep != "") {
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if (validacep.test(cep)) {
      document.getElementById("cep").value =
        cep.substring(0, 5) + "-" + cep.substring(5);
      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById("rua").value = "...";
      document.getElementById("bairro").value = "...";
      document.getElementById("cidade").value = "...";
      document.getElementById("estado").value = "...";

      //Cria um elemento javascript.
      var script = document.createElement("script");

      //Sincroniza com o callback.
      script.src =
        "https://viacep.com.br/ws/" + cep + "/json/?callback=meu_callback";

      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);
    } //end if.
    else {
      //cep é inválido.
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
  }
}
var cep = document.querySelector("#cep");
cep.addEventListener("keydown", function (e) {
  if (e.key >= "a" && e.key <= "z") {
    e.preventDefault();
  }
});

function janela() {
  window.open("./termos.html", "", "width=600,height=600");
}

function alerta() {
  var alert1 = document.getElementById("senha");
  var alert2 = document.getElementById("confirma-senha");

  if (alert1.value != alert2.value) {
    alert("Senhas estão incorretas");
    window.location = "registrar.php";
  }
}
function alerta2() {
  var alert1 = document.getElementById("senha");
  var alert2 = document.getElementById("confirma-senha");

  if (alert1.value != alert2.value) {
    alert("Senhas estão incorretas");
    window.location = "componentes/dashboard/recuperacao/recuperacao-senha.php";
  }
}
/**Adiciona a classe checado ao item*/
function checkado() {
  var check = document.getElementById("check").checked;
  if (check === true) {
    var button = document.getElementById("submit");
    button.classList.add("checado");
  }
}
function uncheck() {
  var check = document.getElementById("check").checked;
  if (check === false) {
    var button = document.getElementById("submit");
    button.classList.remove("checado");
  }
}
/** faz o pop up aparecer */
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
function myFunctionE() {
  var popup = document.getElementById("myPopupE");
  popup.classList.toggle("show");
}
function ativaToken() {
  alert("Email enviado com sucesso, favor checar o seu email");
}
///Senha visivel///
/*
let container = document.querySelector(".n-senha");
let input = document.getElementById("senha");
let icon = document.querySelector(".n-icon");

icon.addEventListener("click", function () {
  container.classList.toggle("visible");
  if (container.classList.contains("visible")) {
    icon.src = "./img/geral/eye.svg";
    input.type = "text";
  } else {
    icon.src = "./img/geral/eyeoff.svg";
    input.type = "password";
  }
});

let container2 = document.querySelector(".c-senha");
let input2 = document.getElementById("csenha");
let icon2 = document.querySelector(".c-icon");

icon2.addEventListener("click", function () {
  container2.classList.toggle("visible");
  if (container2.classList.contains("visible")) {
    icon2.src = "./img/geral/eye.svg";
    input2.type = "text";
  } else {
    icon2.src = "./img/geral/eyeoff.svg";
    input2.type = "password";
  }
});
*/
function darkMode() {
  var element = document.body;
  element.classList.toggle("dark-mode");
}
