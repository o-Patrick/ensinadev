function verMais() {
	$.ajax({
		url: '../../assets/funcoes/comentarios/carregaComentarios.php',
		type: 'post',
		data: {btn:'mais'},

		beforeSend: function() {
			$('#btnVerMais').append('...');
		} // beforeSend
	}) // ajax

	.done((resposta) => {
		$('#mostraAjax').empty();
		$('#mostraAjax').append(resposta);
	}) // done
} // function

function verMenos() {
	$.ajax({
		url: '../../assets/funcoes/comentarios/carregaComentarios.php',
		type: 'post',
		data: {btn:'menos'},

		beforeSend: function() {
			$('.btnVerMenos').append('...');
		} // beforeSend
	}) // ajax

	.done((resposta) => {
		$('#mostraAjax').empty();
		$('#mostraAjax').append(resposta);
	}) // done
} // function
