<?php
include_once '../php/db_connect.php';
session_start();


if(!isset($_SESSION['verificacao'])){
    $_SESSION['verificacao'] = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <header>

    </header>
    <article>
        <div class="forms">
            <fieldset class="fild">
                <h1>LOGIN</h1>
                <hr class="linha">

                <form action="../php/db_login.php" method="post">
                    <input type="text" name="email" placeholder="Email" id="email" class="input" onkeyup = "errado()" require>
                    <?php
                        if($_SESSION['verificacao'] == "email"){
                            echo "<span style='color: red;'>Email Incorreto</span>";
                            echo "<script>
                                var email = document.getElementById('email');

                                email.style.cssText = 'border: solid red 2px';

                                function errado(){
                                    if(email.value != ''){
                                        email.style.cssText = 'border: solid black 2px';
                                    }else{
                                        email.style.cssText = 'border: solid red 2px';
                                    }
                                }
                            </script>";
                        }
                    ?>
                    <br>
                    <input type="password" name="senha" placeholder="Senha" class="input" id="senha" onkeyup = "errado()" required>
                    <?php
                        if($_SESSION['verificacao'] == "senha"){
                            echo "<span style='color: red;'>Senha Incorreto</span>";
                            echo "<script>
                                var senha = document.getElementById('senha');

                                senha.style.cssText = 'border: solid red 2px';

                                function errado(){
                                    if(senha.value != ''){
                                        senha.style.cssText = 'border: solid black 2px';
                                    }else{
                                        senha.style.cssText = 'border: solid red 2px';
                                    }
                                }
                            </script>";
                        }
                    ?>
                    <br>
                    <input type="submit" value="Entrar" id="btn" class="btn"><br><br>
                </form>
            </fieldset>
        </div>
    </article>
</body>
</html>