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

$new_name_past = str_replace("&lsquo;", "", $list['Titulo']); 

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

$new_name_past = str_replace($letra_a, "a", $new_name_past);
$new_name_past = str_replace($letra_A, "A", $new_name_past);
$new_name_past = str_replace($letra_o, "o", $new_name_past);
$new_name_past = str_replace($letra_O, "O", $new_name_past);
$new_name_past = str_replace($letra_e, "e", $new_name_past);
$new_name_past = str_replace($letra_E, "E", $new_name_past);
$new_name_past = str_replace($letra_u, "u", $new_name_past);
$new_name_past = str_replace($letra_U, "U", $new_name_past);
$new_name_past = str_replace($letra_c, "c", $new_name_past);
$new_name_past = str_replace($letra_C, "C", $new_name_past);
$new_name_past = str_replace($letra_i, "i", $new_name_past);
$new_name_past = str_replace($letra_I, "I", $new_name_past);

$GLOBALS['id_membro'] = $list['Id'];
$GLOBALS['nome_antigo'] = $new_name_past;
$GLOBALS['foto_tipo'] = $list['Foto_fundo'];


if(array_key_exists('button', $_POST)){
    button();
}
function button(){
    $sql_img = "SELECT * FROM img_evento WHERE Id_evento = ".$GLOBALS['id_membro']."";
    $query_img = mysqli_query($GLOBALS['conexao'], $sql_img);
    $total = mysqli_num_rows($query_img);

    $Nome = $_POST['nome'];
    $Desc = $_POST['desc'];
    $Data = $_POST['data'];
    $Foto = $_FILES['foto']['tmp_name'];
    $tamanho = $_FILES['foto']['size'];

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

    rename('../imagens/registro_eventos/'.$GLOBALS['nome_antigo'].'', '../imagens/registro_eventos/'.$new_name.'');
    rename('../imagens/registro_eventos/'.$new_name.'/fundo_'.$GLOBALS['nome_antigo'].$GLOBALS['foto_tipo'].'', '../imagens/registro_eventos/'.$new_name.'/fundo_'.$new_name.$GLOBALS['foto_tipo'].'');
    $i = 0;
    while($valor = mysqli_fetch_array($query_img)){
        $i = $i + 1;
        $ext = $valor['Foto_nome'];
        rename('../imagens/registro_eventos/'.$new_name.'/'.$GLOBALS['nome_antigo'].'_'.$i.$ext.'', '../imagens/registro_eventos/'.$new_name.'/'.$new_name.'_'.$i.$ext.'');
    }

    $fotos_del = $_FILES['fotos'];
    $fotos_add = $_FILES['news_fotos'];

    if($fotos_del['name'][0] != ""){
        $i = 0;
        while($valor = mysqli_fetch_array($query_img)){
            $i = $i + 1;
            $ext = $valor['Foto_nome'];
            if($ext == "jpeg"){
                unlink('../imagens/registro_eventos/'.$new_name.'/'.$new_name.'_'.$i.'.'.$ext.'');
            }else{
                unlink('../imagens/registro_eventos/'.$new_name.'/'.$new_name.'_'.$i.$ext.'');
            }
        }
        $sql_del = "DELETE FROM img_evento WHERE Id_evento = ".$GLOBALS['id_membro']."";
        $query_del = mysqli_query($GLOBALS['conexao'], $sql_del);

        $fotos = $_FILES['fotos'];
        $dir = '../imagens/registro_eventos/'.$new_name.'/';
        for ($cont = 0; $cont < count($fotos['name']); $cont++){
            $ext2 = strtolower(substr($fotos['name'][$cont],-4)); 
            $new_name_foto = str_replace("&lsquo;", "", $new_name)."_".($cont+1) .  $ext2;

            move_uploaded_file($fotos['tmp_name'][$cont], $dir.$new_name_foto);
            $sql_rgimg = "INSERT INTO img_evento values(null, '$ext2', ".$GLOBALS['id_membro'].")";
            $query_rgimg = mysqli_query($GLOBALS['conexao'], $sql_rgimg);
        }
    }
    if($fotos_add['name'][0] != ""){
        $fotos = $_FILES['news_fotos'];
        $dir = '../imagens/registro_eventos/'.$new_name.'/';

        $num = mysqli_num_rows($query_img);

        for ($cont = 0; $cont < count($fotos['name']); $cont++){
            
            $m = $num + $cont + 1;

            $ext2 = strtolower(substr($fotos['name'][$cont],-4)); 
            if($ext2 == "jpeg"){
                $ext2 = ".".$ext2;
            }
            $new_name_foto = str_replace("&lsquo;", "", $new_name)."_".($m) .  $ext2;

            move_uploaded_file($fotos['tmp_name'][$cont], $dir.$new_name_foto);
            $sql_rgimg = "INSERT INTO img_evento values(null, '$ext2', ".$GLOBALS['id_membro'].")";
            $query_rgimg = mysqli_query($GLOBALS['conexao'], $sql_rgimg);
        }
    }

    if($_FILES['foto']['tmp_name'] == true){
        if(unlink('../imagens/registro_eventos/'.$new_name.'/fundo_'.$new_name.$GLOBALS['foto_tipo'])){
            $ext = strtolower(substr($_FILES['foto']['name'],-4)); 
            if($ext == "jpeg"){
                $ext = ".".$ext;
            }
            $new_name_fundo = "fundo_".str_replace("&lsquo;", "", $Nome) . $ext; 

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

            $new_name_fundo = str_replace($letra_a, "a", $new_name_fundo);
            $new_name_fundo = str_replace($letra_A, "A", $new_name_fundo);
            $new_name_fundo = str_replace($letra_o, "o", $new_name_fundo);
            $new_name_fundo = str_replace($letra_O, "O", $new_name_fundo);
            $new_name_fundo = str_replace($letra_e, "e", $new_name_fundo);
            $new_name_fundo = str_replace($letra_E, "E", $new_name_fundo);
            $new_name_fundo = str_replace($letra_u, "u", $new_name_fundo);
            $new_name_fundo = str_replace($letra_U, "U", $new_name_fundo);
            $new_name_fundo = str_replace($letra_c, "c", $new_name_fundo);
            $new_name_fundo = str_replace($letra_C, "C", $new_name_fundo);
            $new_name_fundo = str_replace($letra_i, "i", $new_name_fundo);
            $new_name_fundo = str_replace($letra_I, "I", $new_name_fundo);


            $dir = '../imagens/registro_eventos/'.$new_name.'/';
            move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name_fundo);
        }

        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE registrar_eventos SET Id = ".$GLOBALS['id_membro'].", Titulo = '$Nome', `Foto_fundo` = '$ext', Texto = '$Desc', Data_evento = '$Data'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);

        echo "
            <script>
            alert ('Registro Editado');
            window.location = '../paginas/eventos.php';
            </script>
        ";

        
    }else{
        $ext = $GLOBALS['foto_tipo'];
        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE registrar_eventos SET Id = ".$GLOBALS['id_membro'].", Titulo = '$Nome', `Foto_fundo` = '$ext', Texto = '$Desc', Data_evento = '$Data'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);
        
        echo "
            <script>
            alert ('Registro Editado');
            window.location = '../paginas/eventos.php';
            </script>
        ";
    }

    echo "
        <script>
        alert ('Registro mantido');
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
    <title>Editar Registro de Evento</title>
