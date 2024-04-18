<?php
include_once '../php/db_connect.php';

$sql = "SELECT * FROM equipe ORDER BY Nome ASC";
$query= mysqli_query($conexao, $sql);

$total = mysqli_num_rows($query);

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
    <link rel="stylesheet" href="../css/style_membros.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Quem Somos Nós</title>
</head>
<body>
    <section>
        <header>
            <div class="menu">
                <ul>
                    <span style="display: none;" id="span">qs</span>
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
        <div class="atras">
            <div class="fundo">
                <img src="../imagens/quemsomosimg.svg" alt="" class="ft1" id="ft1" draggable="false">
            </div>
            <div class="titulo" id="titulo">
                <img id="tit_img" src="../imagens/quemsomostxt.svg" alt=""  draggable="false">
                <div class="box"></div>
            </div>
        </div>
        <article>
            <?php
                if($_SESSION['Adm'] == true){
                    echo "
                        <style>
                            .subl {
                                top: 47px;
                            }
                        </style>
                        <div class='add'>
                            <h5><a href='add_membro.php'>Adicionar Novo Integrante <span class='plus'>+</span></a></h5>
                        </div>
                    ";
                }
            ?>
            <hr id="linha">
            <div class="historia">
                <h1>Nossa História</h1>
                <hr>
                <p>O GEENTE tem como objeto de pesquisa o texto enquanto concretização da linguagem nas diversas modalidades de realização e em diferentes práticas sociais. Com Beaugrande (1997), entende-se que os textos somente adquirem existência quando estão em processo, isto é, quando são parte do fenômeno sociocognitivo de construção de sentido por sujeitos situados. Admite-se assim que os textos excedem sua materialidade e se compõem de múltiplos sistemas de naturezas diversas. São eventos complexos que envolvem inclusive os sujeitos participantes da interação. Desenvolvendo pesquisa em Linguística Aplicada, o grupo vem produzindo trabalhos que contribuem para a compreensão dessa noção ampla, dinâmica e complexa de texto que constitui o foco dos estudos atuais da Linguística Textual. De modo particular, os últimos estudos têm voltado a atenção para a abordagem do texto no ensino de língua materna, tratando do conceito de metatexto didático, a forma discutida para nomear o evento textual no ensino.</p>
            </div>
            <div class="membros">
                <hr>
                <h1>Equipe</h1>
                <div class="corpo">
                    <?php
                    if($total > 0){
                        while($valor = mysqli_fetch_array($query)){
                            $Nome_img = $valor["Nome"];
                                
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

                            $Nome_img = str_replace($letra_a, "a", $Nome_img);
                            $Nome_img = str_replace($letra_A, "A", $Nome_img);
                            $Nome_img = str_replace($letra_o, "o", $Nome_img);
                            $Nome_img = str_replace($letra_O, "O", $Nome_img);
                            $Nome_img = str_replace($letra_e, "e", $Nome_img);
                            $Nome_img = str_replace($letra_E, "E", $Nome_img);
                            $Nome_img = str_replace($letra_u, "u", $Nome_img);
                            $Nome_img = str_replace($letra_U, "U", $Nome_img);
                            $Nome_img = str_replace($letra_c, "c", $Nome_img);
                            $Nome_img = str_replace($letra_C, "C", $Nome_img);
                            $Nome_img = str_replace($letra_i, "i", $Nome_img);
                            $Nome_img = str_replace($letra_I, "I", $Nome_img);
                    ?>
                            <div class="bloco">
                                <div class="foto">
                                    <?php echo '<img src="../arquivos/membros_fotos/'.str_replace("&lsquo;", "", $Nome_img).$valor["Foto-tipo"].'" />';?>
                                </div>
                                <div class="nome">
                                    <h2><?php echo $valor["Nome"]; ?> </h2>
                                </div>
                                <div class="cargo">
                                    <p><?php echo $valor["Cargo"]; ?></p>
                                </div>
                                <div class="link">
                                    <a target="_blank" href="<?php echo $valor['Link'] ?>"><button><p>Acessar Currículo</p></button></a>
                                </div>
                                <?php
                                    if($_SESSION['Adm'] == true){
                                ?>
                                    <div class="CRUD">
                                        <div class="editar">
                                            <a href="../php/db_editar_membro.php?<?php echo $valor["Id"];?>"><img src="../imagens/edit.svg"></a>
                                        </div>
                                        <div class="excluir">
                                            <a href="../php/db_excluir_membro.php?<?php echo $valor["Id"];?>"><img src="../imagens/trash.svg"></a>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <br><br>
            <div class="afastar">

            </div>
            <div class="subir" id="subir">
                <img id="btn-voltar-topo" src="../imagens/up.png" width="5%" height="5%" draggable="false">
            </div>
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
    <script src="../js/header.js"></script>
    <script src="../js/script.js"></script> 
    <script src="../js/material.js"></script>
</body>
</html>