<?php
	function carregaTema() {
		require "../../assets/funcoes/conexao.php";

		$Comando = $conexao -> prepare ("SELECT * FROM TB_TEMA WHERE NOME_TEMA = ?");
		$Comando -> bindParam (1, $_SESSION["tema"]);

		if($Comando -> execute()) {
			if ($Comando -> rowCount() > 0) {
				$linha = $Comando -> fetch(PDO::FETCH_OBJ);
				require "../../assets/funcoes/temasItens/" . $linha -> NOME_TEMA . "/carrega" . $linha -> NOME_TEMA . ".html";
			} // if rowCount
		} else {
			throw new PDOException("Erro: não foi possível executar o comando.");
		} // if execute
	} // function
?>
