<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

	function carregaComentarios($btn = "") {
		if ($btn === "") {
			require "../../assets/funcoes/conexao.php";
			require "../../assets/funcoes/acesso/foto-perfil.php";
			require "../../assets/funcoes/comentarios/respostas.php";
		} else {
			require "../conexao.php";
			require "../acesso/foto-perfil.php";
			require "./respostas.php";
		}

		try {
			if ($btn == "" || $btn == "menos") {
				$comando = $conexao->prepare("SELECT TBU.ID_USUARIO, TBU.NOME_USUARIO, TBU.IMAGEM_USUARIO, TBC.ID_COMENTARIO_USUARIO, TBC.TEXTO_COMENTARIO_USUARIO, TBC.RESPONDER_COMENTARIO_USUARIO FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_USUARIO AS TBU ON TBC.ID_USUARIO = TBU.ID_USUARIO JOIN TB_ITEM_TEMA AS TBI ON TBC.ID_ITEM_TEMA = TBI.ID_ITEM_TEMA WHERE TBI.ID_ITEM_TEMA = ? ORDER BY ID_COMENTARIO_USUARIO DESC LIMIT 3");
				$comando->bindParam(1, $_SESSION["item"]);
			} else {
				$comando = $conexao->prepare("SELECT TBU.ID_USUARIO, TBU.NOME_USUARIO, TBU.IMAGEM_USUARIO, TBC.ID_COMENTARIO_USUARIO, TBC.TEXTO_COMENTARIO_USUARIO, TBC.RESPONDER_COMENTARIO_USUARIO FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_USUARIO AS TBU ON TBC.ID_USUARIO = TBU.ID_USUARIO JOIN TB_ITEM_TEMA AS TBI ON TBC.ID_ITEM_TEMA = TBI.ID_ITEM_TEMA WHERE TBI.ID_ITEM_TEMA = ? ORDER BY ID_COMENTARIO_USUARIO DESC");
				$comando->bindParam(1, $_SESSION["item"]);
			}

			// carrega os comentários
			if ($comando->execute()) {
				if ($comando->rowCount() > 0) {
					echo "<div id='mostraAjax'>";
					echo   "<div style='display:flex;'>";
					echo     "<button type='submit' name='btnVerMais' class='btnSubmit' id='btnVerMais' onclick='verMais()'>Ver tudo</button>";
					echo     "<button type='submit' name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnVerMenos' onclick='verMenos()'>Ver menos</button>";
					echo   "</div>";

					while($linha = $comando->fetch(PDO::FETCH_OBJ)){
						// armazena se o comentário atual é original ou resposta
						$responderComentario = $linha->RESPONDER_COMENTARIO_USUARIO;
						// armazena o id do comentário
						$idComentario = $linha->ID_COMENTARIO_USUARIO;

						if ($responderComentario !== NULL) resposta($conexao, $responderComentario);

						echo "<div class='comentario' id='comentario$idComentario' value='$idComentario'>";

						echo 	 "<div class='usuario'>";
						echo 		"<div class='iconeUsuario'>";
						if ($linha->IMAGEM_USUARIO !== null) {
							echo     "<img src='../../assets/img/$linha->IMAGEM_USUARIO' class='fotoPerfilPequena' />";
						} else {
							echo     "<img src='../../assets/img/padrao.jpg' class='fotoPerfilPequena' />";
						}
						echo 		"</div>";
						echo     "<div class='nomeUsuario'>";
						echo       "<p>$linha->NOME_USUARIO</p>";
						echo     "</div>";
						echo 	 "</div>";

						echo 	 "<p>$linha->TEXTO_COMENTARIO_USUARIO</p>";

						if (isset($_SESSION["idUsuario"])) {
							echo	 "<div class='opcoesComentario' onclick='respondeComentario($idComentario)'>";
							echo     "<a href='#containerComentarios' class='responder'><i class='fa-solid fa-reply'></i></a>";
							if ($linha->ID_USUARIO === $_SESSION["idUsuario"] || $_SESSION["tipoUsuario"] === "A") {
								echo   "<a href='../../assets/funcoes/comentarios/exclui-comentario.php?idComentario=$idComentario' class='excluir'><i class='fa-solid fa-trash'></i></a>";
							}
							echo	 "</div>";
						} // isset session idUsuario
						echo "</div>"; // comentario
					} // while

					if ($btn <> "" && $btn <> "menos") echo "<button type='submit' name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnVerMenos' onclick='verMenos()'>Ver menos</button>";

					echo "</div>"; // mostraAjax
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando.");
			} // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
		} // try/catch
	} // function

	if (!isset($_POST["btn"])) carregaComentarios(); else carregaComentarios($_POST["btn"]);
?>
