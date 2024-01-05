document.getElementById("codigo").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
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

    if (codigo === "") {
        alert("Por favor, digite um código.");
        return;
    }

    let url = window.location.href + "consulta.php?codigo=" + codigo;
    
    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.text();
    })
    .then(data => {
        document.getElementById("resultado").innerHTML = data;
    })
    .catch(function(err) {
        console.log("Fetch Error :-S", err);
    });
}

function triggerInsert() {
    let codigo = document.getElementById("codigo").value;
    let vendedor = document.getElementById("vendedor").value;
    let observacao = document.getElementById("observacao").value;

    if(codigo === "" && vendedor === "" && observacao === "") {
        alert("Algum dos campos, código, vendedor ou observação está faltando.");
        return;
    }

    let url = window.location.href + "insertData.php?codigo=" + codigo + "&vendedor=" + vendedor + "&observacao=" + observacao;

    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
    })
    .catch(function() {
        console.log("Fetch error :-S", err);
    });
}