//Plugin JQuery que submete o formulario do cliente e não deixa a pagina atualizar
$('.formularioSalao').submit(function (e) {
    //Usando ajax para chamar a pagina php especifica e passa o method que as informações estão indo
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
                data: $('.formularioSalao').serialize(),
                //função caso tudo ocorra normalmente
                success: function (data) {
                    if (data != "Salão cadastrado com sucesso") {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: data,
                        })

                    }
                    else {

                        swal({
                            type: 'success',
                            title: 'OK',
                            text: data,
                            confirmButtonColor: '#600ab1',
                            confirmButtonText: 'OK',
                        })

                        window.location.replace("Home.shtml");

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
    // return false para a pagina não ser atualizada
    e.preventDefault();
});