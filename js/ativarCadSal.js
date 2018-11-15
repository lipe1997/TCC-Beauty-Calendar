//Plugin JQuery que submete o formulario do cliente e não deixa a pagina atualizar
$('.formularioSalao').submit(function (e) {
    //Usando ajax para chamar a pagina php especifica e passa o method que as informações estão indo
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: $('.formularioSalao').serialize(),
        // função caso tudo ocorra normalmente
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
    // return false para a pagina não ser atualizada
    e.preventDefault();
});