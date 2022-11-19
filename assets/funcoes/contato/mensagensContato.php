<?php
	try {
		if (!isset($_POST["btn"])) $btn = ""; else $btn = $_POST["btn"];

		if ($btn === "") require "../../../../assets/funcoes/conexao.php"; else require "../conexao.php";

		echo "<div style='display:flex;'>";
		if ($btn <> "mais") echo "<button type='button' name='btnVerMais' class='btnSubmit' id='btnSubmit' onclick=verMais()>Ver mais</button>";
		echo   "<button type='button' name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnSubmit' onclick=verMenos()>Ver menos</button>";
		echo "</div>";

		if ($btn === "" || $btn  === "menos") {
			$comando = $conexao -> prepare ("SELECT * FROM TB_CONTATO WHERE RESPONDIDO_CONTATO = 0 ORDER BY ID_CONTATO LIMIT 3");
		} else {
			$comando = $conexao -> prepare ("SELECT * FROM TB_CONTATO WHERE RESPONDIDO_CONTATO = 0 ORDER BY ID_CONTATO");
		}

		if($comando -> execute()) {
			if ($comando -> rowCount() > 0) {
				while ($linha = $comando -> fetch(PDO::FETCH_OBJ)){
					$idMensagem = $linha -> ID_CONTATO;

					echo "<form action='../../../../assets/funcoes/contato/admContato.php' method='post' class='comentario'>";
					echo   "<input type='text' style='display:none;' name='idMensagem' value='" . $idMensagem . "' readonly />";
					echo 	 "<div class='usuario'>";
					echo 		 "<div class='emailUsuario'>";
					echo 			 "<p>" . $linha -> EMAIL_CONTATO . "</p>";
					echo 		 "</div>";
					echo 	 "</div>";
					echo 	 "<textarea name='pergunta' readonly>";
					echo 		 $linha -> TEXTO_CONTATO;
					echo   "</textarea>";
					echo   "<br/>";
					echo	 "<div>";
					echo       "<button type='submit' name='btnSubmit' class='btnSubmit' id='btnSubmit' value='btnExcluir'>Excluir</button>";
					echo       "<button type='submit' name='btnSubmit' class='btnSubmit' id='btnSubmit' value='btnResponder'>Responder</button>";
					echo	 "</div>";
					echo "</form>";
				} // if while

				if ($btn === "mais") echo "<button type='button' name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnSubmit' onclick=verMenos()>Ver menos</button>";
			} else {
				echo "<p style='text-align:center;'>Nenhuma mensagem restante!</p>";
			}// if rowCount
		} else {
			throw new PDOException("Erro: não foi possível executar o comando.");
		} // if execute
	} catch (PDOException $erro) {
		echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
		echo "<script>alert(document.querySelector('#erro').innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/areaAdm/perguntasContato.php'>";
	} // try/catch
?>
