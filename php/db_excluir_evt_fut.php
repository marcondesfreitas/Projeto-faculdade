<?php
include_once 'db_connect.php';
$GLOBALS["conexao"] = $conexao;

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

$id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);

$sql = "SELECT * FROM notificar_eventos WHERE Id = ".$id."";
$query= mysqli_query($conexao, $sql);
$list = mysqli_fetch_array($query);

$Nome_img = $list["Nome"];
                                
$letra_a = array("á", "à", "â", "ã");
$letra_A = array("Á", "À", "Â", "Ã");
$letra_o = array("ó", "ò", "ô", "õ");
$letra_O = array("Ó", "Ò", "Ô", "Õ");
$letra_e = array("é", "è", "ê");
$letra_E = array("É", "È", "Ê");
$letra_i = array("í", "ì");
$letra_I = array("Í", "Ì");
$letra_u = array("ú", "ù", "û");
$letra_U = array("Ú", "Ù", "Û");
$letra_c = array("ç");
$letra_C = array("Ç");

$Nome_img = str_replace($letra_a, "a", $Nome_img);
$Nome_img = str_replace($letra_A, "A", $Nome_img);
$Nome_img = str_replace($letra_o, "o", $Nome_img);
$Nome_img = str_replace($letra_O, "O", $Nome_img);
$Nome_img = str_replace($letra_e, "e", $Nome_img);
$Nome_img = str_replace($letra_E, "E", $Nome_img);
$Nome_img = str_replace($letra_u, "u", $Nome_img);
$Nome_img = str_replace($letra_U, "U", $Nome_img);
$Nome_img = str_replace($letra_c, "c", $Nome_img);
$Nome_img = str_replace($letra_C, "C", $Nome_img);
$Nome_img = str_replace($letra_i, "i", $Nome_img);
$Nome_img = str_replace($letra_I, "I", $Nome_img);

$GLOBALS['nome'] = $Nome_img;
$GLOBALS['foto_tipo'] = $list['Fotos'];

if(array_key_exists('button1', $_POST)){
    button1();
}
if(array_key_exists('button2', $_POST)){
    button2();
}
function button1(){
    $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
    $sql_del = "DELETE FROM notificar_eventos where Id = ".$id."";
    $query_del = mysqli_query($GLOBALS["conexao"], $sql_del);
    unlink('../imagens/eventos_futuros/'.$GLOBALS['nome'].$GLOBALS['foto_tipo']);

    echo "
        <script>
            alert ('Evento Excluido');
            window.location = '../paginas/eventos.php';
        </script>
    ";
}
function button2(){
    echo "
        <script>
            window.location = '../paginas/eventos.php';
        </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/excluir_evt_ft.css">
    <title>Excluir Evento</title>
</head>
<body>
    <h1>Tem certeza que deseja excluir o Evento? </h1>
    <div class="material">
        <div class="div_img">
            <img src="../imagens/eventos_futuros/<?php echo $Nome_img.$list["Fotos"];?>"id="img" >
        </div>
        <h2 style="font-syze: 0.8em;"><?php echo $list["Nome"];?></h2>
        <form method="post" id="form">
            <input type="submit" name="button1" value="Excluir" class="btn">
            <input type="submit" name="button2" value="Voltar" class="btn1">
        </form>
    </div>
    
</body>
</html> 