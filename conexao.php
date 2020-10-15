<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "db13mysq1";
    $senha = "";
    $dbname = "projeto_portal";

    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    }else{
        //echo "Conexao realizada com sucesso";
    }
?>
