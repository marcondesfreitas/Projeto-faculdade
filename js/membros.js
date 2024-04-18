var titulo = document.getElementById("titulo");
var linha = document.getElementById("linhamenu");
var titulogeente = document.getElementById("tit_img");
var botao = document.getElementById("btn");
var menu_mobile = document.getElementById("menu__");
var botao = document.getElementById("btn_hamburguer");

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
      location.reload();
    }, 4000);
    
  }
  