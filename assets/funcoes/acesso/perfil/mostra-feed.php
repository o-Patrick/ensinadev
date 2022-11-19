<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	function mostraFeed($btn = "") {
		if ($btn === "") require "./../../assets/funcoes/conexao.php"; else require "./../../conexao.php";
		if ($btn === "") require "./../../assets/funcoes/comentarios/respostas.php"; else require "./../../comentarios/respostas.php";

		try {
			if ($btn === "" || $btn  === "menos") {
				$comando = $conexao->prepare("SELECT * FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_USUARIO AS TBU ON TBC.ID_USUARIO = TBU.ID_USUARIO WHERE TBC.ID_USUARIO = ? ORDER BY TBC.ID_COMENTARIO_USUARIO DESC LIMIT 3");
				$comando->bindParam(1, $_SESSION["idUsuario"]);
			} else {
				$comando = $conexao->prepare("SELECT * FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_USUARIO AS TBU ON TBC.ID_USUARIO = TBU.ID_USUARIO WHERE TBC.ID_USUARIO = ? ORDER BY TBC.ID_COMENTARIO_USUARIO DESC");
				$comando->bindParam(1, $_SESSION["idUsuario"]);
			}

			if ($comando->execute()){
				if ($comando->rowCount() > 0){
					echo "<section id='containerComentarios'>";
					
					echo   "<div style='display:flex;'>";
						if ($btn <> "mais") echo "<button name='btnVerMais' class='btnSubmit' id='btnVerMais' onclick=verMais()>Ver mais</button>";
						echo     "<button name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnVerMenos' onclick=verMenos()>Ver menos</button>";
					echo   "</div>";
					while ($linha = $comando->fetch(PDO::FETCH_OBJ)){
						// armazena se o comentário atual é original ou resposta
						$responderComentario = $linha->RESPONDER_COMENTARIO_USUARIO;

						if ($responderComentario !== NULL) resposta($conexao, $responderComentario);

						echo "<div class='comentario'>";
						echo   "<div class='usuario'>";
						echo     "<a href='../../paginas/acesso/acessar-conta.php'>";
						echo       "<div class='iconeUsuario'>";
						if ($linha->IMAGEM_USUARIO !== null) {
							echo       "<img src='../../assets/img/$linha->IMAGEM_USUARIO' class='fotoPerfilPequena' />";
						} else {
							echo       "<img src='../../assets/img/padrao.jpg' class='fotoPerfilPequena' />";
						}
						echo       "</div>";
						echo     "</a>";
						echo   "</div>";
						echo "<p>$linha->TEXTO_COMENTARIO_USUARIO</p>";
						echo "</div>";
					} // while

					if ($btn === "mais") echo "<button name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnVerMenos' onclick=verMenos()>Ver menos</button>";

					echo "</section>";
				} else {
					echo "<p>Nenhum comentário feito!</p>";
				} // rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando");
			} // execute
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
		} // try/catch
	} // function

	// chama a função
	if (!isset($_POST["btn"])) mostraFeed(); else mostraFeed($_POST["btn"]);
?>
