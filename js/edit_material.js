n = 0;

function view(){
    n += 1;

    var doc = document.getElementById('doc');
    var bot = document.getElementById('btn');

    if(n === 1){
        doc.style.cssText = "display: block;";
        bot.value = "Ocultar Documento";
    }else if(n === 2){
        doc.style.cssText = "display: none;";
        bot.value = "Exibir Documento Atual";
        n = 0;
    }
}