<?php
	session_start();
	require "../conexao.php";

	if (isset($_POST["btnMarcarLido"])) {
		// select ID_ITEM_TEMA
		try{
			$comando = $conexao -> prepare("SELECT ID_ITEM_TEMA FROM TB_ITEM_TEMA WHERE NOME_ITEM_TEMA = ?");
			$comando -> bindParam(1, $_SESSION["item"]);

			if($comando -> execute()){
				if($comando -> rowCount() > 0) {
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$idItem = $linha -> ID_ITEM_TEMA;
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

		// insert TB_PROGRESSO_TEMA
		try{
			$comando = $conexao -> prepare("INSERT INTO TB_PROGRESSO_TEMA VALUES (DEFAULT, 1, ?, ?)");
			$comando -> bindParam(1, $idItem);
			$comando -> bindParam(2, $_SESSION["idUsuario"]);

			if ($comando -> execute()) {
				if ($comando -> rowCount() > 0) {
					echo "<script>alert('Conteúdo marcado como lido!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
				} else {
					echo "<script>alert('Erro ao marcar como lido! Se o problema persistir fale conosco em Contato no menu')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			}; // if execute
		} catch(PDOException $erro) {
			echo "<script>alert('Item já marcado como concluído!');</script>";
			echo "<meta http-equiv='refresh' content='0;../../../paginas/temas/item.php'>";
		} // try insert
	} // if isset botão
?>
