<?php
include_once 'db_connect.php';

session_start();
session_destroy();

echo "
<script>
    alert ('Deslogado');
    window.location = '../index.php';
</script>
";
?>