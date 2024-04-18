<?php
session_start();

if($_SESSION["Adm"] != true){
    echo "
        <script>
            alert('Você não tem permissão');
            window.location = '../index.php';
        </script>
    ";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_eventos.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Adicionar Evento</title>
</head>
<body>
    <div id="bots" class="bots">
        <button id="but1" class="but" onclick="mostrar('1')">Noticiar Evento Futuro</button>
        <button id="but2" class="but" onclick="mostrar('2')">Registrar um Evento que Ocorreu</button>
    </div>
    <div class="tela_1" id="tela_1" style="display: none;">
        <fieldset class="field">
            <h1>Notificar Evento</h1>
            <form action="../php/db_notificar_evt.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nome" class="nome" placeholder="Nome">
                <br>
                <textarea name="descricao" id="desc" class="desc" cols="30" rows="10" placeholder="Descrição"></textarea>
                <p class="datatxt">Data do Evento:</p>
                <input type="date" id="data" name="data" class="data" max="9999-12-31">
                <br>
                <input type="text" name="link" id="link" placeholder="Link do Forms" class="link"><br>
                <br>
                <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                <p>Adicionar Foto</p>
                <input type="file" name="foto" id="arquivo" accept="image/png, image/jpg, image/jpeg, image/gif">
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
                <button class="btn">Noticiar</button>
            </form>
        </fieldset>
    </div>
    <div class="tela_2" id="tela_2" style="display: none;">
        <div class="env">
            <fieldset class="field2">
                <h1>Registrar Evento</h1>
                <form action="../php/db_registrar_evento.php" method="post" enctype="multipart/form-data">
                    <input type="text" id="tit_in" name="tit" class="nome" placeholder="Titulo">
                    <br>
                    <br>
                    <p>Data do Evento:</p>
                    <input type="date" max="9999-12-31" name="data_2" id="data_in" class="data">
                    <br>
                    <textarea name="texto" onkeypress="mudar()" id="text_in" class="text" cols="30" rows="10" placeholder="Texto/Relato do Evento"></textarea>
                    <br>
                    <label for="img_fundo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                    <p>Foto de Fundo</p>
                    <input type="file" name="img_fundo" id="img_fundo" accept="image/png, image/jpg, image/jpeg, image/gif">
                    <br>
                    <p>Fotos do Evento: </p>
                    <input type="file" name="foto_2[]" multiple="multiple" id="arquivo_2" accept="image/png, image/jpg, image/jpeg, image/gif">
                    <br>
                    <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
                    <br>
                    <button class="btn">Adicionar</button>
                </form>
            </fieldset>
        </div>
        <div class="modelo">
            <h1>Como ficará a Página:</h1>
                <div class="exmp">
                    <div class="fund">
                        <img id="fundo" />
                    </div>
                    <div class="artc">
                        <h1 id="titulo">Titulo</h1>
                        <p id="data_2">Data do Evento: xx/xx/xxxx</p>
                        <p id="texto">Texto - Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum eos similique beatae eum dicta voluptatibus at aliquid, cupiditate aliquam molestiae officiis nihil suscipit perferendis corrupti odio a aperiam minus facilis.</p>
                        <div class="imgs" id="imgs_2">
                            
                        </div>  
                    </div>
                </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/eventos.js"></script>
    <script src="../js/add_eventos.js"></script>
</body>
</html>