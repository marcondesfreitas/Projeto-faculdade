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

$nome = $_POST['nome'];
$desc = $_POST['descricao'];
$data = $_POST['data'];
$foto = $_FILES['foto']['tmp_name'];
$tamanho = $_FILES['foto']['size'];
$link = $_POST['link'];

$nome = str_replace("'", "&lsquo;", $nome);

if(isset($_FILES['foto']))
{
   $ext = strtolower(substr($_FILES['foto']['name'],-4)); 
   $new_name = str_replace("&lsquo;", "", $nome) . $ext; 

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

   $new_name = str_replace($letra_a, "a", $new_name);
   $new_name = str_replace($letra_A, "A", $new_name);
   $new_name = str_replace($letra_o, "o", $new_name);
   $new_name = str_replace($letra_O, "O", $new_name);
   $new_name = str_replace($letra_e, "e", $new_name);
   $new_name = str_replace($letra_E, "E", $new_name);
   $new_name = str_replace($letra_u, "u", $new_name);
   $new_name = str_replace($letra_U, "U", $new_name);
   $new_name = str_replace($letra_c, "c", $new_name);
   $new_name = str_replace($letra_C, "C", $new_name);
   $new_name = str_replace($letra_i, "i", $new_name);
   $new_name = str_replace($letra_I, "I", $new_name);

   $dir = '../imagens/eventos_futuros/';
   move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name);
} 

$sql = "INSERT INTO notificar_eventos values(null, '$nome', '$desc', '$link', '$ext', '$data', 1)";
$query = mysqli_query($conexao, $sql);

echo "
    <script>
    alert ('Evento Notificado');
    window.location = '../paginas/eventos.php';
    </script>
";
?>