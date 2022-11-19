function verMais() {
	$.ajax({
		url: '../../../assets/funcoes/acesso/adm-perfis/adm-carrega-perfis.php',
		type: 'post',
		data: {btn:'mais'},

		beforeSend: function() {
			$('#btnVerMais').append('...');
		} // beforeSend
	}) // ajax

	.done((resposta) => {
		$('.containerComentarios').empty();
		$('.containerComentarios').append(resposta);
	}) // done
} // function

function verMenos() {
	$.ajax({
		url: '../../../assets/funcoes/acesso/adm-perfis/adm-carrega-perfis.php',
		type: 'post',
		data: {btn:'menos'},

		beforeSend: function() {
			$('.btnVerMenos').append('...');
		} // beforeSend
	}) // ajax

	.done((resposta) => {
		$('.containerComentarios').empty();
		$('.containerComentarios').append(resposta);
	}) // done
} // function
