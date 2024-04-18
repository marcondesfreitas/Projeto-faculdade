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

$sql_consul = "SELECT * FROM equipe";
$consulta = mysqli_query($conexao, $sql_consul);
$dados = mysqli_fetch_assoc($consulta);
$total = mysqli_num_rows($consulta);


$Nome = $_POST['nome'];
$Cargo = $_POST['cargo'];
$Link = $_POST['link'];
$Foto = $_FILES['foto']['tmp_name'];
$tamanho = $_FILES['foto']['size'];

$Nome = str_replace("'", "&lsquo;", $Nome);

if($total > 0){
    do{
        if($Nome == $dados['Nome']){
            echo "
                <script>
                    alert('Esse Membro já está Cadastrado!');
                    window.location = '../paginas/integrantes.php';
                </script>
            ";
            exit;
        }
    }while($dados = mysqli_fetch_assoc($consulta));
}
    
if(isset($_FILES['foto']))
{
   $ext = strtolower(substr($_FILES['foto']['name'],-4)); 
   $new_name = str_replace("&lsquo;", "", $Nome) . $ext; 

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

   $dir = '../arquivos/membros_fotos/';
   move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name);
} 

$sql = "INSERT INTO equipe values(null, '$Nome', '$ext', '$Cargo', '$Link')";
$query = mysqli_query($conexao, $sql);

echo "
    <script>
    alert ('Integrante Adicionado');
    window.location = '../paginas/integrantes.php';
    </script>
";
?>
