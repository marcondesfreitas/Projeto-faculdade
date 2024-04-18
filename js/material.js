var categoria = $('#categoria');
var n = 0;

document.getElementById("btn-voltar-topo").addEventListener("click", function(){
    window.scrollTo({top: 0, behavior: "smooth"});
});

window.addEventListener("scroll", function(){
    var scroll = window.pageYOffset || document.documentElement.scrollTop; /* Pega o valor do scroll da página */
    var titulo = document.getElementById("titulo"); /* Seleciona a imagem */

    console.log((1 - scroll/1000));
    if((1 - scroll/1000) < 0.7){
        setTimeout(function() {
            document.getElementById("subir").style.animation = "subir 2s";
        }, 2000);
        document.getElementById("subir").style.display = "block";
    }else{
        document.getElementById("subir").style.display = "none";
    }
});

categoria.change(function(){
    $('#catg').val(categoria.val());   
    
    var cat_form = document.getElementById('cat_form');

    cat_form.submit();
});

