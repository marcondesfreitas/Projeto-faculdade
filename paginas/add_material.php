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
    <link rel="stylesheet" href="../css/add_material.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Adicionar Material</title>
</head>
<body>
    <header>
        <div class="tela">
            <fieldset class="field">
            <h1>Adicionar Material</h1>
                <form action="../php/db_add_material.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="tit" id="tit" placeholder="Titulo" class="titulo" required><br>
                    <input type="text" name="autor" id="autor" placeholder="autor" class="autor" required><br>
                    <input type="text" name="link" id="link" placeholder="Link" class="link"><br>
                    <input type="file" name="doc" class="arquivo"><br>
                    <input  max="9999-12-31" type="date" name="data" id="data_in" class="data" required><br>
                    <textarea name="desc" id="desc" id="desc" cols="24" rows="5" placeholder="descricao" class="descricao" required></textarea><br>
                    <select name="categoria" id="categoria" onclick="girar()">
                        <option value="Artigo Científico" >Artigo Científico</option>
                        <option value="Dissertação">Dissertação</option>
                        <option value="Livro">Livro</option>
                        <option value="Tese">Tese</option>
                    </select>
                    <img src="../imagens/seta.png" alt="" class="seta_img" id="imgg">
                    <input type="hidden" name="MAX_FILE_SIZE" value="99999999"><br>
                    <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                    <p class="texto">Adicionar Documento</p>
                    <input type="file" name="doc" id="arquivo" accept=".pdf, .doc, .docx"><br>

                    <button class="btn">Adicionar</button>
                </form>
            </fieldset>
        </div>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/add_material.js"></script>
    <script src="../js/materia.js"></script>
    <script src="../js/data.js"></script>
</body>
</html>