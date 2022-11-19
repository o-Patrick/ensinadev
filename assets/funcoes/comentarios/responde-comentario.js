function respondeComentario(btnResp) {
	$.ajax({
		url: '../../assets/funcoes/comentarios/responde-comentario.php',
		type: 'post',
		data: {idComentario:btnResp},

		success: (response) => {
			$('#comentarioOriginal').empty();
			$('#comentarioOriginal').append(response);
		} // success
	}) // ajax
} // function
