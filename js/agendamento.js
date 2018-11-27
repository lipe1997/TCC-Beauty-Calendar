$('.formAgenda').submit(function (e) {
    var form = $(this);
    var url = form.attr('action');
    //Usando ajax para chamar a pagina php especifica e passa o method que as informações estão indo
    $.ajax({
        url: url,
        type: 'POST',
        data: $('.formAgenda').serialize(),
        //função caso tudo ocorra normalmente
        success: function (data) {
            alert(data);
        }
    });
    // return false para a pagina não ser atualizada
    e.preventDefault();
});
function hr(selecionado) {
        $.ajax({
            url: "infoServico.php",
            type: "POST",
            dataType: 'json',
            data: { selecionado: selecionado },
            success: function (dados) {
                var initialHora = new Date(1900, 0, 1, dados["inicio"].split(":")[0], dados["inicio"].split(":")[1]);
                var finalHora = new Date(1900, 0, 1, dados["fim"].split(":")[0], dados["fim"].split(":")[1]);
                var duracao = new Date(1900, 0, 1, dados["duracao"].split(":")[0], dados["duracao"].split(":")[1]);
                //var tempo = ((parseInt(horasFinal) * 60) - (parseInt(horasInicio) * 60)) / 30;
                var inicial = (parseInt(initialHora.getHours()) * 60 + parseInt(initialHora.getMinutes()));
                var final = (parseInt(finalHora.getHours()) * 60 + parseInt(finalHora.getMinutes()));
                var duracao = (parseInt(duracao.getHours()) * 60 + parseInt(duracao.getMinutes()));
                var tempo = (final - inicial) / duracao;
                var achado = "lala";
                if(dados["achado"] != ""){
                    achado = dados["achado"]; 
                }
                $("#horariosDisponiveis").remove();
                var select = $("<select/>", {
                    class: 'browser-default',
                    id:'horariosDisponiveis',
                    name:"hrSelecionada"
                })
                for (i = 0; i < tempo; i++) {
                    initialHora.setMinutes(initialHora.getMinutes() + duracao)
                    if (finalHora.getHours() <= initialHora.getHours() && finalHora.getMinutes() < initialHora.getMinutes()) {
                        break;
                    }
                    else {
                         if(achado != "lala"){
                            var convertido = new Date(1900, 0, 1, achado.split(":")[0], achado.split(":")[1]);
                            if(initialHora.getHours() == convertido.getHours() && convertido.getMinutes() == initialHora.getMinutes()){
                                console.log("");
                            }
                            else {
                                
                                var option = $("<option/>", {
                                    value: initialHora.getHours() + ":" + initialHora.getMinutes(),
                                    text: initialHora.getHours() + ":" + initialHora.getMinutes(),
                                })
                                select.append(option);
                            }
                         }
                         else{
                            var option = $("<option/>", {
                                value: initialHora.getHours() + ":" + initialHora.getMinutes(),
                                text: initialHora.getHours() + ":" + initialHora.getMinutes(),
                            })
                            select.append(option);
                         }
                        
                    }

                }
                $(".select").append(select);

            }
        })
    }