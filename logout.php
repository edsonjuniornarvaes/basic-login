<?php
//Encerrar a Sessão
session_start(); //Primeiro inicia a sessão
session_unset(); //Depois limpa a sessão
session_destroy(); //Depois destrói a sessão

//redirecionar o usuario
header('Location: index.php');
