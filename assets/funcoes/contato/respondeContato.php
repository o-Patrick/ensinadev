<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	require_once('../conexao.php');
	require_once('../../PHPMailer/src/PHPMailer.php');
	require_once('../../PHPMailer/src/SMTP.php');
	require_once('../../PHPMailer/src/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	if(isset($_POST["btnSubmit"])){
		// pega as informações para contato
		try {
			$comando = $conexao -> prepare("SELECT * FROM TB_CONTATO WHERE ID_CONTATO = ?");
			$comando -> bindParam(1, $_SESSION["idMensagem"]);

			if ($comando -> execute()) {
				if ($comando -> rowCount() > 0) {
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$emailContato = $linha -> EMAIL_CONTATO;

					echo "<script> console.log('Dados para contato encontrados com sucesso!') </script>";
				} else {
					echo "<script>alert('Erro ao encontrar dados para contato')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/respondeContato.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			} // if execute
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/respondeContato.php'>";
		} // try/catch

		// envia o e-mail
		if (isset($_POST["campoTexto"])) $resposta = $_POST["campoTexto"];

		$mail = new PHPMailer(true);
		
		try {
			// para depuração
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;
			$mail->Username = 'sac.ensinadev@gmail.com';
			$mail->Password = 'htpb soqk rroo xqzz';
			// no caso de ssl:
			// $Mailer->Port = 465;

			$mail->setFrom('sac.ensinadev@gmail.com');
			$mail->addAddress($emailContato);
			// $mail->addAddress('endereco@provedor.com');

			$mail->isHTML(true);
			$mail->Subject = 'Contato EnsinaDev';
			$mail->Body = $resposta;

			if($mail->send()) {
				// marca a mensagem como respondida
				try{
					$comando = $conexao -> prepare("UPDATE TB_CONTATO SET RESPONDIDO_CONTATO = 1 WHERE ID_CONTATO = ?");
					$comando -> bindParam(1, $_SESSION["idMensagem"]);

					if($comando -> execute()){
						if($comando -> rowCount() > 0){
							echo "<script> console.log('Mensagem marcada como respondida com sucesso!') </script>";
						} else {
							echo "<script>console.log('Erro ao marcar mensagem como respondida!')</script>";
						} // if rowCount
					} else {
						throw new PDOException("Erro: não foi possível executar o comando!");
					} // if execute
				} catch(PDOException $erro) {
					echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
					echo "<script> console.log(document.querySelector('#erro').innerText); </script>";
				} // try/catch

				unset($_SESSION["idMensagem"]);
				unset($emailContato);
				unset($resposta);

				echo "<script> alert('Resposta enviada com sucesso!') </script>";
				echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/mensagensContato.php'>";
			} else {
				echo "<script> alert('ERRO: resposta não enviada!') </script>";
				echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/areaAdm/contato/respondeContato.php'>";
			} // if mail send
		} catch (Exception $e) {
			echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
		} // try contrução e-mail
	} // if isset btnSubmit
?>
