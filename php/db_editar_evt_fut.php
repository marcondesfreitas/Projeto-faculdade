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

$new_name_ft = str_replace("&lsquo;", "", $list['Nome']); 

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

$new_name_ft = str_replace($letra_a, "a", $new_name_ft);
$new_name_ft = str_replace($letra_A, "A", $new_name_ft);
$new_name_ft = str_replace($letra_o, "o", $new_name_ft);
$new_name_ft = str_replace($letra_O, "O", $new_name_ft);
$new_name_ft = str_replace($letra_e, "e", $new_name_ft);
$new_name_ft = str_replace($letra_E, "E", $new_name_ft);
$new_name_ft = str_replace($letra_u, "u", $new_name_ft);
$new_name_ft = str_replace($letra_U, "U", $new_name_ft);
$new_name_ft = str_replace($letra_c, "c", $new_name_ft);
$new_name_ft = str_replace($letra_C, "C", $new_name_ft);
$new_name_ft = str_replace($letra_i, "i", $new_name_ft);
$new_name_ft = str_replace($letra_I, "I", $new_name_ft);

$GLOBALS['id_membro'] = $list['Id'];
$GLOBALS['nome_evt'] = $new_name_ft;
$GLOBALS['foto_tipo'] = $list['Fotos'];


if(array_key_exists('button', $_POST)){
    button();
}
function button(){
    $Nome = $_POST['nome'];
    $Desc = $_POST['desc'];
    $Link = $_POST['link'];
    $Data = $_POST['data'];
    $Foto = $_FILES['foto']['tmp_name'];
    $tamanho = $_FILES['foto']['size'];

    $Nome = str_replace("'", "&lsquo;", $Nome);

    if($_FILES['foto']['tmp_name'] == true){
        if(unlink('../imagens/eventos_futuros/'.$GLOBALS['nome_evt'].$GLOBALS['foto_tipo'])){
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
            $new_name = str_replace("&lsquo;", "", $new_name); 


            $dir = '../imagens/eventos_futuros/';
            move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name);
        }

        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE notificar_eventos SET Id = ".$GLOBALS['id_membro'].", Nome = '$Nome', `Fotos` = '$ext', Descricao = '$Desc', Link_forms = '$Link', Data = '$Data', Valido = '0'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);

        echo "
            <script>
            alert ('Evento Editado');
            window.location = '../paginas/eventos.php';
            </script>
        ";

        
    }else{
        $new_name = str_replace("&lsquo;", "", $Nome); 

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

        rename("../imagens/eventos_futuros/".$GLOBALS['nome_evt'].$GLOBALS['foto_tipo']."","../imagens/eventos_futuros/".$new_name.$GLOBALS['foto_tipo']."");
    
        $ext = $GLOBALS['foto_tipo'];
        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE notificar_eventos SET Id = ".$GLOBALS['id_membro'].", Nome = '$Nome', `Fotos` = '$ext', Descricao = '$Desc', Link_forms = '$Link', Data = '$Data', Valido = '0'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);
        
        echo "
            <script>
            alert ('Evento Editado');
            window.location = '../paginas/eventos.php';
            </script>
        ";
    }

    
    echo "
        <script>
            alert ('Evento Mantido');
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
    <link rel="stylesheet" href="../css/edit_material.css">
    <title>Editar Evento</title>
</head>
<body>
    <div class="tela">
        <fieldset class="field">
            <h1>Editar Evento</h1>
            <br>
            <form method="post" enctype="multipart/form-data">
                <label class="lab" style="color: black;">Nome</label>
                <br>
                <input type="text" name="nome" id="nome" placeholder="Nome" class="titulo" value="<?php echo $list['Nome'];?>">
                <br>
                <label class="lab" style="color: black;">Descrição</label>
                <br>
                <input type="text" name="desc" id="cargo" placeholder="Cargo" class="autor" value="<?php echo $list['Descricao'];?>">
                <br>
                <label class="lab" style="color: black;">Link</label>
                <br>
                <input type="text" name="link" id="link" placeholder="Link" class="link" value="<?php echo $list['Link_forms'];?>">
                <br>
                <label class="lab" style="color: black;">Data</label>
                <br>
                <input type="date" name="data" id="link" placeholder="Link" class="link" value="<?php echo $list['Data'];?>">
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"><br>
                <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                <p>Substituir Foto</p>
                <input type="file" name="foto" id="arquivo" accept=".gif, .jpg. jpeg, .png"><br>

                <input type="button" id="btn" value="Exibir Foto Atual" onclick="view()">
                <br>
                <br>

                <input type="submit" class="btn" name="button" value="Editar">
            </form>
        </fieldset>
    </div>
    <div class="doc_view">  
        <img id="doc" src="../imagens/eventos_futuros/<?php echo $new_name_ft.$list["Fotos"];?>"
        style="display: none; width:100px; height:100px; position: relative; top: -200px;" frameborder="2" class="painel">
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