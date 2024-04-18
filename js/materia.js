var contador = 0;
var outro = 0;
var img = document.getElementById('imgg');

function girar(){
    contador++;
    console.log(contador);
    // Verifica o valor do contador e executa a função apropriada
    if (contador === 1) {
        img.style.transform = "rotate(180deg)";
    } else if (contador === 2) {
        img.style.transform = "rotate(0deg)";
        contador = 0;
    }

}

window.onclick = function(){
    outro ++;
    if (outro === 2) {
        img.style.transform = "rotate(0deg)";
        outro = 0;
        contador = 0;
    }
    if(outro != contador){
        outro = 0;
    }
}