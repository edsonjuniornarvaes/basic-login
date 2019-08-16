<?php
    //conexão com o banco de dados
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "sistemalogin";

    $conn = mysqli_connect($server, $user, $pass, $db);

    //verificar se existe erro
    if(mysqli_connect_error()) : 
        echo "Falha na Conexão: ".mysqli_connect_error();
    endif;