<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brasiltemper";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém o código enviado via GET
$codigo = $_GET["codigo"];

// Query SQL para obter os dados do banco de dados
$sql = "SELECT * FROM cliente WHERE codigo = '$codigo'";
$result = $conn->query($sql);

// Exibe os resultados
if ($result->num_rows > 0) {
    echo "<br>";
    echo "<table border=1>";
        echo "<tr>";
            echo "<td>Nome</td>";
            echo "<td>Cidade</td>";
            echo "<td>Telefone</td>";
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["cidade"] . "</td>";
            echo "<td>" . $row["telefone"] . "</td>";
        echo "</tr>";
        }
    echo "</table>";
    
    echo '<br>';

    $hstQuery = "SELECT * FROM historico WHERE codigo = '$codigo'";
    $hstResult = $conn->query($hstQuery);

    echo "<table border=1>";
    echo "<tr>";
        echo "<td>Data</td>";
        echo "<td>Representante</td>";
        echo "<td>Observação</td>";
    echo "</tr>";

    while($row = $hstResult->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row["data"] . "</td>";
            echo "<td>" . $row["representante"] . "</td>";
            echo "<td>" . $row["observacao"] ."</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo '<br>';
    echo '<input type="text" readonly value="' . $codigo . '">';
    echo '
        <input type="text" name="representante" id="representante" placeholder="representante">
        <input type="text" name="observacao" id="observacao" placeholder="Observação">
        <button onclick="triggerInsert()">Gravar</button>
    ';

} else {
    echo "<br>Este cliente não existe.";
}


// Fecha a conexão com o banco de dados
$conn->close();
?>