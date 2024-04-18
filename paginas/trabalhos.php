<?php
include_once '../php/db_connect.php';

session_start();

if(isset($_POST['catg']) && $_POST['catg'] == "Todos"){
    $categoria = $_POST['catg'];
    $sql = "SELECT * FROM trabalho ORDER BY Data DESC";
    $query= mysqli_query($conexao, $sql);
    $total = mysqli_num_rows($query);
}else if(isset($_POST['catg'])){
    $categoria = $_POST['catg'];
    $sql = "SELECT * FROM trabalho where Categoria = '$categoria'  ORDER BY Data DESC";
    $query= mysqli_query($conexao, $sql);
    $total = mysqli_num_rows($query);
}else if(isset($_SESSION['Page']) and $_SESSION['Page'] == "trabalhos"){
    if($_SESSION['Pesquisa'] != null){
        $sql = $_SESSION['Pesquisa'];
        $query= mysqli_query($conexao, $sql);
        $total = mysqli_num_rows($query);
    }
}else{
    $categoria = null;
    $sql = "SELECT * FROM trabalho ORDER BY Data DESC";
    $query= mysqli_query($conexao, $sql);
    $total = mysqli_num_rows($query);
}

if(!isset($_SESSION['Adm'])){
    $_SESSION['Adm'] = false;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_trabalhos.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Trabalhos da Equipe</title>
</head>
<body>
    <section>
        <header id="n">
            <div class="menu">
                <ul>
                    <span style="display: none;" id="span">te</span>
                    <img src="../arquivos/logo.png" alt="" class="logo">
                    <a href="../index.php"><H1>GEENTE</H1></a>
                    <div id="lis_1">
                        <li><a href="integrantes.php" id="qs">Quem Somos?</a></li>
                        <li><a href="eventos.php" id="evt">Eventos</a></li>
                        <li><a href="trabalhos.php" id="te">Trabalhos da Equipe</a></li>
                        <li><a href="material.php" id="me">Materiais de Estudo</a></li>
                    </div>
                </ul>
            </div>
            <nav id="menu_mobile">
                <div id="menu__">
                    <ul id="back_menu">
                        <div id="lis"> 
                            <div id="links" class="links">
                            <button id="botao_desaparecer" onclick="desaparecer()"><img src="../imagens/hamburguer.svg" id="img_hamburguer2" alt=""></button>
                                <li><a href="integrantes.php" id="qs">Quem Somos?</a></li>
                                <li><a href="eventos.php" id="evt">Eventos</a></li>
                                <li><a href="trabalhos.php" id="te">Trabalhos da Equipe</a></li>
                                <li><a href="material.php" id="me">Materiais de Estudo</a></li>
                            </div>
                        </div>
                    </ul>   
                </div>  
                <button id="btn_hamburguer" onclick="aparecer()"><img src="../imagens/hamburguer.svg" id="img_hamburguer" alt=""></button>
            </nav>
            <hr class="subl" id="linhamenu">
        </header>
        <div class="fundo">
            <img src="../imagens/trabalhosimage.svg" class="ft1" id="ft1" draggable="false">
        </div>
        <div class="titulo" id="titulo">
            <img id="tit_img" src="../imagens/trabalhostexto.svg" alt=""  draggable="false">
            <div class="box"></div>
        </div>
        <article id="article">
            <div class="escopo">
                <div class="filtro">
                    <div class="barra">
                        <form action="../php/db_pesquisa.php" method="post">
                            <input type="text" onclick="barra()" id="barra" name="pesquisar" class="input" placeholder="Pesquisar">
                            <input type="text" name="page" value="trabalhos" style="display: none;">
                            <img src="../imagens/pesquisar.png" class="lupa" alt="">
                            <button class="pesquisar"></button>
                        </form>
                    </div>
                    <div class="categoria">
                        <select name="categoria" id="categoria" onclick="girar()">
                            <?php
                                if($categoria == null or $categoria == 'Todos'){
                                    echo '
                                        <option value="Todos">Todos</option>
                                        <option value="Artigo Científico">Artigos Científicos</option>
                                        <option value="Dissertação">Dissertações</option>
                                        <option value="Livro">Livros</option>
                                        <option value="Tese">Teses</option>
                                        <option value="Outros">Outros</option>
                                    ';
                                }else if($categoria == 'Artigo Científico'){
                                    echo '
                                        <option value="Artigo Científico">Artigos Científicos</option>
                                        <option value="Todos">Todos</option>
                                        <option value="Dissertação">Dissertações</option>
                                        <option value="Livro">Livros</option>
                                        <option value="Tese">Teses</option>
                                        <option value="Outros">Outros</option>
                                    ';
                                }else if($categoria == 'Dissertação'){
                                    echo '
                                        <option value="Dissertação">Dissertações</option>
                                        <option value="Todos">Todos</option>
                                        <option value="Artigo Científico">Artigos Científicos</option>
                                        <option value="Livro">Livros</option>
                                        <option value="Tese">Teses</option>
                                        <option value="Outros">Outros</option>
                                    ';
                                }else if($categoria == 'Livro'){
                                    echo '
                                        <option value="Livro">Livros</option>
                                        <option value="Todos">Todos</option>
                                        <option value="Artigo Científico">Artigos Científicos</option>
                                        <option value="Dissertação">Dissertações</option>
                                        <option value="Tese">Teses</option>
                                        <option value="Outros">Outros</option>
                                    ';
                                }else if($categoria == 'Tese'){
                                    echo '
                                        <option value="Tese">Teses</option>
                                        <option value="Todos">Todos</option>
                                        <option value="Artigo Científico">Artigos Científicos</option>
                                        <option value="Dissertação">Dissertações</option>
                                        <option value="Livro">Livros</option>
                                        <option value="Outros">Outros</option>
                                    ';
                                }
                                else if($categoria == 'Outros'){
                                    echo '
                                        <option value="Outros">Outros</option>
                                        <option value="Todos">Todos</option>
                                        <option value="Artigo Científico">Artigos Científicos</option>
                                        <option value="Dissertação">Dissertações</option>
                                        <option value="Livro">Livros</option>
                                        <option value="Tese">Teses</option>
                                    ';
                                }
                            ?>
                        </select>
                        <img src="../imagens/seta.png" alt="" class="seta_img" id="imgg">
                    </div>
                    <form action="" method="post" id="cat_form">
                        <input type="text" name="catg" value="" id="catg" style="display: none;">
                    </form>
                </div>
                <?php
                    if($_SESSION['Adm'] == true){
                        echo "
                            <style>
                                .subl {
                                    top: 47px;
                                }
                            </style>
                            <div class='add'>
                                <h5><a href='add_trabalho.php'>Adicionar Novo Trabalho de um Membro <span class='plus'>+</span></a></h5>
                            </div>
                        ";
                    }
                ?>
                <div class="corpo">
                    <?php
                        if($total > 0){
                            while($valor = mysqli_fetch_array($query)){ 
                                $data = "Ano: ".(substr($valor["Data"], -10, -6));
                                $Nome_doc = $valor["Nome_doc"];
                                
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
                    ?>
                                <div class="bloco">
                                    <div class="tit">
                                        <h2><?php echo $valor["Titulo"]; ?> </h2>
                                    </div>
                                    <div class="desc">
                                        <p><?php echo $valor["Descricao"]; ?></p>
                                    </div>
                                    <div class="buttons">
                                    <?php
                                    echo '<span id="afas"></span>';
                                        if($valor["Nome_doc"] != null){
                                            if(substr($valor["Nome_doc"], -4) == "docx" or substr($valor["Nome_doc"], -3) == "doc"){
                                                echo "<a id='doc' target='_blank' href='../php/documentos/trabalho/".$Nome_doc."'><button><p>Baixar Documentação &gt;</p></button></a>";
                                            }else{
                                                echo "<a id='doc' target='_blank' href='../php/documentos/trabalho/".$Nome_doc."'><button><p>Acessar Documentação &gt;</p></button></a>";
                                            }
                                        }
                                        if($valor['Link'] != ""){
                                            echo '<a target="_blank" id="link" href="'.$valor['Link'].'"><button><p>Ler mais &gt;</p></button></a>';
                                        }
                                    ?>
                                        
                                    </div>
                                    <div class="autor">
                                        <p><?php echo $valor["Autor"]; ?></p>
                                    </div>
                                    <div class="data">
                                        <p><?php echo $data; ?></p>
                                    </div>
                                    <?php
                                        if($_SESSION['Adm'] == true){
                                    ?>
                                        <div class="CRUD">
                                            <div class="editar">
                                                <a href="../php/db_editar_trabalho.php?<?php echo $valor["Id"];?>"><img src="../imagens/edit.svg" width="100%" height="100%"></a>
                                            </div>
                                            <div class="excluir">
                                                <a href="../php/db_excluir_trabalho.php?<?php echo $valor["Id"];?>"><img src="../imagens/trash.svg"></a>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                    <?php
                            }
                        }else{
                            echo'
                                <div class="mne">
                                    <h1>Material Não Encontrado!</h1>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
            <br><br>
            <div class="subir" id="subir">
                <img id="btn-voltar-topo" src="../imagens/up.png" width="5%" height="5%" draggable="false">
            </div>
            <br>    
            <br>
            <footer class="footer">
                <div class="fim">
                    <div class="coluna2">
                        <img src="../arquivos/logo.png" alt="" class="logo_2">
                        <hr class="linhafooter" id="hr2">
                    </div>
                    <div class="info" id="endereco">
                        <h3>Endereço</h3>
                        <p>UNIVERSIDADE ESTADUAL DO CEARÁ</p>
                        <p>Fátima, Fortaleza - CE</p>
                        <p>Av. Luciano Carneiro</p>
                        <p>N° 345</p>

                    </div>
                    <div class="info" id="contatos">
                        <h3>Contatos</h3>
                        <p>Email: geente@geentegrupo.com</p>
                    </div>
                    <div class="info" id="redes">
                        <h3>Redes</h3>
                        <div id="r_img">
                            <div class="face"><a href=""><img src="https://cdn-icons-png.flaticon.com/512/4701/4701482.png" alt=""></a></div>
                        </div>
                    </div>
                </div>
                <div class="bug">

                </div>
            </footer>
        </article>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/material.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/materia.js"></script>
    <script src="../js/script.js"></script> 
</body>
</html>