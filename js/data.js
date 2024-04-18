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