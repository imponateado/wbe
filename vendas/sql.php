<?php
    // Configuração do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "brasiltemper";

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $codigo = $_GET["codigo"];
    $vendedor = $_GET["vendedor"];
    $observacao = $_GET["observacao"];

    $sql = "INSERT INTO historico (codigo, vendedor, observacao) VALUES ('$codigo', '$vendedor', '$observacao')";

    if($conn->query($sql) === TRUE) {
        echo "Registrado com sucesso";
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }

    $conn->close();
?>
