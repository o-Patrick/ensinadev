<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	require_once("./../conexao.php");

	if (isset($_POST["idComentario"])) {
		$_SESSION["idResponder"] = $_POST["idComentario"];
		$idComentario = $_SESSION["idResponder"];

		// pega o comentário a ser respondido
		try{
			$comando = $conexao->prepare("SELECT TBU.NOME_USUARIO, TBC.TEXTO_COMENTARIO_USUARIO FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_USUARIO AS TBU ON TBC.ID_USUARIO = TBU.ID_USUARIO JOIN TB_ITEM_TEMA AS TBI ON TBC.ID_ITEM_TEMA = TBI.ID_ITEM_TEMA WHERE TBC.ID_COMENTARIO_USUARIO = ?");
			$comando->bindParam(1, $idComentario);

			if($comando->execute()){
				if($comando->rowCount() > 0){
					$linha = $comando->fetch(PDO::FETCH_OBJ);
					echo "<script>
									const campoComentario = document.getElementById('campoComentario');
									campoComentario.focus();
								</script>";

					echo "<section class='containerFaq'>";
					echo   "<div class='acordeao'>";
					echo 	   "<button type='button' class='collapsible' id='responder'>Responder $linha->NOME_USUARIO</button>";
					echo 	  "<div class='content'>";
					echo 		  "<p>$linha->TEXTO_COMENTARIO_USUARIO</p>";
					echo 	  "</div>";
					echo   "</div>";
					echo "</section>";

					echo "<script>
									const coll = document.getElementsByClassName('collapsible');
						
									for (let i = 0; i < coll.length; i++) {
										coll[i].addEventListener('click', function() {
											this.classList.toggle('active');
											const content = this.nextElementSibling;
											if (content.style.maxHeight){
												content.style.maxHeight = null;
											} else {
												content.style.maxHeight = content.scrollHeight + 'px';
											} 
										});
									}
								</script>";

					echo "<script> console.log('Comentário selecionado com sucesso!') </script>";
				} else {
					echo "<script>alert('Erro ao selecionar comentário! Se o problema persistir, fale conosco em Contato no menu')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			} // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
		} // try/catch
	} // if isset post idComentario
?>
