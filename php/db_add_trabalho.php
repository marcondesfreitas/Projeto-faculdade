<?php
include_once 'db_connect.php';

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

$Titulo = $_POST['tit'];
$Descricao = $_POST['desc'];
$Data = $_POST['data'];
$Autor = $_POST['autor'];
$Link = $_POST['link'];
$Documento = $_FILES['doc']['tmp_name'];
$Nome_doc = $_FILES['doc']['name'];
$Categoria = $_POST['categoria'];

if($Nome_doc != ""){
    $_UP['pasta'] = 'documentos/trabalho/';
    $_UP['extensoes'] = array('pdf', 'doc', 'docx');
    
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    
    if ($_FILES['doc']['error'] != 0) {
        die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['doc']['error']]);
        exit;
    }
    
    $tmp = explode('.', $_FILES['doc']['name']);
    $extensao = end($tmp);
    
    if (array_search($extensao, $_UP['extensoes']) === false) {
        echo "Por favor, envie arquivos com as seguintes extensões: pdf ou doc";
    }else {
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
        
        if (move_uploaded_file($Documento, $_UP['pasta'] . $Nome_doc)) {
            $sql = "INSERT INTO trabalho values(null, '$Titulo', '$Descricao', '$Data', '$Autor', '$Nome_doc', '$Link', '$Categoria')";
            $query = mysqli_query($conexao, $sql);
            
            echo "
                <script>
                alert ('Trabalho Adicionado');
                window.location = '../paginas/add_trabalho.php';
                </script>
            ";
        }else {
            die("Não foi possível enviar o arquivo, tente novamente");
        }
    }
}else{
    $Nome_doc = null;

    $sql = "INSERT INTO trabalho values(null, '$Titulo', '$Descricao', '$Data', '$Autor', '$Nome_doc', '$Link', '$Categoria')";
    $query = mysqli_query($conexao, $sql);
    
    echo "
        <script>
        alert ('Trabalho Adicionado');
        window.location = '../paginas/trabalhos.php';
        </script>
    ";
}
?>
