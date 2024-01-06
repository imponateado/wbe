<?php
require 'sqlconnection.php';

// Obtém o código enviado via GET
$codigo = $_GET["codigo"];

// Query SQL para obter os dados do banco de dados
$sql = "SELECT * FROM cliente WHERE codigo = '$codigo'";
$result = $conn->query($sql);

// Exibe os resultados
if ($result->num_rows > 0) {
    /*
    echo "<br>";
    echo "<table border=1>";
        echo "<tr>";
            echo "<td>Cliente</td>"; // 1
            echo "<td>CPF/CNPJ</td>"; //2
            echo "<td>Endereco</td>"; //3
            echo "<td>Cidade</td>"; //4
            echo "<td>Telefone</td>"; //5
            echo "<td>Email</td>"; //6
            echo "<td>Data da última compra</td>"; //7
            echo "<td>Valor já comprado</td>"; //8
            echo "<td>Dias desde última compra</td>"; //9
        echo "</tr>";
        */
    echo
    '
    <br>
    <table border=1>
        <tr>
            <td colspan=10 style="text-align: center; font-size: 1.2rem;">Dados do cliente</td>
        </tr>
        <tr>
            <td>Cliente</td>
            <td>CPF/CNPJ</td>
            <td>Endereço</td>
            <td>Cidade</td>
            <td>Telefone</td>
            <td>E-mail</td>
            <td>Data da última compra</td>
            <td>Valor já comprado<td/>
            <td>Dias desde última compra</td>
        </tr>
    ';
        while($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>" . $row["nome"] . "</td>
            <td>" . $row["cpfCNPJ"] . "</td>
            <td>" . $row["endereco"] . "</td>
            <td>" . $row["cidade"] . "</td>
            <td>" . $row["telefone"] . "</td>
            <td>" . $row["e-mail"] . "</td>
            <td> " . (function($row) {
                $data_excel = $row["data"];
                $data_unix = ($data_excel - 25569) * 86400;
                return date("d/m/Y", $data_unix);
            })($row) ." </td>
            <td>R$ " . $row["ultCompra"] . "</td>
            <td> " . (function($row){
                $excelTimestamp = $row["data"];
                $excelStartDateUnix = strtotime('1900-01-01');
                $unixTimestamp = ($excelTimestamp - 25569) * 86400;
                $currentTimestamp = time();
                $daysOfDifference = floor(($currentTimestamp - $unixTimestamp) / 86400);
                return $daysOfDifference;
            })($row) . "</td>
        </tr>
        ";
        }
    echo "</table>";
    
    echo '<br>';

    $hstQuery = "SELECT * FROM historico WHERE codigo = '$codigo'";
    $hstResult = $conn->query($hstQuery);

    if($hstResult->num_rows > 0) {
        echo
        '<table border=1>
        <tr>
            <td>Data</td>
            <td>Vendedor</td>
            <td>Observação</td>
        </tr>
        ';
        while($row = $hstResult->fetch_assoc()) {
            echo 
            '
            <tr>
                <td>' . $row["data"] . '</td>
                <td>' . $row["vendedor"] . '</td>
                <td>' . $row["observacao"] . '</td>
            </tr>
            ';
        }
        echo '</table>';
    } else {
        echo '<br><table border="1"><tr><td>Cliente ainda não tem histórico</td></tr></table>';
    }

    echo '<br>';
    echo '
        <input type="text" readonly value="' . $codigo . '">
        <input type="text" name="vendedor" id="vendedor" placeholder="Vendedor">
        <input type="text" name="observacao" id="observacao" placeholder="Observação">
        <button onclick="triggerInsert(); consultarCodigo();">Gravar</button>
    ';

} else {
    echo '<br><table border="1"><tr><td>Este cliente não existe</td></tr></table>';
}


// Fecha a conexão com o banco de dados
$conn->close();
?>
