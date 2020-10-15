<?php
include_once("conexao.php");
$dataHoje = date('Y-m-d');
$conta = 1;
session_start();
$user = $_SESSION['lusuario'];

if(is_array($user)){
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Via Expressa Intranet - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/teste.css">
	<style>
	body{
	background-image: url("img/t3.png");
	background-size: 100vw 100vh;
	}
	</style>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-secondary bg-secondary">
  <a class="navbar-brand" target="_blank" href="https://viaexpressa.com/">Via Expressa</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(página atual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="http://192.168.1.212/portal/">Intranet antiga</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="http://viaexpressaapp.com/glpi/">GLPI</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
          <?php if ($user['Tipo_Usuario'] == "Admin"): ?>
          <a class="dropdown-item" href="gerenciarUsuario.php">Gerenciar Usu&aacute;rio</a>
          <a class="dropdown-item" href="cadastrarUsuario.php">Cadastrar Usu&aacute;rio</a>
          <?php endif; ?>
          <?php if ($user['Tipo_Usuario'] == "Admin" || $user['not'] == 1): ?>
          <a class="dropdown-item" href="postarNoticia.php">Postar Not&iacute;cia</a>
          <a class="dropdown-item" href="relatorioNoticias.php">Relat&oacute;rio de not&iacute;cias</b></a>
          <a class="dropdown-item" href="editarNoticia.php">Editar Not&iacute;cia</a>
          <?php endif; ?>
          <?php if ($user['Tipo_Usuario'] == "Admin" || $user['RLNotas'] == 1): ?>
          <a class="dropdown-item" target="_blank" href="https://viaexpressaapp.com/appscanner/webviaexpressa/">Notas</a>
          <?php endif; ?>
          <?php if ($user['Tipo_Usuario'] == "Admin" || $user['RLPerformance'] == 1): ?>
          <a class="dropdown-item" target="_blank" href="http://192.168.1.219/PerformanceClienteTeste/">Performance</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="processa.php" method="post">
      <button class="btn btn-outline-light my-2 my-sm-0" name="sair" type="submit">Sair</button>
    </form>
  </div>
</nav>
    </header>
	<div class="all">
    <div class="ajustaTamanhoSlide">

      <h3>Noticias</h3>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <?php
        $sql="SELECT * FROM noticias ORDER BY id_noticia DESC";
        $sql2 = $conn->query($sql) or die($conn->error);
        while($dado = $sql2->fetch_array()){
          $dataBancoI=date('Y-m-d',strtotime($dado['dtInicio']));
          $dataBancoF=date('Y-m-d',strtotime($dado['dtFim']));
          if ($dataHoje >= $dataBancoI && $dataHoje <= $dataBancoF ) {
            ?><li data-target="#myCarousel" data-slide-to="<?php echo $conta; ?>"></li><?php
            $conta = $conta+1;
          }
        }
         ?>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <button type="button" class="btn btn-outline-primary btn-lg btn-block" name="button"><a href="psi.pdf" target="_blank"><img  src="css/img/seguranca2.jpg" alt="" style="width:100%;height:60vh;"></a></button>
		  <div class="carousel-caption d-none d-md-block">
			<p>Clique na imagem!</p>
		  </div>
        </div>

        <?php
        $sql="SELECT * FROM noticias ORDER BY id_noticia DESC";
        $sql2 = $conn->query($sql) or die($conn->error);
        while($dado = $sql2->fetch_array()){
          $dataBancoI=date('Y-m-d',strtotime($dado['dtInicio']));
          $dataBancoF=date('Y-m-d',strtotime($dado['dtFim']));
          if ($dataHoje >= $dataBancoI && $dataHoje <= $dataBancoF ) {
            if ($dado['imagemr'] == "") {
              $local = "img/news2.jpg";
            }else{
            $local = $dado['imagemr'];
          }
            ?><div class="carousel-item">
              <form class="" action="verNoticia.php" target="_top" method="post">
                <button type="submit" class="btn btn-outline-primary btn-lg btn-block" value="<?php echo $dado['id_noticia']; ?>" name="idNot"><img class="d-block w-100" src="<?php echo $local; ?>" style="width:600px;height:60vh;" alt=""></button>
				<?php if($dado['imagemr'] == ""){ ?>
				<div class="carousel-caption d-none d-md-block">
				<h3><?php echo $dado['titulo']; ?></h3>
				<p>Clique na imagem!</p>
				</div>
				<?php }else{
					?>
					<div class="carousel-caption d-none d-md-block">
					<p>Clique na imagem!</p>
					</div>
					<?php
				} ?>
              </form>
            </div><?php
          }
        }
         ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
      </a>
    </div>

    </div>
    <br>
	<div class="ajustaLocaisRamais">
<form class="" action="" method="post">
      <div class="input-group mb-3">

        <input type="text" class="form-control" placeholder="Buscar..." name="nom" aria-label="Recipient's username" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="OK" value="Enviar" id="button-addon2"><i class="fa fa-search"></i></button>
        </div>
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="Limpar" value="Limpar" id="button-addon2"><i class="fa fa-times"></i></button>
        </div>

      </div>
</form>
      <?php if (isset($_POST['OK'])) {
        ?>
        <div class="tab">


        <table class="table table-dark">
          <thead>
            <tr>
              <td>Nome</td>
              <td>Ramal</td>
            </tr>
          </thead>



          <tbody>
            <?php $nome1=$_POST['nom'];
            include_once("conexao.php");
            if (is_numeric($nome1)) {
              $sql="SELECT * FROM ramais   WHERE LOCATE('$nome1', ramal) order by nome asc";
              $sql2 = $conn->query($sql) or die($conn->error);
              while($dado = $sql2->fetch_array()){
              ?>
              <tr class="tr">
                <td title="Nome: <?php echo $dado['nome']; echo "\n"; ?>Email: <?php echo $dado['email']; echo "\n"; ?>Telefone:" class="td"><a href="#" onclick="alert('Nome: <?php echo $dado['nome']; ?>\nEmail: <?php echo $dado['email']; ?> \nTelefone: ')"><?php echo $dado['nome']; ?></a></td>
                <td title="Nome: <?php echo $dado['nome']; echo "\n"; ?>Email: <?php echo $dado['email']; echo "\n"; ?>Telefone:" ><?php echo $dado['ramal']; ?></td>
              </tr>
            <?php }
            }else{

            $sql="SELECT * FROM ramais   WHERE LOCATE('$nome1', nome) order by nome asc";
            $sql2 = $conn->query($sql) or die($conn->error);
            while($dado = $sql2->fetch_array()){
            ?>
            <tr class="tr">
              <td title="Nome: <?php echo $dado['nome']; echo "\n"; ?>Email: <?php echo $dado['email']; echo "\n"; ?>Telefone:" class="td"><a href="#" onclick="alert('Nome: <?php echo $dado['nome']; ?>\nEmail: <?php echo $dado['email']; ?> \nTelefone: ')"><?php echo $dado['nome']; ?></a></td>
              <td title="Nome: <?php echo $dado['nome']; echo "\n"; ?>Email: <?php echo $dado['email']; echo "\n"; ?>Telefone:" ><?php echo $dado['ramal']; ?></td>
            </tr>
          <?php }} ?>
          </tbody>

        </table>
        </div>
      <?php

    }else { ?>




    <table class="table table-dark">
      <thead>
        <tr>
          <td>Nome</td>
          <td>Ramal</td>
        </tr>
      </thead>



      <tbody id="tbody">
        <?php include_once("conexao.php");
        $sql="SELECT * FROM ramais order by nome asc";
        $sql2 = $conn->query($sql) or die($conn->error);
        while($dado = $sql2->fetch_array()){
        ?>
        <tr class="tr">
          <td title="Nome: <?php echo $dado['nome']; echo "\n"; ?>Email: <?php echo $dado['email']; echo "\n"; ?>Telefone:" class="td"><a href="#" onclick="alert('Nome: <?php echo $dado['nome']; ?>\nEmail: <?php echo $dado['email']; ?> \nTelefone: ')"><?php echo $dado['nome']; ?></a></td>
          <td title="Nome: <?php echo $dado['nome']; echo "\n"; ?>Email: <?php echo $dado['email']; echo "\n"; ?>Telefone:" class="td2"> <?php echo $dado['ramal']; ?> </td>

        </tr>
      <?php

    } ?>
      </tbody>
    </table>
  <?php } ?>
    </div>
	</div>

	<script>
	imagens = [ 't1.JPG',  't2.JPG',  't4.JPG',  'Foto.png', 't3.png' ];
	var i = 0;
	elBody = document.getElementsByTagName("body")[0];
	elBody.classList.add('corpo');
	setInterval( function() {
	elBody.style.backgroundImage = 'url(img/' + imagens[i] + ')';
	elBody.style.transition = 'all 3s ease';
		if ( i < 4 ) {
			i = i + 1;
		}else{
		i=0;
		}
	}, 7000);
	<?php $usuario = $_SESSION['lusuario']; ?>
</script>

  </body>
</html>
<?php }else{
	unset($_SESSION['lusuario']);
	setcookie('login', -1);
	?>
      <script type="text/javascript">
        window.location.href = "index.php";
      </script>
      <?php
} ?>
