<?php
session_start();
if (isset($_POST['email'])) {
  include_once("conexao.php");
  $email=$_POST['email'];
  $senha=md5($_POST['senha']);

  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $sql2 = $conn->query($sql) or die($conn->error);
  $dado = $sql2->fetch_array();
    if ($dado['id_usuario'] > 0) {
      $expira = time() + ( 60 * 60 * 24 * 30 );
      $_SESSION['lusuario']=$dado;
      $cookie = $dado['email'];
      setcookie('login2', $cookie, $expira);
      ?>
      <script type="text/javascript">
        window.location.href = "home.php";
      </script>
      <?php

    }
    else {
      ?>
        <script type="text/javascript">
          alert("Não Cadastrado.");
          window.location.href = "index.php";
        </script>
        <?php
    }
    }
if(isset($_POST["sair"])){
	unset($_SESSION['lusuario']);
	setcookie('login2', -1);
	?>
        <script type="text/javascript">
          window.location.href = "index.php";
        </script>
    <?php
}
if(isset($_POST['ajusta'])){
	include_once("conexao.php");
	$id = $_POST['ajusta'];
	$nome = $_POST['nome'];
	$email = $_POST['email2'];
	if(isset($_POST['senha'])){
	$senha = $_POST['senha'];
	$senha = md5($senha);
	}
	$tipo = $_POST['tipo'];
	$pf = $_POST['pf'];
	$nt = $_POST['nt'];
	$not = $_POST['not'];
	
	if($nome != ""){
		$sql = "UPDATE usuarios SET nome = '$nome' WHERE usuarios.id_usuario = '$id'";
		$sql=$conn->query($sql) or die($conn->error);
	}
	if($email != ""){
		$sql = "UPDATE usuarios SET email = '$email' WHERE usuarios.id_usuario = '$id'";
		$sql=$conn->query($sql) or die($conn->error);
	}
	if($senha != ""){
		$sql = "UPDATE usuarios SET senha = '$senha' WHERE usuarios.id_usuario = '$id'";
		$sql=$conn->query($sql) or die($conn->error);
	}
	if($tipo != ""){
		$sql = "UPDATE usuarios SET Tipo_Usuario = '$tipo' WHERE usuarios.id_usuario = '$id'";
		$sql=$conn->query($sql) or die($conn->error);
	}
	if($pf != ""){
		if($pf == "Sim"){
			$sql = "UPDATE usuarios SET RLPerformance = '1' WHERE usuarios.id_usuario = '$id'";
			$sql=$conn->query($sql) or die($conn->error);
		}
		if($pf == "Nao"){
			$sql = "UPDATE usuarios SET RLPerformance = '0' WHERE usuarios.id_usuario = '$id'";
			$sql=$conn->query($sql) or die($conn->error);
		}
		
	}
	if($nt != ""){
		if($nt == "Sim"){
			$sql = "UPDATE usuarios SET RLNotas = '1' WHERE usuarios.id_usuario = '$id'";
			$sql=$conn->query($sql) or die($conn->error);
		}
		if($nt == "Nao"){
			$sql = "UPDATE usuarios SET RLNotas = '0' WHERE usuarios.id_usuario = '$id'";
			$sql=$conn->query($sql) or die($conn->error);
		}
	}
	if($not != ""){
		if($nt == "Sim"){
			$sql = "UPDATE usuarios SET not = '1' WHERE usuarios.id_usuario = '$id'";
			$sql=$conn->query($sql) or die($conn->error);
		}
		if($nt == "Nao"){
			$sql = "UPDATE usuarios SET not = '0' WHERE usuarios.id_usuario = '$id'";
			$sql=$conn->query($sql) or die($conn->error);
		}
	}
	?>
        <script type="text/javascript">
			alert("Alterado com sucesso!");
          window.location.href = "index.php";
        </script>
    <?php
	
}

 ?>
