<?php
include_once '../php/db_connect.php';

$sql = "SELECT * FROM notificar_eventos";
$query = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($query);

$hj = date('d/m/Y');
$hoje = DateTime::createFromFormat('d/m/Y', $hj);

if($total > 0){
    while($valor = mysqli_fetch_array($query)){
        $d = (substr($valor["Data"], -2))."/".(substr($valor["Data"], -5, -3))."/".(substr($valor["Data"], -10, -6));
        $data = DateTime::createFromFormat('d/m/Y', $d);

        if($hoje > $data){
            $sql_update = "UPDATE notificar_eventos set Valido='0' WHERE Id = ".$valor['Id']."";
            $query_update = mysqli_query($conexao, $sql_update);
        }else{
            $sql_update = "UPDATE notificar_eventos set Valido='1' WHERE Id = ".$valor['Id']."";
            $query_update = mysqli_query($conexao, $sql_update);
        }

    }
}

$sql_notificar_val = "SELECT * FROM notificar_eventos WHERE Valido = 1 ORDER BY Data DESC";
$query_not_val= mysqli_query($conexao, $sql_notificar_val);
$total_not_val = mysqli_num_rows($query_not_val);

$sql_notificar = "SELECT * FROM notificar_eventos WHERE Valido = 0 ORDER BY Data DESC";
$query_not= mysqli_query($conexao, $sql_notificar);
$total_not = mysqli_num_rows($query_not);

$sql_reg = "SELECT * FROM registrar_eventos ORDER BY Data_evento DESC";
$query_reg= mysqli_query($conexao, $sql_reg);
$total_reg = mysqli_num_rows($query_reg);

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
    <link rel="stylesheet" href="../css/style_eventos.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Eventos</title>
