function ajaxFeed() {
	const id = document.querySelector('#btnVerMais').value;
	alert(id);

	$.ajax({
		url: '../../assets/funcoes/acesso/perfil/mostra-feed.php',
		type: 'post',
		data: id,

		success: function(response) {
			$('#containerComentarios').append(response);
		} // success
	}) // function
}
