<?php
include_once 'db_connect.php';

session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM login";
$query = mysqli_query($conexao, $sql);
$row = mysqli_fetch_array($query);

if($email == $row['Email']){
    if($senha == $row['Senha']){
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Nome'] = $row['Nome'];
        $_SESSION['Adm'] = true;

        $_SESSION['verificacao'] = "nada";

        echo "
            <script>
                alert ('ADM Logado');
                window.location = '../index.php';
            </script>
        ";
    }else{
        $_SESSION['verificacao'] = "senha";
        echo "
            <script>
                window.location = '../paginas/login.php';
            </script>
        ";
    }
}else{
    $_SESSION['verificacao'] = "email";
    echo "
            <script>
                window.location = '../paginas/login.php';
            </script>
    ";
}
?>