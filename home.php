<?php
    require_once 'db_connect.php';

    session_start();

    //Verificação para não ir á uma página restrita através do link
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    //dados usuario
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    /* Executa toda uma consulta no bd e armazena em dados*/
    $resultado = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_array($resultado);

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Olá <?php echo $dados['nome']; ?></h1>
        <a href="logout.php">Sair</a>
        <footer>Feito por Edson Jr</footer>
    </body>
</html>