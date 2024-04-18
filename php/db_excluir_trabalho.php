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

$sql = "SELECT * FROM trabalho WHERE Id = ".$id."";
$query= mysqli_query($conexao, $sql);
$list = mysqli_fetch_array($query);

if(array_key_exists('button1', $_POST)){
    button1();
}
if(array_key_exists('button2', $_POST)){
    button2();
}
function button1(){
    $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
    $sql_del = "DELETE FROM trabalho where Id = ".$id."";
    $query_del = mysqli_query($GLOBALS["conexao"], $sql_del);
    echo "
        <script>
            alert ('Trabalho Excluido');
            window.location = '../paginas/trabalhos.php';
        </script>
    ";
}
function button2(){
    echo "
        <script>
            window.location = '../paginas/trabalhos.php';
        </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/db_excluir_material.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Excluir Trabalho</title>
</head>
<body>
    <h1>Tem certeza que deseja excluir o Trabalho do Banco de Dados? </h1>
    <div class="material">  
        <div class="titulo">
            <h3>Nome do Trabalho: </h3><h2><?php echo $list["Titulo"];?></h2>
        </div>
        <?php
            if(substr($list["Nome_doc"], -4) == "docx" or substr($list["Nome_doc"], -3) == "doc"){
                echo '
                    <button id="apagar" class="ex"><a style="color: white; text-decoration: none;" href="http://localhost/faculdade/php/documentos/trabalho/'.$list["Nome_doc"].'">Baixar Documento</a></button>
                ';
            }else{
                $Nome_doc = $list["Nome_doc"];
                                
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

                $Nome_doc = str_replace($letra_a, "a", $Nome_doc);
                $Nome_doc = str_replace($letra_A, "A", $Nome_doc);
                $Nome_doc = str_replace($letra_o, "o", $Nome_doc);
                $Nome_doc = str_replace($letra_O, "O", $Nome_doc);
                $Nome_doc = str_replace($letra_e, "e", $Nome_doc);
                $Nome_doc = str_replace($letra_E, "E", $Nome_doc);
                $Nome_doc = str_replace($letra_u, "u", $Nome_doc);
                $Nome_doc = str_replace($letra_U, "U", $Nome_doc);
                $Nome_doc = str_replace($letra_c, "c", $Nome_doc);
                $Nome_doc = str_replace($letra_C, "C", $Nome_doc);
                $Nome_doc = str_replace($letra_i, "i", $Nome_doc);
                $Nome_doc = str_replace($letra_I, "I", $Nome_doc);
                
                echo'
                    <iframe src="documentos/trabalho/'.$Nome_doc.'"
                    style="width:900px; height:500px;" frameborder="2" class="painel"></iframe>
                ';
            }
        ?>
    </div>
    <div class="botoes">
        <form method="post">
            <input type="submit" name="button1" value="Excluir" class="ex">
            <input type="submit" name="button2" value="Voltar" class="vl">
        </form>
    </div>
</body>
</html> 