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
    <link rel="stylesheet" href="../css/add_membros.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Adicionar Membro</title>
</head>
<body>
    <div class="tela">
        <fieldset class="field">
            <h1>Adicionar Membro</h1>
            <form action="../php/db_add_membro.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nome" class="nome" placeholder="Nome">
                <br>
                <input type="text" name="cargo" class="cargo" placeholder="Cargo">
                <br>
                <input type="text" name="link" class="link" placeholder="Link">
                <br>
                <br>
                <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                <p>Adicionar Foto</p>
                <input type="file" name="foto" id="arquivo" accept="image/png, image/jpg, image/jpeg, image/gif">
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
                <br>
                <button class="btn">Adicionar</button>
            </form>
        </fieldset>
    </div>
</body>
</html>