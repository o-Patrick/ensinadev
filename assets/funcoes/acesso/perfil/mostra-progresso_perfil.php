<?php
	function mostraProgresso($conexao) {
		// quantidade de itens no tema
		try {
			$comando = $conexao -> prepare("SELECT * FROM TB_TEMA AS TBT JOIN TB_ITEM_TEMA AS TBI ON TBT.ID_TEMA = TBI.ID_TEMA");

			$qtdHtml = 0;
			$qtdCss = 0;
			$qtdJs = 0;
			$qtdPhp = 0;

			if ($comando -> execute()){
				if ($comando -> rowCount() > 0){
					while ($linha = $comando -> fetch(PDO::FETCH_OBJ)){
						$tema = $linha -> NOME_TEMA;
						if ($tema === "HTML") {
							++$qtdHtml;
						} elseif ($tema === "CSS") {
							++$qtdCss;
						} elseif ($tema === "JAVASCRIPT") {
							++$qtdJs;
						} elseif ($tema === "PHP") {
							++$qtdPhp;
						}
					} // while
				} else {
					echo "<script>console.log('Nenhuma linha retornada!');</script>";
				}
			} else {
				throw new PDOException("Erro: não foi possível executar o comando");
			}
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		} // try

		// quantidade de itens concluídos no tema por aquele usuário
		try {
			$comando = $conexao -> prepare("SELECT * FROM TB_PROGRESSO_TEMA AS TBP JOIN TB_ITEM_TEMA AS TBI ON TBP.ID_ITEM_TEMA = TBI.ID_ITEM_TEMA JOIN TB_TEMA AS TBT ON TBI.ID_TEMA = TBT.ID_TEMA WHERE ID_USUARIO = ?");
			$comando -> bindParam(1, $_SESSION["idUsuario"]);

			$qtdHtmlConcluido = 0;
			$qtdCssConcluido = 0;
			$qtdJsConcluido = 0;
			$qtdPhpConcluido = 0;

			if ($comando -> execute()){
				if ($comando -> rowCount() > 0){
					while ($linha = $comando -> fetch(PDO::FETCH_OBJ)){
						$tema = $linha -> NOME_TEMA;
						if ($tema === "HTML") {
							++$qtdHtmlConcluido;

							$porcentHtml = ($qtdHtmlConcluido * 100) / $qtdHtml;
							$porcentHtml = number_format($porcentHtml, 0);
						} elseif ($tema === "CSS") {
							++$qtdCssConcluido;

							$porcentCss = ($qtdCssConcluido * 100) / $qtdCss;
							$porcentCss = number_format($porcentCss, 0);
						} elseif ($tema === "JAVASCRIPT") {
							++$qtdJsConcluido;

							$porcentJs = ($qtdJsConcluido * 100) / $qtdJs;
							$porcentJs = number_format($porcentJs, 0);
						} elseif ($tema === "PHP") {
							++$qtdPhpConcluido;

							$porcentPhp = ($qtdPhpConcluido * 100) / $qtdPhp;
							$porcentPhp = number_format($porcentPhp, 0);
						}
					} // while
				} else {
					echo "<script>console.log('Nenhuma linha retornada!');</script>";
				}
			} else {
				throw new PDOException("Erro: não foi possível executar o comando");
			}
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		} // try

		// elemento de progresso em si
		echo "<div class='progresso containerFlex'>";
		echo   "<div class='temaProgressoInfos'>";
		if ($qtdHtmlConcluido > 0) {
			echo   "<h3 class='titulo'>HTML</h3>";
			echo 	 "<p>" . $porcentHtml . "% concluído</p>";
			echo   "<div class='barraProgresso'>
								<div class='barraProgressoAtual' style='width:" . $porcentHtml . "%;'>
								</div>
							</div>";
			echo	 "<div class='temaProgressoBtn'>";
			echo     "<form action='../temas/tema.php' method='post' class='formBtnTema'>";
			echo	     "<button type='submit' name='btnTema' value='html'>";
			if ($porcentHtml <> 100) {
				echo         "Continuar";
			} else {
				echo       "Ver";
			}
			echo	     "</button>";
			echo	 "</div>";
		} elseif ($qtdCssConcluido > 0) {
			echo   "<h3 class='titulo'>CSS</h3>";
			echo 	 "<p>" . $porcentCss . "% concluído</p>";
			echo   "<div class='barraProgresso'>
								<div class='barraProgressoAtual' style='width:" . $porcentCss . "%;'>
								</div>
							</div>";
			echo	 "<div class='temaProgressoBtn'>";
			echo	     "<button type='submit' name='btnTema' value='css'>";
			if ($qtdCssConcluido <> 100) {
				echo         "Continuar";
			} else {
				echo       "Ver";
			}
			echo	     "</button>";
			echo	 "</div>";
		} elseif ($qtdJsConcluido > 0) {
			echo   "<h3 class='titulo'>JavaScript</h3>";
			echo 	 "<p>" . $porcentJs . "% concluído</p>";
			echo   "<div class='barraProgresso'>
								<div class='barraProgressoAtual' style='width:" . $porcentJs . "%;'>
								</div>
							</div>";
			echo	 "<div class='temaProgressoBtn'>";
			echo	     "<button type='submit' name='btnTema' value='javascript'>";
			if ($porcentJs <> 100) {
				echo         "Continuar";
			} else {
				echo       "Ver";
			}
			echo	     "</button>";
			echo	 "</div>";
		} elseif ($qtdPhpConcluido > 0) {
			echo   "<h3 class='titulo'>PHP</h3>";
			echo 	 "<p>" . $porcentPhp . "% concluído</p>";
			echo   "<div class='barraProgresso'>
								<div class='barraProgressoAtual' style='width:" . $porcentPhp . "%;'>
								</div>
							</div>";
			echo	 "<div class='temaProgressoBtn'>";
			echo	     "<button type='submit' name='btnTema' value='php'>";
			if ($porcentPhp <> 100) {
				echo         "Continuar";
			} else {
				echo       "Ver";
			}
			echo	     "</button>";
			echo	 "</div>";
		} else {
			echo "<p>Nenhum tema em progresso!</p>";
		}
		echo   "</div>";
		echo "</div>";
	} // function
?>
