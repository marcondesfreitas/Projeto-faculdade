<?php
include_once '../php/db_connect.php';

$url = $_SERVER["REQUEST_URI"];
$id = parse_url($url, PHP_URL_QUERY);

$sql = "SELECT * FROM registrar_eventos WHERE Id = '$id'";
$query= mysqli_query($conexao, $sql);
$total = mysqli_num_rows($query);
$list = mysqli_fetch_array($query);

$data = (substr($list["Data_evento"], -2))."/".(substr($list["Data_evento"], -5, -3))."/".(substr($list["Data_evento"], -10, -6));

$sql_img = "SELECT * FROM img_evento WHERE Id_evento = '$id'";
$query_img = mysqli_query($conexao, $sql_img);
$total_img = mysqli_num_rows($query_img);

$new_name_foto = $list['Titulo']; 
 
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
    <link rel="stylesheet" href="../css/style_ver_evento.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $list['Titulo'];?></title>
</head>
<body>
    <section>
        <header class="menunormal" id="header">
            <div class="menu">
                <ul>
                    <span style="display: none;" id="span">evt</span>
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
            <img src="../imagens/registro_eventos/<?php echo $new_name_foto;?>/fundo_<?php echo $new_name_foto.$list['Foto_fundo'];?>" alt="" class="ft1" id="ft1">
        </div>
        <article>
            <div class="tit">
                <h1><?php echo $list['Titulo']?></h1>
            </div>
            <div class="dataevt">
                <p>Data do Evento: <?php echo $data?></p>
            </div>
            <div class="texto">
                <p><?php echo $list['Texto']?></p>
            </div>
            <div class="imgs">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <?php
                                if($total_img > 0){
                                    for($j = 1; $j < $total_img; $j++){
                            ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $j;?>"></li>
                            <?php    
                                    }
                                }
                            ?>
                    </ol>
                    <?php
                        $n = 0;
                        if($total_img > 0){
                            while($valor = mysqli_fetch_array($query_img)){
                                $n += 1;
                                    if($n == 1){
                                        echo '
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="../imagens/registro_eventos/'.$new_name_foto.'/'.$new_name_foto.'_1'.$valor['Foto_nome'].'" alt="First slide">
                                                </div>
                                        ';
                                    }
                                    if($n != 1){     
                            
                    ?>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="../imagens/registro_eventos/<?php echo $new_name_foto?>/<?php echo $new_name_foto?>_<?php echo $n?><?php echo $valor['Foto_nome']?>">
                                </div>
                    <?php
                                        $save = $valor['Foto_nome'];
                                    }
                            }
                        }
                    ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
            </div>
            <br><br>
            <div class="afastar">

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

    <span id="tit_img" style="display:none"></span>
    <span id="titulo" style="display:none"></span>
    <script src="../js/header.js"></script>
    <script src="../js/script.js"></script> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>