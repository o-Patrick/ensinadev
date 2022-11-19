<?php
	session_start();

	require "../conexao.php";

	if (isset($_POST["btnSubmit"])){
		$btnSubmit = $_POST["btnSubmit"];

		if (isset($_POST["idMensagem"])) $idMensagem = $_POST["idMensagem"];

		if ($btnSubmit === "btnExcluir") {
			try {
				$comando = $conexao -> prepare("DELETE FROM TB_CONTATO WHERE ID_CONTATO = ?");
				$comando -> bindParam(1, $idMensagem);

				if ($comando -> execute()) {
					if ($comando -> rowCount() > 0) {
						unset($idMensagem);
						echo "<script>alert('Mensagem excluída com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/mensagensContato.php'>";
					} else {
						echo "<script>alert('Erro ao excluir mensagem!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/mensagensContato.php'>";
					} // if rowCount
				} else {
					throw new PDOException("Erro: não foi possível executar o comando!");
				} // if execute
			} catch (PDOException $erro) {
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/mensagensContato.php'>";
			} // try/catch
		} elseif ($btnSubmit === "btnResponder") {
			$_SESSION["idMensagem"] = $idMensagem;
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/respondeContato.php'>";
		} // if qual botão
	} // if isset btnSubmit
?>