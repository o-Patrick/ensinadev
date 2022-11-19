<?php
	require_once('../conexao.php');
	require_once('../../PHPMailer/src/PHPMailer.php');
	require_once('../../PHPMailer/src/SMTP.php');
	require_once('../../PHPMailer/src/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	if(isset($_POST["btnSubmit"])){
		if (isset($_POST["email"])) $email = $_POST["email"];

		$msgRecuperacao = "<h1>E-mail de recuperação</h1>
											<p>Abaixo está link para a recuperação da sua senha no EnsinaDev!</p>
											<a href='http://localhost/ensinadev_mao/paginas/acesso/recuperar-senha.php?email=$email'>
												Recuperar minha senha
											</a>
											<p>Atenciosamente,</p>
											<p>Equipe EnsinaDev</p>";

		// pega as informações para contato
		try {
			$comando = $conexao -> prepare("SELECT EMAIL_USUARIO FROM TB_USUARIO WHERE EMAIL_USUARIO = ?");
			$comando -> bindParam(1, $email);

			if ($comando -> execute()) {
				if ($comando -> rowCount() > 0) {
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$email = $linha -> EMAIL_USUARIO;

					// envia o e-mail
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
						$mail->addAddress($email);
						// $mail->addAddress('endereco@provedor.com');

						$mail->isHTML(true);
						$mail->CharSet = 'UTF-8';
						$mail->Subject = 'E-mail de recuperação | EnsinaDev';
						$mail->Body = $msgRecuperacao;

						if($mail->send()) {
							unset($email);

							echo "<script> alert('E-mail de recuperação enviado com sucesso! Cheque sua caixa de entrada ou de spam para acessar o link') </script>";
							echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
						} else {
							echo "<script> alert('ERRO: e-mail de recuperação não enviado. Se o erro persistir, fale conosco em Contato') </script>";
							echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/enviar-recuperacao.php'>";
						} // if mail send
					} catch (Exception $e) {
						echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
					} // try contrução e-mail
				} else {
					echo "<script>alert('ERRO: e-mail inválido!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/enviar-recuperacao.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			} // if execute
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/enviar-recuperacao.php'>";
		} // try/catch
	} // if isset btnSubmit
?>
