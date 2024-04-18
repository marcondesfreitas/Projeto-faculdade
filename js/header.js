var span = document.getElementById("span").textContent;

var te = document.querySelector('#te');
var me = document.querySelector('#me');
var evt = document.querySelector('#evt');
var qs = document.querySelector('#qs');
var subl = document.querySelector('.subl');
var article = document.querySelector("#article");
var foto = document.querySelector(".fundo");

window.addEventListener("scroll", function(){
    var scroll = window.pageYOffset || document.documentElement.scrollTop; /* Pega o valor do scroll da página */
    var titulo = document.getElementById("titulo"); /* Seleciona a imagem */

    if((1 - scroll/1000) > -0.5){
        titulo.style.transform = "scale(" + (1 - scroll/1000) + ")"; /* Define a escala da imagem de acordo com o valor do scroll */
    }
});


te.addEventListener('mouseover', mudarSubl);
te.myParam = "1";
te.addEventListener('mouseout', restaurar);

me.addEventListener('mouseover', mudarSubl);
me.myParam = "2";
me.addEventListener('mouseout', restaurar);

evt.addEventListener('mouseover', mudarSubl);
evt.myParam = "3";
evt.addEventListener('mouseout', restaurar);

qs.addEventListener('mouseover', mudarSubl);
qs.myParam = "4";
qs.addEventListener('mouseout', restaurar);



function mudarSubl(evt){
    if (evt.currentTarget.myParam === "1"){
        subl.style.cssText = "left: 69.2vw; width: 13.85vw;";
    }else if (evt.currentTarget.myParam === "2"){
        subl.style.cssText = "left: 55.7vw; width: 13.52vw;";
    }else if (evt.currentTarget.myParam === "3"){
        subl.style.cssText = "left: 83vw; width: 6.65vw;";
    }else{
        subl.style.cssText = "left: 89.65vw; width: 12vw;";
    }
}
function restaurar(){
    if(span === "pi"){
        subl.style.cssText = "left: 55.7vw; width = 50vw;";
    }else if(span == "qs"){
        subl.style.cssText = "left: 89.65vw; width: 12vw;";
    }else if(span == "me"){
        subl.style.cssText = "left: 55.7vw; width: 13.55vw;";
    }else if(span == "evt"){
        subl.style.cssText = "left: 83vw; width: 6.6vw;";
    }else if(span == "te"){
        subl.style.cssText = "left: 69.2vw; width: 13.85vw;";
    }
}

function barra(){
    var barra = document.getElementById("barra");

    console.log('teste');

    barra.style.cssText = "animation: 2s barra";
}