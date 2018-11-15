$(".formLoginCliente").submit(function () {

    $.ajax({
        url: "loginC.php",
        type: "POST",
        data: $(".formLoginCliente").serialize(),
        success: function (data) {
            if (data == "Usuario encontrado com sucesso") {
                swal({
                    type: 'success',
                    title: 'Ok',
                    text: data,
                })
                window.location.replace("HomeLogado.shtml");
            }
            else {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: data,
                })
            }
        }
    })
    return false;
});