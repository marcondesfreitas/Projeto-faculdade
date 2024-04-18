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

$sql = "SELECT * FROM equipe WHERE Id = ".$id."";
$query= mysqli_query($conexao, $sql);
$list = mysqli_fetch_array($query);

$GLOBALS['id_membro'] = $list['Id'];
$GLOBALS['nome_antigo'] = $list['Nome'];
$GLOBALS['foto_tipo'] = $list['Foto-tipo'];


if(array_key_exists('button', $_POST)){
    button();
}
function button(){
    $Nome = $_POST['nome'];
    $Cargo = $_POST['cargo'];
    $Link = $_POST['link'];
    $Foto = $_FILES['foto']['tmp_name'];
    $tamanho = $_FILES['foto']['size'];

    $Nome = str_replace("'", "&lsquo;", $Nome);

    if($_FILES['foto']['tmp_name'] == true){
        if(unlink('../arquivos/membros_fotos/'.$GLOBALS['nome_antigo'].$GLOBALS['foto_tipo'])){
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

        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE equipe SET Id = ".$GLOBALS['id_membro'].", Nome = '$Nome', `Foto-tipo` = '$ext', Cargo = '$Cargo', Link = '$Link'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);

        echo "
            <script>
            alert ('Membro Editado');
            window.location = '../paginas/integrantes.php';
            </script>
        ";

        
    }else{
        rename("../arquivos/membros_fotos/".$GLOBALS['nome_antigo'].$GLOBALS['foto_tipo']."","../arquivos/membros_fotos/".$Nome.$GLOBALS['foto_tipo']."");
    
        $ext = $GLOBALS['foto_tipo'];
        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE equipe SET Id = ".$GLOBALS['id_membro'].", Nome = '$Nome', `Foto-tipo` = '$ext', Cargo = '$Cargo', Link = '$Link'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);
        
        echo "
            <script>
            alert ('Membro Editado');
            window.location = '../paginas/integrantes.php';
            </script>
        ";
    }

    
    echo "
        <script>
            alert ('Membro Mantido');
            window.location = '../paginas/integrantes.php';
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
    <link rel="stylesheet" href="../css/edit_material.css">
    <title>Editar Material</title>
</head>
<body>
    <div class="tela">
        <fieldset class="field">
            <h1>Editar Material</h1>
            <br>
            <form method="post" enctype="multipart/form-data">
                <label class="lab" style="color: black;">Nome</label>
                <br>
                <input type="text" name="nome" id="nome" placeholder="Nome" class="titulo" value="">
                <br>
                <label class="lab" style="color: black;">Cargo</label>
                <br>
                <input type="text" name="cargo" id="cargo" placeholder="Cargo" class="autor" value="">
                <br>
                <label class="lab" style="color: black;">Link</label>
                <br>
                <input type="text" name="link" id="link" placeholder="Link" class="link" value="">
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"><br>
                <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                <p>Substituir Foto</p>
                <input type="file" name="foto" id="arquivo" accept=".gif, .jpg. jpeg, .png"><br>

                <input type="button" id="btn" value="Exibir Foto Atual" onclick="view()">
                <br>

                <input type="submit" class="btn" name="button" value="Editar">
            </form>
        </fieldset>
    </div>
    <div class="doc_view" style="width: 30%; height: 60vh;">  
        <img id="doc" style="display: none; width: 300px; height: 300px; position: relative; top: -200px;" src="../arquivos/membros_fotos/<?php echo $list["Nome"].$list["Foto-tipo"];?>"
        style="width:10px; height:10px;" class="painel">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/edit_material.js"></script>
    <script>
        var nome = document.getElementById('nome');
        var cargo = document.getElementById('cargo');
        var link = document.getElementById('link');

        nome.value = "<?php echo $list['Nome'];?>";
        cargo.value = "<?php echo $list['Cargo'];?>";
        link.value = "<?php echo $list['Link'];?>";

    </script>
</body>
</html> 