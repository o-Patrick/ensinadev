<?php
	session_start();
	require "../conexao.php";

	// apaga comentários do usuário
	try {
		$comando = $conexao -> prepare("DELETE FROM TB_COMENTARIO_USUARIO WHERE ID_USUARIO = ?");
		$comando -> bindParam(1, $_SESSION["idUsuario"]);

		if ($comando -> execute()){
			if ($comando -> rowCount() > 0){		
				echo "<script>console.log('Comentários excluídos com sucesso!')</script>";
			} else {
				echo "<script>console.log('Erro ao excluir comentários!')</script>";
			} // if rowCount
		} else {
			throw new PDOException("Erro: não foi possível executar o comando!");
		} // if execute
	} catch(PDOException $erro) {
		echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
		echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/areaAdm/gerenciadorPerfis.php'>";
	} // try geral

	// apaga perguntas faq do usuário
	try {
		$comando = $conexao -> prepare("DELETE FROM TB_PERGUNTA_FAQ WHERE ID_USUARIO = ?");
		$comando -> bindParam(1, $_SESSION["idUsuario"]);

		if ($comando -> execute()){
			if ($comando -> rowCount() > 0){		
				echo "<script>console.log('Perguntas do usuário no FAQ excluídas com sucesso!')</script>";
			} else {
				echo "<script>console.log('Erro ao excluir perguntas do usuário no FAQ')</script>";
			} // if rowCount
		} else {
			throw new PDOException("Erro: não foi possível executar o comando!");
		}; // if execute
	} catch(PDOException $erro) {
		echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
		echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/areaAdm/gerenciadorPerfis.php'>";
	} // try geral

	// apaga mensagens de contato do usuário
	try {
		$comando = $conexao -> prepare("DELETE FROM TB_CONTATO WHERE ID_USUARIO = ?");
		$comando -> bindParam(1, $_SESSION["idUsuario"]);

		if ($comando -> execute()){
			if ($comando -> rowCount() > 0){		
				echo "<script>console.log('Mensagens de contato do usuário excluídas com sucesso!')</script>";
			} else {
				echo "<script>console.log('Erro ao excluir mensagens de contato do usuário')</script>";
			} // if rowCount
		} else {
			throw new PDOException("Erro: não foi possível executar o comando!");
		}; // if execute
	} catch(PDOException $erro) {
		echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
		echo "<script>console.log(document.querySelector('#erro').innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/areaAdm/gerenciadorPerfis.php'>";
	} // try geral

	// exclui conta do usuário
	try{
		$comando = $conexao -> prepare("DELETE FROM TB_USUARIO WHERE ID_USUARIO = ?");
		$comando -> bindParam(1, $_SESSION["idUsuario"]);

		if($comando -> execute()){
			if($comando -> rowCount() > 0){
				// Apaga as var de sessao
				unset($_SESSION["idUsuario"]);
				unset($_SESSION["tipoUsuario"]);
				// Destruindo a sessão
				session_destroy();

				echo "<script>alert('Conta excluída com sucesso! Sentimos em te ver partir :(')</script>";
				echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
			} else {
				echo "<script>alert('Erro ao excluir! Se o problema persistir fale conosco em Contato no menu')</script>";
				echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/perfil.php'>";
			} // if rowCount
		} else {
			throw new PDOException("Erro: não foi possível executar o comando!");
		}; // if execute
	} catch(PDOException $erro) {
		echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
		echo "<script>alert(document.querySelector('#erro').innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/perfil.php'>";
	} // try geral
?>