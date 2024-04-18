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

$sql = "SELECT * FROM registrar_eventos WHERE Id = ".$id."";
$query= mysqli_query($conexao, $sql);
$list = mysqli_fetch_array($query);

$Nome_img = $list["Titulo"];
                                
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
$GLOBALS['foto_tipo'] = $list['Foto_fundo'];

if(array_key_exists('button1', $_POST)){
    button1();
}
if(array_key_exists('button2', $_POST)){
    button2();
}
function button1(){
    $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
    
    function delTree($dir) { 
        $files = array_diff(scandir($dir), array('.','..')); 
        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
    }
    delTree('../imagens/registro_eventos/'.$GLOBALS['nome'].'/');

    $sql_del = "DELETE FROM registrar_eventos where Id = ".$id."";
    $query_del = mysqli_query($GLOBALS["conexao"], $sql_del);

    $sql_del_img = "DELETE FROM img_evento where Id_evento = ".$id."";
    $query_del_img = mysqli_query($GLOBALS["conexao"], $sql_del_img);

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
    <title>Excluir Evento</title>
</head>
<body>
    <h1>Tem certeza que deseja excluir o Registro do Evento? </h1>
    <div class="material" style="position: relative; left: 15%;">
        <img src="../imagens/registro_eventos/<?php echo $Nome_img;?>/fundo_<?php echo $Nome_img.$list["Foto_fundo"];?>"
        style="width:70%; height:40%">
        <h1 style="font-syze: 0.8em; margin-bottom: 20px;"><?php echo $list["Titulo"];?></h1>
    </div>
    <form method="post" style="position: relative; left: 40%;">
        <input type="submit" name="button1" value="Excluir">
        <input type="submit" name="button2" value="Voltar">
    </form>
</body>
</html> 