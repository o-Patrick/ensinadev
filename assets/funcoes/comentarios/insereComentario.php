<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	require "../conexao.php";

	if(!isset($_SESSION["idUsuario"])){
		echo "<script>alert('Você precisa estar logado para comentar!')</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
	} elseif(isset($_POST["btnSubmit"])){
		if(isset($_POST["campoComentario"])) $campoComentario = $_POST["campoComentario"];

		// if testando se aquele comentário é comum ou resposta (no segundo caso, existe um session com o id do original)
		if (!isset($_SESSION["idResponder"])) {
			// insere o comentário normalmente
			try{
				$comando = $conexao->prepare("INSERT INTO TB_COMENTARIO_USUARIO VALUES (DEFAULT, NOW(), ?, null, ?, ?)");
				$comando->bindParam(1, $campoComentario);
				$comando->bindParam(2, $_SESSION["item"]);
				$comando->bindParam(3, $_SESSION["idUsuario"]);

				if($comando->execute()){
					if($comando->rowCount() > 0){
						echo "<script>alert('Comentário enviado com sucesso!')</script>";
					} else {
						echo "<script>alert('Erro ao enviar comentário! Se o problema persistir, fale conosco em Contato no menu')</script>";
					} // if rowCount
				} else {
					throw new PDOException("Erro: não foi possível executar o comando!");
				} // if execute
			} catch(PDOException $erro) {
				echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			} // try/catch
		} else {
			// insere o comentário como resposta
			try{
				$comando = $conexao->prepare("INSERT INTO TB_COMENTARIO_USUARIO VALUES (DEFAULT, NOW(), ?, ?, ?, ?)");
				$comando->bindParam(1, $campoComentario);
				$comando->bindParam(2, $_SESSION["idResponder"]);
				$comando->bindParam(3, $_SESSION["item"]);
				$comando->bindParam(4, $_SESSION["idUsuario"]);

				if($comando->execute()){
					if($comando->rowCount() > 0){
						require "../cria-notificacao.php";

						echo "<script>alert('Resposta enviada com sucesso!')</script>";
					} else {
						echo "<script>alert('Erro ao responder comentário! Se o problema persistir, fale conosco em Contato')</script>";
					} // if rowCount
				} else {
					throw new PDOException("Erro: não foi possível executar o comando!");
				} // if execute
			} catch(PDOException $erro) {
				echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			} // try/catch

			unset($campoComentario);
			unset($_SESSION["idResponder"]);
		} // if !isset idResponder

		echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
	} // if isset btnSubmit
?>
