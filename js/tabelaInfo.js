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

$("window")
function tabela() {
	$(".editarInformacoes").css("display", "none");
	$(".tabela").css("display", "block");
	$.ajax({
		url: "pegarInfo.php",
		type: "POST",
		dataType: 'json',
		success: function (data) {
			$("#nome").remove();
			$("#celular").remove();
			$("#cpf").remove();
			$("#logradouro").remove();
			$("#bairro").remove();
			$("#uf").remove();
			$("#cidade").remove();
			$("#numero").remove();
			$("#complemento").remove();

			//Nome
			var tdNome = $("<td/>", {
				id: "nome",
			});
			tdNome.text(data["nome"]);
			$(".nome").append(tdNome);
			//Celular
			var tdCelular = $("<td/>", {
				id: "celular",
			});
			tdCelular.text(data["celular"]);
			$(".celular").append(tdCelular);
			//Cpf
			var tdCpf = $("<td/>", {
				id: "cpf",
			});
			tdCpf.text(data["cpf"]);
			$(".cpf").append(tdCpf);
			//Logradouro
			var tdLogradouro = $("<td/>", {
				id: "logradouro",
			});
			tdLogradouro.text(data["logradouro"]);
			$(".logradouro").append(tdLogradouro);
			//Bairro
			var tdBairro = $("<td/>", {
				id: "bairro",
			});
			tdBairro.text(data["bairro"]);
			$(".bairro").append(tdBairro);
			//Uf
			var tdUf = $("<td/>", {
				id: "uf",
			});
			tdUf.text(data["uf"]);
			$(".uf").append(tdUf);
			//Cidade
			var tdCidade = $("<td/>", {
				id: "cidade",
			});
			tdCidade.text(data["cidade"]);
			$(".cidade").append(tdCidade);
			//Número
			var tdNumero = $("<td/>", {
				id: "numero",
			});
			tdNumero.text(data["numero"]);
			$(".numero").append(tdNumero);
			//Complemento
			var tdComplemento = $("<td/>", {
				id: "complemento",
			});
			tdComplemento.text(data["complemento"]);
			$(".complemento").append(tdComplemento);
			info["nome"] = data["nome"];
			info["celular"] = data["celular"];
			info["cpf"] = data["cpf"];
			info["logradouro"] = data["logradouro"];
			info["bairro"] = data["bairro"];
			info["uf"] = data["uf"];
			info["cidade"] = data["cidade"];
			info["numero"] = data["numero"];
			info["complemento"] = data["complemento"];

		}
	});
	return false;
}
function btnEditar() {
	$(".tabela").css("display", "none");
	$(".editarInformacoes").css("display", "block");
	$("#nome1").val(info["nome"]);
	$("#celular1").val(info["celular"]);
	$("#cpf1").val(info["cpf"]);
	$("#logradouro1").val(info["logradouro"]);
	$("#bairro1").val(info["bairro"]);
	$("#cidade1").val(info["cidade"]);
	$("#numero1").val(info["numero"]);
	$("#complemento1").val(info["complemento"]);
}
function btnCancelar() {
	$(".tabela").css("display", "block");
	$(".editarInformacoes").css("display", "none");
}
$(".formEditar").submit(function () {
	
	$.ajax({
		url: "editCli.php",
		type: "POST",
		data: $('.formEditar').serialize(),
		success: function (data) {
			if (data == "Informações atualizadas com sucesso") {
				swal({
					type: 'success',
					title: 'Ok',
					text: data,
				})
				tabela();
			}
			else {
				swal({
					type: 'error',
					title: 'Oops...',
					text: data,
				})
			}
		}
	});
	return false;

})
$(".formImgFundo").submit(function () {
		var file_data = $('#file').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);                         
		$.ajax({
			url: 'editImgFundo.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			success: function (data) {
				if (data == "Imagem cadastrada com sucesso") {
					swal({
						type: 'success',
						title: 'Ok',
						text: data,
					})
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
$(window).on("load", function () {
	$.ajax({
		url: "pegarInfo.php",
		type: "POST",
		dataType: "json",
		success: function (data) {
			$(".imgFundo").attr("src", data['imgFundo']);
			$(".imgPerfil").attr("src", data['imgPerfil']);
			$(".nome").text(data['nome']);
			var cidade = data['cidade'] + " " + data['uf'];
			console.log(cidade);
			$(".cidade").text(cidade);
			var nome = data['nome'];

			$(".nomeUsuario").append(nome);
		}
	})
	return false;
})