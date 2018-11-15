//Plugin JQuery que submete o formulario do cliente e não deixa a pagina atualizar
$('.formularioCli').submit(function (e) {
    var form = $(this);
    var url = form.attr('action');

    $('#cpf1').cpfcnpj({
        mask: true,
        validate: 'cpfcnpj',
        event: 'click',
        //validateOnlyFocus: true,
        handler: '.submit',
        ifValid: function (input) {
            //Usando ajax para chamar a pagina php especifica e passa o method que as informações estão indo
            $.ajax({
                url: url,
                type: 'POST',
                data: $('.formularioCli').serialize(),
                //função caso tudo ocorra normalmente
                success: function (data) {
                    if (data != "Cliente cadastrado com sucesso") {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: data,
                        })
                    }
                    else {
                        window.location.replace("Home.shtml");
                        swal({
                            type: 'success',
                            title: 'OK',
                            text: data,
                        })

                    }

                }
            });

        },
        ifInvalid: function (input) {
            swal({
                type: 'error',
                title: 'Oopss',
                text: "CPF Inválido",
            })
        }
    });
    e.preventDefault();
});