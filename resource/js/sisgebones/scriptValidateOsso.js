$(document).ready(function(){
    $("#inputCodigo").mask("99.99.99.99.99");
});

$("#form-osso").validate({
    rules: {
        "nome" : "required",
        "codigo" : "required",
        "quantidade" : "required"
    },
    messages: {
        "nome" : "Preencha este campo com o nome de que está realizando um empréstimo",
        "código" : "Preencha este campo com o código do osso",
        "quantidade" : "Informe a quantidade de ossos da bandeja"
    }
});
