<?php
session_start();
$usuario = $_SESSION['lusuario'];

if ($usuario['Tipo_Usuario']=="Admin" || $usuario['not'] == 1) {

include_once("conexao.php");
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$dtInicio = $_POST['dtInicio'];
$dtFim = $_POST['dtFim'];
if ($titulo != "" && $conteudo != "" && $dtInicio != "" && $dtFim != "") {
  // code...
  if (isset($_FILES['pic'])) {
    $sql="SELECT MAX(id_noticia) as id_noticia FROM noticias";
    $sql2 = $conn->query($sql) or die($conn->error);
    $dado = $sql2->fetch_assoc();
    $n = $dado['id_noticia']+1;

    $ext = strtolower(substr($_FILES['pic']['name'],-4));
    $new_name = "noticia" . $n . $ext;
    $dir = "img/up/";
    move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$new_name);

    $local = "img/up/" . $new_name;

    $conteudo = $textoTrocado = str_ireplace("imagem1","$local","$conteudo");

  }
  if (isset($_FILES['pic2'])) {
    $sql="SELECT MAX(id_noticia) as id_noticia FROM noticias";
    $sql2 = $conn->query($sql) or die($conn->error);
    $dado = $sql2->fetch_assoc();
    $n = $dado['id_noticia']+1;

    $ext = strtolower(substr($_FILES['pic2']['name'],-4));
    $new_name = "noticia2" . $n . $ext;
    $dir = "img/up/";
    move_uploaded_file($_FILES['pic2']['tmp_name'], $dir.$new_name);

    $local2 = "img/up/" . $new_name;

    $conteudo = $textoTrocado = str_ireplace("imagem2","$local2","$conteudo");

  }
  if (isset($_FILES['pic3'])) {
    $sql="SELECT MAX(id_noticia) as id_noticia FROM noticias";
    $sql2 = $conn->query($sql) or die($conn->error);
    $dado = $sql2->fetch_assoc();
    $n = $dado['id_noticia']+1;

    $ext = strtolower(substr($_FILES['pic3']['name'],-4));
    $new_name = "noticia3" . $n . $ext;
    $dir = "img/up/";
    move_uploaded_file($_FILES['pic3']['tmp_name'], $dir.$new_name);

    $local3 = "img/up/" . $new_name;

    $conteudo = $textoTrocado = str_ireplace("imagem3","$local3","$conteudo");

  }
  if (isset($_FILES['picr'])) {
    $sql="SELECT MAX(id_noticia) as id_noticia FROM noticias";
    $sql2 = $conn->query($sql) or die($conn->error);
    $dado = $sql2->fetch_assoc();
    $n = $dado['id_noticia']+1;

    $ext = strtolower(substr($_FILES['picr']['name'],-4));
    $new_name = "noticiar" . $n . $ext;
    $dir = "img/up/";
    move_uploaded_file($_FILES['picr']['tmp_name'], $dir.$new_name);
    if ($_FILES['picr']['error'] == 4) {
      $local4 = "";
    }else{
    $local4 = "img/up/" . $new_name;
}
  }
$sql="INSERT INTO noticias(titulo, conteudo, dtInicio, dtFim, imagem1, imagem2, imagem3, imagemr) VALUES ('$titulo', '$conteudo', '$dtInicio', '$dtFim', '$local', '$local2', '$local3', '$local4')";
$grava = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <script type="text/javascript">
    alert("Noticia Postada!");
      window.location.href = "home.php";
    </script>
  </body>
</html>
<?php
}
else {
  $_SESSION['guardaNoticia'] = array('titulo' => $titulo, 'conteudo' => $conteudo);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <script type="text/javascript">
    alert("Faltam dados");
      window.location.href = "postarNoticia.php";
    </script>
  </body>

</html>
<?php
} }?>
