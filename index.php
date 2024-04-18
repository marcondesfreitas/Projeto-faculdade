<?php
include_once 'php/db_connect.php';

$sql = "SELECT * FROM material ORDER BY Data DESC LIMIT 3";
$query= mysqli_query($conexao, $sql);

$total = mysqli_num_rows($query);
$hj = date('d/m/Y');
$hoje = DateTime::createFromFormat('d/m/Y', $hj);

session_start();

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
        <link rel="stylesheet" href="./css/style.css">
        <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
        <title>GEENTE</title>
    </head>

    <body>
        <header class="menunormal" id="header">
            <div class="menu">
                <ul>
                    <span style="display: none;" id="span">pi</span>
                    <img src="arquivos/logo.png" alt="" class="logo">
                    <a href="index.php"><H1>GEENTE</H1></a>
                    <div id="lis_1">
                        <li><a href="paginas/integrantes.php" id="qs">Quem Somos?</a></li>
                        <li><a href="paginas/eventos.php" id="evt">Eventos</a></li>
                        <li><a href="paginas/trabalhos.php" id="te">Trabalhos da Equipe</a></li>
                        <li><a href="paginas/material.php" id="me">Materiais de Estudo</a></li>
                    </div>
                </ul>
            </div>
            <nav id="menu_mobile">
                <div id="menu__">
                    <ul id="back_menu">
                        <div id="lis"> 
                            <div id="links" class="links">
                            <button id="botao_desaparecer" onclick="desaparecer()"><img src="./imagens/hamburguer.svg" id="img_hamburguer2" alt=""></button>
                                <li><a href="paginas/integrantes.php" id="qs">Quem Somos?</a></li>
                                <li><a href="paginas/eventos.php" id="evt">Eventos</a></li>
                                <li><a href="paginas/trabalhos.php" id="te">Trabalhos da Equipe</a></li>
                                <li><a href="paginas/material.php" id="me">Materiais de Estudo</a></li>
                            </div>
                        </div>
                    </ul>   
                </div>         
                <button id="btn_hamburguer" onclick="aparecer()"><img src="./imagens/hamburguer.svg" id="img_hamburguer" alt=""></button>
            </nav>
            <hr class="subl" id="linhamenu">
        </header>
        <div class="atras">
            <div class="fundo">
                <img src="imagens/indeximage.svg" alt="" class="ft1" id="ft1">
            </div>
            <div class="titulo" id="titulo">
                <img id="tit_img" src="imagens/indextexto.svg" alt="" draggable="false">
                <div class="box"></div>
            </div>
        </div>
        <div id="container">
            <article id="article">
                <?php   
                    if($_SESSION['Adm'] == true){
                        echo '
                            <div class="deslog">
                                <a href="php/db_deslogar.php">Deslogar</a>
                            </div>
                        ';
                    }
                ?>
                <div class="material">
                    <h1 id="h1po">Materiais Recentes</h1>
                    <hr id="traco"> 
                    <?php
                            if($total > 0){
                                while($valor = mysqli_fetch_array($query)){ 
                                    $d = (substr($valor["Data"], -2))."/".(substr($valor["Data"], -5, -3))."/".(substr($valor["Data"], -10, -6));
                                    $data = DateTime::createFromFormat('d/m/Y', $d);
                                    $diff = date_diff($data, $hoje);
                                    
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
                                        <hr>
                                        <div class="tit">
                                            <h2><?php echo $valor["Titulo"]; ?> </h2>
                                        </div>
                                        <div class="desc">
                                            <p><?php echo $valor["Descricao"]; ?></p>
                                        </div>
                                        <div class="buttons">
                                        <?php
                                            if($valor["Nome_doc"] != null){
                                                if(substr($valor["Nome_doc"], -4) == "docx" or substr($valor["Nome_doc"], -3) == "doc"){
                                                    echo "<a id='doc' target='_blank' href='php/documentos/".$Nome_doc."'><button><p>Baixar Documentação &gt;</p></button></a>";
                                                }else{
                                                    echo "<a id='doc' target='_blank' href='php/documentos/".$Nome_doc."'><button><p>Acessar Documentação &gt;</p></button></a>";
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
                                        <p><?php 
                                            $diferença = date_interval_format($diff, '%a');
                                            if($diferença == 0){
                                                echo "Hoje"; 
                                            }else if($diferença < 7 && $diferença > 0){
                                                echo "Postado há ".$diferença." dias";
                                            }else if($diferença < 14 && $diferença >= 7){
                                                echo "Postado há 1 semana";
                                            }else if($diferença < 21 && $diferença >= 14){
                                                echo "Postado há 2 semanas";
                                            }else if($diferença < 30 && $diferença >= 14){
                                                echo "Postado há 3 semanas";
                                            }else if($diferença >= 30 && $diferença < 360){
                                                if(intval($diferença/30) == 1){
                                                    echo "Postado há ".intval($diferença/30)." mês";
                                                }else{
                                                    echo "Postado há ".intval($diferença/30)." mêses";
                                                }
                                            }else if($diferença > 360){
                                                if(intval($diferença/360) == 1){
                                                    echo "Postado há ".intval($diferença/360)." ano";
                                                }else{
                                                    echo "Postado há ".intval($diferença/360)." anos";
                                                }
                                            }
                                        ?></p>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        ?>
                        <a id="vmt" href="paginas/material.php">Ver Todos os Materiais</a>
                        <br>
                        <br>
                        <br>
                </div>
                <footer class="footer">
                    <div class="fim">
                        <div class="coluna2">
                            <img src="arquivos/logo.png" alt="" class="logo_2">
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
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/header.js"></script>
    </body> 
</html>