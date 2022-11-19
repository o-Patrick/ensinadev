<?php
	require "../conexao.php";

	if(isset($_POST["btnSubmit"])){
		// pega o e-mail para poder enviar a resposta
		if(isset($_POST["email"])){
			$emailContato = $_POST["email"];
		}

		if(isset($_POST["campoTexto"])){
			$campoTexto = $_POST["campoTexto"];
		}

		try{
			$comando = $conexao -> prepare("INSERT INTO TB_CONTATO VALUES (DEFAULT, ?, ?, NOW(), 0)");
			$comando -> bindParam(1, $emailContato);
			$comando -> bindParam(2, $campoTexto);

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					$campoTexto = null;
					echo "<script>alert('Mensagem enviada com sucesso!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/contato.php'>";
				} else {
					echo "<script>alert('Erro ao enviar mensagem! Se o problema persistir, envie um e-mail para xxxx@xxxx.com')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/contato.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			}; // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/contato.php'>";
		} // try/catch
	} // if isset btnSubmit
?>