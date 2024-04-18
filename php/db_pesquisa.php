<?php
include_once "db_connect.php";

if($_POST['page'] == "material"){
    $pesquisa = $_POST['pesquisar'];

    $sql = "SELECT * FROM material where Titulo like '%$pesquisa%' or Autor like '%$pesquisa%' ORDER BY Data DESC";
    $query= mysqli_query($conexao, $sql);
    
    if (!isset($_SESSION)) session_start();
    
    $_SESSION['Pesquisa'] = $sql;
    $_SESSION['Page'] = "material";

    echo "
        <script>
            window.location = '../paginas/material.php';
        </script>
    ";
}else if($_POST['page'] == "trabalhos"){
    $pesquisa = $_POST['pesquisar'];

    $sql = "SELECT * FROM trabalho where Titulo like '%$pesquisa%' or Autor like '%$pesquisa%' ORDER BY Data DESC";
    $query= mysqli_query($conexao, $sql);
    
    if (!isset($_SESSION)) session_start();
    
    $_SESSION['Pesquisa'] = $sql;
    $_SESSION['Page'] = "trabalhos";

    echo "
        <script>
            window.location = '../paginas/trabalhos.php';
        </script>
    ";
}




?>