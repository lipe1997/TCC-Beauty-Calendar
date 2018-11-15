var info = new Array();
info["nome"] = '';
info["celular"] = '';
info["cpf"] = '';
info["logradouro"] = '';
info["bairro"] = '';
info["uf"] = '';
info["cidade"] = '';
info["numero"] = '';
info["complemento"] = '';


function PegarInfo() {
    console.log("AQUIII");
    $.ajax({
        url: "pegarInfo.php",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $(".nomeBanco").remove();
            $(".celularBanco").remove();
            $(".cpfBanco").remove();
            $(".logradouroBanco").remove();
            $(".bairroBanco").remove();
            $(".ufBanco").remove();
            $(".cidadeBanco").remove();
            $(".numeroBanco").remove();
            $(".complementoBanco").remove();
            info["nome"] = data["nome"];
            info["celular"] = data["celular"];
            info["cpf"] = data["cpf"];
            info["logradouro"] = data["logradouro"];
            info["bairro"] = data["bairro"];
            info["uf"] = data["uf"];
            info["cidade"] = data["cidade"];
            info["numero"] = data["numero"];
            info["complemento"] = data["complemento"];
            $("#imgPerfil").attr("src", data["imgPerfil"]);
            $("#imgFundo").attr("src", data["imgFundo"]);
            $(".nome").text(data["nome"]);
            $(".name").text(data["nome"]);
            var estado = data["cidade"] + " - " + data["uf"];
            $(".estado").text(estado);
            var tdNome = $("<td/>", {
                class: "nomeBanco",
                text: info["nome"]
            })
            $("tr.nomeTb").append(tdNome);
            var tdCelular = $("<td/>", {
                class: "celularBanco",
                text: info["celular"]
            })
            $("tr.celular").append(tdCelular);
            var tdCpf = $("<td/>", {
                class: "cpfBanco",
                text: info["cpf"]
            })
            $("tr.cpf").append(tdCpf);
            var tdLogradouro = $("<td/>", {
                class: "logradouroBanco",
                text: info["logradouro"]
            })
            $("tr.logradouro").append(tdLogradouro);
            var tdBairro = $("<td/>", {
                class: "bairroBanco",
                text: info["bairro"]
            })
            $("tr.bairro").append(tdBairro);
            var tdUf = $("<td/>", {
                class: "ufBanco",
                text: info["uf"]
            })
            $("tr.uf").append(tdUf);
            var tdCidade = $("<td/>", {
                class: "cidadeBanco",
                text: info["cidade"]
            })
            $("tr.cidade").append(tdCidade);
            var tdNumero = $("<td/>", {
                class: "numeroBanco",
                text: info["numero"]
            })
            $("tr.numero").append(tdNumero);
            var tdComplemento = $("<td/>", {
                class: "complementoBanco",
                text: info["complemento"]
            })
            $("tr.complemento").append(tdComplemento);
            $("input#nome1").val(info["nome"]);
            $("input#celular1").val(info["celular"]);
            $("input#cpf1").val(info["cpf"]);
            $("input#logradouro1").val(info["logradouro"]);
            $("input#bairro1").val(info["bairro"]);
            $("input#cidade1").val(info["cidade"]);
            $("input#numero1").val(info["numero"]);
            $("input#complemento1").val(info["complemento"]);
        }
    });
    return false;
}

