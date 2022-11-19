<?php
	function mostraProgresso($conexao) {
		// quantidade de itens no tema
		try {
			$comando = $conexao -> prepare("SELECT * FROM TB_ITEM_TEMA AS TBI JOIN TB_TEMA AS TBT ON TBI.ID_TEMA = TBT.ID_TEMA WHERE TBT.NOME_TEMA = ?");
			$comando -> bindParam(1, $_SESSION["tema"]);

			$qtdItens = 0;

			if ($comando -> execute()){
				if ($comando -> rowCount() > 0){
					while ($linha = $comando -> fetch(PDO::FETCH_OBJ)){
						$tema = $linha -> NOME_TEMA;
						++$qtdItens;
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
			$comando = $conexao -> prepare("SELECT * FROM TB_PROGRESSO_TEMA AS TBP JOIN TB_ITEM_TEMA AS TBI ON TBI.ID_ITEM_TEMA = TBP.ID_ITEM_TEMA JOIN TB_TEMA AS TBT ON TBI.ID_TEMA = TBT.ID_TEMA WHERE ID_USUARIO = ? AND TBP.CONCLUIDO_PROGRESSO_TEMA = 1 AND TBT.NOME_TEMA = ?");
			$comando -> bindParam(1, $_SESSION["idUsuario"]);
			$comando -> bindParam(2, $_SESSION["tema"]);

			$qtdConcluidos = 0;

			if ($comando -> execute()){
				if ($comando -> rowCount() > 0){
					while ($linha = $comando -> fetch(PDO::FETCH_OBJ)){
						$qtdConcluidos++;
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

		if ($qtdItens === 0) {
			$porcentagem = 0;
		} else {
			$porcentagem = ($qtdConcluidos * 100) / $qtdItens;
			$porcentagem = number_format($porcentagem, 0);
		}

		echo "<div class='temaProgresso containerFlex'>";
		echo   "<div class='temaProgressoInfos'>";
		echo 	   "<p>" . $porcentagem . "% concluído</p>";
		echo     "<div class='barraProgresso'>
								<div class='barraProgressoAtual' style='width:" . $porcentagem . "%;'>
								</div>
							</div>";
		echo   "</div>";
		echo "</div>";
	} // function
?>
