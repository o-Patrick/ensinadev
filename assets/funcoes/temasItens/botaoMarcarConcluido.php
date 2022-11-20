<?php
	function botaoMarcarConcluido() {
		require "../../assets/funcoes/conexao.php";

		try{
			$comando = $conexao -> prepare("SELECT TBT.ID_TEMA FROM TB_TEMA AS TBT JOIN TB_ITEM_TEMA AS TBI ON TBT.ID_TEMA = TBI.ID_TEMA WHERE TBT.NOME_TEMA = ? LIMIT 1");
			$comando -> bindParam(1, $_SESSION["tema"]);

			if($comando -> execute()){
				if($comando -> rowCount() > 0) {
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$idTema = $linha -> ID_TEMA;
				} else {
					echo "<script>console.log('Erro ao selecionar TBT.ID_TEMA')</script>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			}; // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		} // try select

		try{
			$comando = $conexao -> prepare("SELECT CONCLUIDO_PROGRESSO_TEMA FROM TB_PROGRESSO_TEMA AS TBP JOIN TB_ITEM_TEMA AS TBI ON TBP.ID_ITEM_TEMA = TBI.ID_ITEM_TEMA WHERE TBI.ID_TEMA = ? AND TBI.ID_ITEM_TEMA = ?");
			$comando -> bindParam(1, $idTema);
			$comando -> bindParam(2, $_SESSION["item"]);

			if($comando -> execute()){
				if($comando -> rowCount() > 0) {
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$concluido = $linha -> CONCLUIDO_PROGRESSO_TEMA;
				} else {
					echo "<script>console.log('Erro ao selecionar de TB_ITEM_TEMA')</script>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			}; // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		} // try select

		if (isset($_SESSION["idUsuario"]) && $_SESSION["tipoUsuario"] === "E") {
			echo "<form action='../../assets/funcoes/temasItens/marcarLido.php' method='post'>";
			echo 	"<button type='submit' name='btnMarcarLido' class='btn btnLido'>";
			if (!isset($concluido) || $concluido === 0) {
				echo  "Marcar como lido";
			} else {
				echo  "Conteúdo lido";
			}
			echo  "</button>";
			echo "</form>";
		}
	} // function
?>
