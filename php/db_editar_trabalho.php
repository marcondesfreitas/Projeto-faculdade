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
$categoria = $list['Categoria'];

$GLOBALS['id_trabalho'] = $list['Id'];
$GLOBALS['doc_trabalho'] = $list['Nome_doc'];


if(array_key_exists('button', $_POST)){
    button();
}
function button(){
    $Titulo = $_POST['tit'];
    $Descricao = $_POST['desc'];
    $Data = $_POST['data'];
    $Autor = $_POST['autor'];
    $Link = $_POST['link'];
    $Categoria = $_POST['categoria'];
    $Documento = $_FILES['doc']['tmp_name'];
    $Nome_doc = $_FILES['doc']['name'];

    if(!isset($Nome_doc)){
        $Nome_doc = null;
    }

    if($Nome_doc != null){
        $_UP['pasta'] = 'documentos/trabalho/';
        $_UP['extensoes'] = array('pdf', 'doc');
        
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
        
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
                $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
                $sql_edit = "UPDATE trabalho SET Id = ".$GLOBALS['id_trabalho'].", Titulo = '$Titulo', Descricao = '$Descricao', Data = '$Data', Autor = '$Autor', Nome_doc = '$Nome_doc', Link = '$Link', Categoria = '$Categoria'  where Id = ".$id."";
                $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);
                
                unlink('documentos/trabalho/'.$GLOBALS['doc_trabalho']);

                echo "
                    <script>
                    alert ('Trabalho Editado');
                    window.location = '../paginas/trabalhos.php';
                    </script>
                ";
            }else {
                die("Não foi possível enviar o arquivo, tente novamente");
            }
        }
    }else{
        $Nome_doc = $GLOBALS['doc_trabalho'];
    
        $id = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        $sql_edit = "UPDATE trabalho SET Id = ".$GLOBALS['id_trabalho'].", Titulo = '$Titulo', Descricao = '$Descricao', Data = '$Data', Autor = '$Autor', Nome_doc = '$Nome_doc', Link = '$Link', Categoria = '$Categoria'  where Id = ".$id."";
        $query_edit = mysqli_query($GLOBALS["conexao"], $sql_edit);
        
        echo "
            <script>
            alert ('Trabalho Editado');
            window.location = '../paginas/trabalhos.php';
            </script>
        ";
    }

    
    echo "
        <script>
            alert ('Trabalho Mantido');
            window.location = '../paginas/trabalhos.php';
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
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Editar Trabalho</title>
</head>
<body>
    <div class="tela">
        <fieldset class="field">
            <h1>Editar Trabalho</h1>
            <br>
            <form method="post" enctype="multipart/form-data">
                <label class="lab" style="color: black;">Titulo</label>
                <br>
                <input type="text" name="tit" id="tit" placeholder="Titulo" class="titulo" value="<?php echo $list['Titulo'];?>">
                <br>
                <label class="lab" style="color: black;">Autor</label>
                <br>
                <input type="text" name="autor" id="autor" placeholder="autor" class="autor" value="<?php echo $list['Autor'];?>">
                <br>
                <label class="lab" style="color: black;">Link</label>
                <br>
                <input type="text" name="link" id="link" placeholder="Link" class="link" value="<?php echo $list['Link'];?>">
                <br>
                <label class="lab" style="color: black;">Data</label>
                <br>
                <input type="date" name="data" id="data" class="data" value="<?php echo $list['Data']?>">
                <br>
                <label class="lab" style="color: black;">Descrição</label>
                <br>
                <textarea name="desc" id="desc" id="desc" cols="24" rows="5" placeholder="descricao" class="descricao" value=""><?php echo $list['Descricao'];?></textarea><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"><br>
                <select name="categoria" id="categoria" onclick="girar()">
                    <?php
                        if($categoria == 'Artigo Científico'){
                            echo '
                                <option value="Artigo Científico">Artigo Científico</option>
                                <option value="Dissertação">Dissertação</option>
                                <option value="Livro">Livro</option>
                                <option value="Tese">Tese</option>
                                <option value="Outros">Outro</option>
                            ';
                        }else if($categoria == 'Dissertação'){
                            echo '
                                <option value="Dissertação">Dissertação</option>
                                <option value="Artigo Científico">Artigo Científico</option>
                                <option value="Livro">Livro</option>
                                <option value="Tese">Tese</option>
                                <option value="Outros">Outro</option>
                            ';
                        }else if($categoria == 'Livro'){
                            echo '
                                <option value="Livro">Livro</option>
                                <option value="Artigo Científico">Artigo Científico</option>
                                <option value="Dissertação">Dissertação</option>
                                <option value="Tese">Tese</option>
                                <option value="Outros">Outro</option>
                            ';
                        }else if($categoria == 'Tese'){
                            echo '
                                <option value="Tese">Tese</option>
                                <option value="Artigo Científico">Artigo Científico</option>
                                <option value="Dissertação">Dissertação</option>
                                <option value="Livro">Livro</option>
                                <option value="Outros">Outro</option>
                            ';
                        }else if($categoria == 'Outros'){
                            echo '
                                <option value="Outros">Outro</option>
                                <option value="Tese">Tese</option>
                                <option value="Artigo Científico">Artigo Científico</option>
                                <option value="Dissertação">Dissertação</option>
                                <option value="Livro">Livro</option>
                            ';
                        }
                    ?>
                </select>
                <br>
                <br>
                <label for="arquivo"><img src="../imagens/adicionar-botao.png" alt="" class="add"></label>
                <p>Substituir Documento</p>
                <input type="file" name="doc" id="arquivo" accept=".doc, .docx, .pdf"><br>

                <?php
                    if(substr($list["Nome_doc"], -4) == "docx" or substr($list["Nome_doc"], -3) == "doc"){
                        echo '
                            <button type="button" id="btn" class="ex"><a style="color: black; text-decoration: none;" href="http://localhost/faculdade/php/documentos/trabalho/'.$list["Nome_doc"].'">Baixar Documento</a></button>
                        ';
                    }else{
                        echo'
                            <input type="button" id="btn" value="Exibir Documento Atual" onclick="view()">
                        ';
                    }
                ?>
                <br>
                <br>

                <input type="submit" class="btn" name="button" value="Editar">
            </form>
        </fieldset>
    </div>
    <div class="doc_view" id="doc" style="display: none;">  
        <?php
            if(substr($list["Nome_doc"], -4) == "docx" or substr($list["Nome_doc"], -3) == "doc"){
                echo '
                    <button id="apagar" class="ex"><a style="color: white; text-decoration: none;" href="http://localhost/faculdade/php/documentos/'.$list["Nome_doc"].'">Baixar Documento</a></button>
                ';
            }else{
                echo'
                    <iframe src="http://localhost/faculdade/php/documentos/trabalho/'.$list["Nome_doc"].'"
                        style="width:400px; height:500px; position: relative; top: -200px;" frameborder="2" class="painel"></iframe>
                ';
            }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/edit_material.js"></script>
</body>
</html> 