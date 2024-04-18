var header = document.getElementById("lis_1");
var fundo = document.getElementById("ft1");
var titulo = document.getElementById("titulo");
var linha = document.getElementById("linhamenu");
var titulogeente = document.getElementById("tit_img");
var botao = document.getElementById("btn");
var menu_mobile = document.getElementById("menu__");
var botao = document.getElementById("btn_hamburguer");

var contador = 0;

function aparecer(){
  menu_mobile.style.display = "flex";
  menu_mobile.style.animation = "aparecer2 0.5s";
}

function desaparecer(){
  menu_mobile.style.animation = "desaparecer2 0.5s";
  setTimeout(function() {
    menu_mobile.style.display = "none";
  }, 450);
  botao.style.animation = "aparecer3 4s";

  setTimeout(function() {
  }, 4000);
  
}

window.addEventListener('resize', function() {

  var screenWidth = window.innerWidth;

  if (screenWidth < 768) {
    header.style.display = "none";
    titulogeente.style.textAlign = "center";
    linhamenu.style.display = "none";
    botao.style.display = "block";
  } else {
    
    botao.style.display = "none";
    header.style.display = "block";
  }
});

if (window.innerWidth < 768) {
  header.style.display = "none";
  titulogeente.style.textAlign = "center";
  linhamenu.style.display = "none";
} else {
  
  botao.style.display = "none";
  header.style.display = "block";
}

