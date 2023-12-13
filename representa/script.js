document.getElementById("codigo").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        consultarCodigo();
    }
});

function consultarCodigo() {
    let codigo = document.getElementById("codigo").value;

    // Verifica se o campo código está preenchido
    if (codigo === "") {
        alert("Por favor, digite um código.");
        return;
    }

    // Faz uma requisição ao servidor PHP para obter os dados do banco de dados
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("resultado").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "consulta.php?codigo=" + codigo, true);
    xhr.send();
}

function triggerInsert() {
    let codigo = document.getElementById("codigo").value;
    let representante = document.getElementById("representante").value;
    let observacao = document.getElementById("observacao").value;

    if(codigo === "" && representante === "" && observacao === "") {
        alert("Algum dos campos, código, representante ou observação, está faltando.");
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "sql.php?codigo=" + codigo + "&representante=" + representante + "&observacao=" + observacao, true);
    xhr.send();
}