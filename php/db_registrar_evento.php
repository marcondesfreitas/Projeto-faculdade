<?php
include_once 'db_connect.php';

session_start();

$titulo = $_POST['tit'];
$data = $_POST['data_2'];
$texto = $_POST['texto'];
$foto_fundo = $_FILES['img_fundo']['tmp_name'];

$new_name_pasta = str_replace("&lsquo;", "", $titulo); 

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

$new_name_pasta = str_replace($letra_a, "a", $new_name_pasta);
$new_name_pasta = str_replace($letra_A, "A", $new_name_pasta);
$new_name_pasta = str_replace($letra_o, "o", $new_name_pasta);
$new_name_pasta = str_replace($letra_O, "O", $new_name_pasta);
$new_name_pasta = str_replace($letra_e, "e", $new_name_pasta);
$new_name_pasta = str_replace($letra_E, "E", $new_name_pasta);
$new_name_pasta = str_replace($letra_u, "u", $new_name_pasta);
$new_name_pasta = str_replace($letra_U, "U", $new_name_pasta);
$new_name_pasta = str_replace($letra_c, "c", $new_name_pasta);
$new_name_pasta = str_replace($letra_C, "C", $new_name_pasta);
$new_name_pasta = str_replace($letra_i, "i", $new_name_pasta);
$new_name_pasta = str_replace($letra_I, "I", $new_name_pasta);

$dir = "../imagens/registro_eventos/$new_name_pasta/";

mkdir($dir, 0755);

if(isset($_FILES['img_fundo'])){
   $ext = strtolower(substr($_FILES['img_fundo']['name'],-4)); 
   if($ext == "jpeg"){
        $ext = ".".$ext;
   }
   $new_name = "fundo_".str_replace("&lsquo;", "", $titulo) . $ext; 

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

   move_uploaded_file($_FILES['img_fundo']['tmp_name'], $dir.$new_name);
}

$texto = str_replace("'", "&#34;", $texto);

$sql = "INSERT INTO registrar_eventos values(null, '$titulo', '$texto', '$data', '$ext')";
$query = mysqli_query($conexao, $sql);

$sql_img = "SELECT * FROM registrar_eventos WHERE Titulo = '$titulo'";
$query_img = mysqli_query($conexao, $sql_img);
$list = mysqli_fetch_array($query_img);

$fotos = $_FILES['foto_2'];
var_dump($fotos);

for($cont = 0; $cont < count($fotos['name']); $cont++){
    $ext = strtolower(substr($fotos['name'][$cont],-4)); 
    if($ext == "jpeg"){
        $ext = ".".$ext;
    }
        $new_name_foto = str_replace("&lsquo;", "", $titulo)."_".($cont+1) . $ext;
 
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
 
    $new_name_foto = str_replace($letra_a, "a", $new_name_foto);
    $new_name_foto = str_replace($letra_A, "A", $new_name_foto);
    $new_name_foto = str_replace($letra_o, "o", $new_name_foto);
    $new_name_foto = str_replace($letra_O, "O", $new_name_foto);
    $new_name_foto = str_replace($letra_e, "e", $new_name_foto);
    $new_name_foto = str_replace($letra_E, "E", $new_name_foto);
    $new_name_foto = str_replace($letra_u, "u", $new_name_foto);
    $new_name_foto = str_replace($letra_U, "U", $new_name_foto);
    $new_name_foto = str_replace($letra_c, "c", $new_name_foto);
    $new_name_foto = str_replace($letra_C, "C", $new_name_foto);
    $new_name_foto = str_replace($letra_i, "i", $new_name_foto);
    $new_name_foto = str_replace($letra_I, "I", $new_name_foto);
 
    move_uploaded_file($fotos['tmp_name'][$cont], $dir.$new_name_foto);

    $sql_rgimg = "INSERT INTO img_evento values(null, '$ext', ".$list['Id'].")";
    $query_rgimg = mysqli_query($conexao, $sql_rgimg);
}

echo "
    <script>
    alert ('Evento Registrado');
    window.location = '../paginas/eventos.php';
    </script>
";


?>