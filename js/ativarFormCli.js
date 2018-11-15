//Plugin JQuery que submete o formulario do cliente e não deixa a pagina atualizar
$('.formularioCli').submit(function (e) {
    //Usando ajax para chamar a pagina php especifica e passa o method que as informações estão indo
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: $('.formularioCli').serialize(),
        // função caso tudo ocorra normalmente
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
    // return false para a pagina não ser atualizada
    e.preventDefault();
});