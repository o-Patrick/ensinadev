function verMais() {
	$.ajax({
		url: '../../../../assets/funcoes/contato/mensagensContato.php',
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
		url: '../../../../assets/funcoes/contato/mensagensContato.php',
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