</head>
<body>
    <section>
        <header>
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
            <img src="../imagens/eventosimage.svg" width="100%" draggable="false">
        </div>
        <div class="titulo" id="titulo">
            <img id="tit_img" src="../imagens/eventostexto.svg" alt="" draggable="false">
            <div class="box"></div>
        </div>
        <article>
            <div class="corpo" id="evento_futuros_validos">
            <?php
                if($_SESSION['Adm'] == true){
                    echo "
                        <div class='add'>
                            <h5><a href='add_eventos.php'>Adicionar Novo Evento <span class='plus'>+</span></a></h5>
                        </div>
                    ";
                }
            ?>
                <h1>Eventos Futuros</h1>
                    <?php
                        if($total_not_val > 0){
                            while($valor = mysqli_fetch_array($query_not_val)){ 
                                $data = (substr($valor["Data"], -2))."/".(substr($valor["Data"], -5, -3))."/".(substr($valor["Data"], -10, -6));
                                $new_name_foto = $valor['Nome']; 
 
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
                    
                    ?>
                                <div class="bloco">
                                    <div class="foto">
                                        <?php echo '<img src="../imagens/eventos_futuros/'.str_replace("&lsquo;", "", $new_name_foto).$valor["Fotos"].'" />';?>
                                    </div>
                                    <div class="dps_foto">
                                        <div class="tit">
                                            <h2><?php echo $valor["Nome"]; ?> </h2>
                                        </div>
                                        <div class="desc">
                                            <p><?php echo $valor["Descricao"]; ?></p>
                                        </div>
                                        <div class="link">
                                            <a  id="link" class="buttons" href="<?php echo $valor['Link_forms'];?>"><button><p>Se Inscrever No Evento</p></button></a>
                                        </div>
                                        <div class="data">
                                            <p>Data do Evento: <?php echo $data; ?></p>
                                        </div>
                                        <?php
                                            if($_SESSION['Adm'] == true){
                                        ?>
                                            <div class="CRUD">
                                                <div class="editar">
                                                    <a href="../php/db_editar_evt_fut.php?<?php echo $valor["Id"];?>"><img src="../imagens/edit.svg" width="100%" height="100%"></a>
                                                </div>
                                                <div class="excluir">
                                                    <a href="../php/db_excluir_evt_fut.php?<?php echo $valor["Id"];?>"><img src="../imagens/trash.svg"></a>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                    <?php
                            }
                        }else{
                            echo'
                                <div class="mne">
                                    <h1>Sem Eventos Futuros</h1>
                                </div>
                            ';
                        }
                    ?>
            </div>
            <hr id="separar" style="margin-top: 10%;">
            <div class="corpo" id="evento_registrados">
                <h1>Registro de Eventos</h1>
                    <?php
                        if($total_reg > 0){
                            while($valor = mysqli_fetch_array($query_reg)){ 
                                $data = (substr($valor["Data_evento"], -2))."/".(substr($valor["Data_evento"], -5, -3))."/".(substr($valor["Data_evento"], -10, -6));
                                $new_name_foto = $valor['Titulo']; 
 
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
                    ?>
                                <div class="bloco">
                                    <div class="foto">
                                        <?php echo '<img src="../imagens/registro_eventos/'.$new_name_foto.'/fundo_'.str_replace("&lsquo;", "", $new_name_foto).$valor["Foto_fundo"].'" />';?>
                                    </div>
                                    <div class="dps_foto">
                                        <div class="tit">
                                            <h2><?php echo $valor["Titulo"]; ?> </h2>
                                        </div>
                                        <div class="desc">
                                            <a  id="link" class="buttons" href="ver_evento.php?<?php echo $valor['Id'];?>"><button><p>Ver mais +</p></button></a>
                                        </div>
                                        <div class="data">
                                            <p>Data que ocorreu o Evento: <?php echo $data; ?></p>
                                        </div>
                                        <?php
                                            if($_SESSION['Adm'] == true){
                                        ?>
                                            <div class="CRUD">
                                                <div class="editar">
                                                    <a href="../php/db_editar_evt_reg.php?<?php echo $valor["Id"];?>"><img src="../imagens/edit.svg" width="100%" height="100%"></a>
                                                </div>
                                                <div class="excluir">
                                                    <a href="../php/db_excluir_evt_reg.php?<?php echo $valor["Id"];?>"><img src="../imagens/trash.svg"></a>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                    <?php
                            }
                        }else{
                            echo'
                                <div class="mne">
                                    <h1>Sem Registro de Eventos</h1>
                                </div>
                            ';
                        }
                    ?>
            </div>
            <br><br>
            <hr id="separar" style="margin-top: 3%;">
            <div class="corpo" id="evento_expirados">
                    <?php
                        if($total_not > 0){
                            echo '<h1>Eventos Expirados</h1>';
                            while($valor = mysqli_fetch_array($query_not)){ 
                                $data = (substr($valor["Data"], -2))."/".(substr($valor["Data"], -5, -3))."/".(substr($valor["Data"], -10, -6));
                                $new_name_foto = $valor['Nome']; 
 
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
                    
                    ?>
                                <div class="bloco">
                                    <div class="foto">
                                        <?php echo '<img class="grey" src="../imagens/eventos_futuros/'.str_replace("&lsquo;", "", $new_name_foto).$valor["Fotos"].'" />';?>
                                    </div>
                                    <div class="dps_foto">
                                        <div class="tit">
                                            <h2><?php echo $valor["Nome"]; ?> </h2>
                                        </div>
                                        <div class="tarja">
                                            <h1>Expirado</h1>
                                        </div>  
                                        <div class="data">
                                            <p>Data que ocorreu o Evento: <?php echo $data; ?></p>
                                        </div>
                                        <?php
                                            if($_SESSION['Adm'] == true){
                                        ?>
                                            <div class="CRUD">
                                                <div class="editar">
                                                    <a href="../php/db_editar_evt_fut.php?<?php echo $valor["Id"];?>"><img src="../imagens/edit.svg" width="100%" height="100%"></a>
                                                </div>
                                                <div class="excluir">
                                                    <a href="../php/db_excluir_evt_fut.php?<?php echo $valor["Id"];?>"><img src="../imagens/trash.svg"></a>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
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