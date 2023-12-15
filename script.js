document.getElementById("codigo").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        consultarCodigo();
    }
});

document.body.addEventListener("keyup", function(event){
    if(event.key === "Enter") {
        if(document.activeElement.id === "observacao") {
            event.preventDefault();
            triggerInsert();
        }
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
    let vendedor = document.getElementById("vendedor").value;
    let observacao = document.getElementById("observacao").value;

    if(codigo === "" && vendedor === "" && observacao === "") {
        alert("Algum dos campos, código, vendedor ou observação, está faltando.");
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "sql.php?codigo=" + codigo + "&vendedor=" + vendedor + "&observacao=" + observacao, true);
    xhr.send();
}
