<?php
	session_start();
	require "../conexao.php";

	if (isset($_POST["btnMarcarLido"])) {
		// insert TB_PROGRESSO_TEMA
		try{
			$comando = $conexao -> prepare("INSERT INTO TB_PROGRESSO_TEMA VALUES (DEFAULT, 1, ?, ?)");
			$comando -> bindParam(1, $_SESSION["item"]);
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
