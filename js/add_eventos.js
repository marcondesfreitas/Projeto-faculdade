var titulo = $("#titulo");
var texto = document.getElementById('texto');
var data = $("#data_2");


$("#tit_in").on("keyup", function(){
    titulo.text($(this).val()); 

    if(titulo.text() == ""){
        titulo.text("Titulo...");
    }
});

function keyPressed(evt){
    evt = evt || window.event;
    var key = evt.keyCode;
    return key; 
}

function mudar(evt){
    texto.innerHTML = document.getElementById('text_in').value;

    if(texto.innerHTML == ""){
        texto.innerHTML = "Texto - Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum eos similique beatae eum dicta voluptatibus at aliquid, cupiditate aliquam molestiae officiis nihil suscipit perferendis corrupti odio a aperiam minus facilis";
    }

    var key = keyPressed(evt);

    console.log(key);

    if(key == 13){
        document.getElementById('text_in').value = (document.getElementById('text_in').value) + "\n\n<br><span id=margem></span>\n";
    }
}

$("#data_in").on("keyup", function(){
    dia = `${(($(this).val()). charAt(8))}` + `${(($(this).val()). charAt(9))}`;
    mes = `${(($(this).val()). charAt(5))}` + `${(($(this).val()). charAt(6))}`;
    ano = `${(($(this).val()). charAt(0))}` + `${(($(this).val()). charAt(1))}` + `${(($(this).val()). charAt(2))}` + `${(($(this).val()). charAt(3))}`;

    data.text("Data do Evento: " + dia + "/" + mes + "/" + ano);
});

$("#img_fundo").on("change", function(){
    console.log('teste');
    if (this.files && this.files[0]) {
        var file = new FileReader();
        file.onload = function(e) {
            $("#fundo").attr("src",  e.target.result);
        };       
        file.readAsDataURL(this.files[0]);
    }
});

$("#arquivo_2").on("change", function(){
    $("#imgs_2").empty();
    if (this.files && this.files[0]) {
        for (var i = 0, f; f = this.files[i]; i++){
            var file = new FileReader();

            file.onload = function(e) {
                var input = document.createElement("input");

                var img = document.createElement("img");

                $(img).attr("src",  e.target.result);
                $("#imgs_2").append(img);
            };       
            file.readAsDataURL(this.files[i]);
        }
    }
});