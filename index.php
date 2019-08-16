<?php
    //Conexão
    require_once 'db_connect.php';

    //Sessão
    session_start();

    //Botão de Enviar
    if(isset($_POST['btn-entrar'])):
       $erros = array(); 

       //Filtrando inf... que vem dos inputs do login
       $login = mysqli_escape_string($conn, $_POST['login']);
       $senha = mysqli_escape_string($conn, $_POST['senha']);
        
       //Verificando se o campo está em brano
       if(empty($login) or empty($senha)) :
            $erros[] = "<li>O Campo Login/Senha precisa ser preenchido. </li>";
       else:
            //Verificar se já existe um usuário com o mesmo login
            $sql = "SELECT login FROM usuarios WHERE login = '$login' ";
            //Armazenar o resultado da consulta
            $resultado = mysqli_query($conn, $sql);

            //Se o número de linhas for maior do que zero é pq existe registro no bd 
            if(mysqli_num_rows($resultado) > 0):
                //Esse é o processo que criptografa a senha na hr de entrar, além de já ter feito isso no bd
                $senha = md5($senha);
                //Verificar se a senha confere com a que está no bd//
                $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha' ";
                $resultado = mysqli_query($conn, $sql);
                //Se existir 1 corrêspondência é pq a busca encontrou tudo ok
                if(mysqli_num_rows($resultado) == 1):
                //Conversão de resultado em array e atribuir a $dados
                  $dados = mysqli_fetch_array($resultado);
                  $_SESSION['logado'] = true;
                  $_SESSION['id_usuario'] = $dados['id'];
                  //redirecionar usuário
                  header('Location: home.php');
                else:
                    $erros[] = "<li>Usuário e senha não conferem </li>";
                endif;
            else:
                $erros[] = "<li>Funcionário Inexistente.</li>";
            endif;
       endif;

    endif;
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Login</h1>
        <!-- Verificar se $erros não está vazio, se não estiver é pq contem erros. -->
        <?php
            if(!empty($erros)):
                foreach($erros as $erro):
                    echo $erro;
                endforeach;
            endif;
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            Login: <input type="text" name="login"><br>
            Senha: <input type="password" name="senha">
            <button type="submit" name="btn-entrar">Entrar</button>
        </form>
    </body>
</html>