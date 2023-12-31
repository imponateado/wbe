<?php
    require 'sqlconnection.php';

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
