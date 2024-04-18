var botoes = document.getElementById('bots');
var but1 = document.getElementById('but1');
var but2 = document.getElementById('but2');

var tela_1 = document.getElementById('tela_1');
var tela_2 = document.getElementById('tela_2');

function mostrar(evt){

    if(evt === '1'){
        botoes.style.cssText = "display: none;";
        tela_1.style.cssText = "sisplay: block";
    }else if(evt === '2'){
        botoes.style.cssText = "display: none;";
        tela_2.style.cssText = "sisplay: block";
    }
    
}

var hoje = new Date();  
var data = document.querySelector('#data').value;


$('#data').focusout(function(){
    console.log('teste');
    var hoje = new Date();  
    var data = document.querySelector('#data').value;

    if(hoje.getMonth() < 10){
        mes = '0' + (hoje.getMonth() + 1);
    }else{
        mes = hoje.getMonth() + 1;
    }

    if(hoje.getDate() < 10){
        dia = '0' + hoje.getDate();
    }else{
        dia  = hoje.getDate();
    }

    data_hoje = hoje.getFullYear() + '-' + mes + '-' + dia; 
    console.log(data);

    

    console.log(data_hoje);
    if(data > data_hoje){
        $('form').submit(function(e) {
            $(this).unbind('submit').submit();
        });
    }else{
        alert("Data inválida");
        $('form').submit(function(e) {
            e.preventDefault();
        });
    }
});

$('#data_in').focusout(function(){
    console.log('teste');
    var hoje = new Date();  
    var data = document.querySelector('#data_in').value;

    if(hoje.getMonth() < 10){
        mes = '0' + (hoje.getMonth() + 1);
    }else{
        mes = hoje.getMonth() + 1;
    }

    if(hoje.getDate() < 10){
        dia = '0' + hoje.getDate();
    }else{
        dia  = hoje.getDate();
    }

    data_hoje = hoje.getFullYear() + '-' + mes + '-' + dia; 

    

    if(data < data_hoje){
        $('form').submit(function(e) {
            $(this).unbind('submit').submit();
        });
    }else{
        alert("Data inválida");
        $('form').submit(function(e) {
            e.preventDefault();
        });
    }
});