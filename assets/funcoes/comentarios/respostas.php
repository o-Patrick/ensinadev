<?php
	function resposta($conexao, $responderComentario) {
		try {
			$comando = $conexao->prepare("SELECT TBU.NOME_USUARIO,TBC.TEXTO_COMENTARIO_USUARIO FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_USUARIO AS TBU ON TBC.ID_USUARIO = TBU.ID_USUARIO WHERE TBC.ID_COMENTARIO_USUARIO = ?");
			$comando->bindParam(1, $responderComentario);

			if ($comando->execute()) {
				if ($comando->rowCount() > 0) {
					$linha = $comando->fetch(PDO::FETCH_OBJ);
					$nome = $linha->NOME_USUARIO;
					$texto = $linha->TEXTO_COMENTARIO_USUARIO;

					echo "<div class='original'>";
					echo   "<a href='#comentario$responderComentario'>";
					echo     "<p><strong>Resposta a $nome:</strong> " . substr($texto, 0, 30) . "... </p>";
					echo   "</a>";
					echo "</div>";
				}
			} else {
				throw new PDOException("Erro: não foi possível executar o comando.");
			} // execute

		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
		} // try/catch
	} // function
?>