</head>
<body>
    <div class="tela">
        <fieldset class="field">
            <h1>Editar Registro de Evento</h1>
            <br>
            <form method="post" enctype="multipart/form-data">
                <label class="lab" style="color: black;">Titulo</label>
                <br>
                <input type="text" name="nome" id="nome" placeholder="Nome" class="titulo" value="<?php echo $list['Titulo'];?>">
                <br>
                <label class="lab" style="color: black;">Descrição</label>
                <br>
                <textarea name="desc" id="cargo" class="descricao" cols="50" rows="20"><?php echo $list['Texto'];?></textarea>
                <br>
                <label class="lab2" style="color: black;">Data do Evento</label>
                <br>
                <input type="date" name="data" id="data" class="data" value="<?php echo $list['Data_evento'];?>">
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"><br>
                <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                <p>Mudar foto do Fundo</p>
                <input type="file" name="foto" id="arquivo" class="fund" accept=".gif, .jpg, .jpeg, .png">
                <br>
                <input type="button" id="btn" value="Exibir Foto do Fundo" onclick="view()">
                <br>
                <label class="lab2" style="color: black;">Mudar imagens registradas</label>
                <br>
                <br>
                <input type="file" name="fotos[]" multiple="multiple" id="arquivo" accept=".gif, .jpg, .jpeg, .png">
                <br>
                <label class="lab2" style="color: black;">Adicionar novas imagens</label>
                <br>
                <br>
                <input type="file" name="news_fotos[]" multiple="multiple" id="arquivo" accept=".gif, .jpg., .jpeg, .png">
                <br>
                <br>

                <input type="submit" class="btn" name="button" value="Editar">
            </form>
        </fieldset>
    </div>
    <div class="doc_view" style="3">  
        <img id="doc" style="display: none;" src="../imagens/registro_eventos/<?php echo $new_name_past."/fundo_".$new_name_past.$list["Foto_fundo"];?>"
        style="display: none; width: 300px; height: 300px; position: relative; top: -200px;" frameborder="2" class="painel">
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