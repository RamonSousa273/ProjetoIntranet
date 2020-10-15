<?php
$fundo = rand(1,5);

if (isset($_COOKIE['login2'])) {
  include_once("conexao.php");
  $email = $_COOKIE['login2'];
  $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  $sql2 = $conn->query($sql) or die($conn->error);
  $dado = $sql2->fetch_array();
    if (is_array($dado)) {
	  session_start();
      $_SESSION['lusuario']=$dado;
      ?>
      <script type="text/javascript">
        window.location.href = "home.php";
      </script>
      <?php

    }
}
session_start();
 ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Via Expressa Intranet - Login</title>

    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Estilos customizados para esse template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="container">
    <div class="login">
    <form class="form-signin" action="processa.php" method="post">
      <img class="mb-4" src="img/via.png" alt="" width="150" height="150">
      <h1 class="h3 mb-3 font-weight-normal">Fa&ccedil;a login</h1>
      <label for="inputEmail" class="sr-only">Endere&ccedil;o de email</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Seu email" required autofocus>
      <br>
	  <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
    </div>
    </div>
  </body>
</html>
