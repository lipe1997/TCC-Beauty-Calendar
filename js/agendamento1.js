function hr(selecionado) {
    $.ajax({
        url: "infoServico.php",
        type: "POST",
        dataType: 'json',
        data: { selecionado: selecionado },
        success: function (dados) {
            console.log(dados);
        }
    })
}