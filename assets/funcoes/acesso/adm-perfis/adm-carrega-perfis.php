<?php
	function admCarregaPerfis($btn = "") {
		if ($btn === "") require "../../../assets/funcoes/conexao.php"; else require "../../conexao.php";

		try {
			if ($btn === "" || $btn  === "menos") {
				$comando = $conexao -> prepare ("SELECT * FROM TB_USUARIO WHERE TIPO_USUARIO = 'E' ORDER BY NOME_USUARIO LIMIT 3");
			} else {
				$comando = $conexao -> prepare ("SELECT * FROM TB_USUARIO WHERE TIPO_USUARIO = 'E' ORDER BY NOME_USUARIO");
			}

			if($comando -> execute()) {
				if ($comando -> rowCount() > 0) {
					echo "<div style='display:flex;'>";
					if ($btn <> "mais") echo "<button type='button' name='btnVerMais' class='btnSubmit' id='btnSubmit' onclick=verMais()>Ver mais</button>";
					echo   "<button type='button' name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnSubmit' onclick=verMenos()>Ver menos</button>";
					echo "</div>";
					while($linha = $comando -> fetch(PDO::FETCH_OBJ)) {
						echo "<form action='../../../assets/funcoes/acesso/adm-perfis/adm-gere-perfis.php' method='post'>";
						echo "<div class='bloco'>";
						echo   "<input type='text' name='idPerfil' value='" . $linha -> ID_USUARIO . "' readonly />";
						echo 	 "<div class='usuario'>";
						echo 		 "<a href='../../paginas/perfilTerceiro.php'>";
						echo 			 "<div class='iconeUsuario'>";
						if ($linha -> IMAGEM_USUARIO !== null) {
							echo "<img src='../../../assets/img/" . $linha -> IMAGEM_USUARIO . "' class='fotoPerfilPequena' />";
						} else {
							echo "<img src='../../../assets/img/padrao.jpg' class='fotoPerfilPequena' />";
						}
						echo 			 "</div>";
						echo 		 "</a>";
						echo 	 "</div>";
						echo 	 "<p>" . $linha -> NOME_USUARIO . "</p>";
						echo   "<button type='submit' name='btnSubmit' class='btnSubmit' id='btnSubmit' value='btnExcluir'>Excluir</button>";
						echo "</div>";
						echo "</form>";

						$idPerfil = $linha -> ID_USUARIO;
					} // while
					if ($btn === "mais") echo "<button type='button' name='btnVerMenos' class='btnSubmit btnVerMenos' id='btnSubmit' onclick=verMenos()>Ver menos</button>";
				} else {
					echo "<p style='text-align:center;'>Nenhum perfil foi encontrado!</p>";
				}// if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando.");
			} // if execute
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/areaAdm.php'>";
		} // try/catch
	} // function

	// chama a função
	if (!isset($_POST["btn"])) admCarregaPerfis(); else admCarregaPerfis($_POST["btn"]);
?>