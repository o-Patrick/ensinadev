<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

  require_once('../conexao.php');
  require_once('../../PHPMailer/src/PHPMailer.php');
  require_once('../../PHPMailer/src/SMTP.php');
  require_once('../../PHPMailer/src/Exception.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // function enviaNotificacao() {
    $idResponder = $_SESSION["idResponder"];
    $idUsuario = $_SESSION["idUsuario"];


    // pega o texto da resposta
    try {
      $idResposta = $conexao->lastInsertId();

      $comando = $conexao->prepare("SELECT TEXTO_COMENTARIO_USUARIO FROM TB_COMENTARIO_USUARIO WHERE ID_COMENTARIO_USUARIO = ?");
      $comando->bindParam(1, $idResposta);

      if($comando->execute()){
        if($comando->rowCount() > 0){
          $linha = $comando->fetch(PDO::FETCH_OBJ);
          $textoOriginal = $linha->TEXTO_COMENTARIO_USUARIO;
          echo "<script> console.log('Seleção do comentário original feita com sucesso') </script>";
        } else {
          echo "<script> console.log('Erro selecionar comentário original') </script>";
        } // if rowCount
      } else {
        throw new PDOException("Erro: não foi possível executar o comando!");
      } // if execute
    } catch(PDOException $erro) {
      echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
      echo "<script> console.log(document.querySelector('#erro').innerText) </script>";
    } // try/catch


    // pega o nome de quem respondeu
    try {
      $comando = $conexao->prepare("SELECT NOME_USUARIO, EMAIL_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
      $comando->bindParam(1, $_SESSION["idUsuario"]);

      if($comando->execute()){
        if($comando->rowCount() > 0){
          $linha = $comando->fetch(PDO::FETCH_OBJ);
          $nomeRespondeu = $linha->NOME_USUARIO;
          $emailRespondeu = $linha->EMAIL_USUARIO;
          echo "<script> console.log('Seleção do nome do autor da resposta feita com sucesso') </script>";
        } else {
          echo "<script> console.log('Erro ao selecionar nome do autor da resposta feita') </script>";
        } // if rowCount
      } else {
        throw new PDOException("Erro: não foi possível executar o comando!");
      } // if execute
    } catch(PDOException $erro) {
      echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
      echo "<script> console.log(document.querySelector('#erro').innerText) </script>";
    } // try/catch


    // pega tema e item dos comentários
    try {
      $comando = $conexao->prepare("SELECT TBI.NOME_ITEM_TEMA, TBT.NOME_TEMA FROM TB_COMENTARIO_USUARIO AS TBC JOIN TB_ITEM_TEMA AS TBI ON TBC.ID_ITEM_TEMA = TBI.ID_ITEM_TEMA JOIN TB_TEMA AS TBT ON TBI.ID_TEMA = TBT.ID_TEMA WHERE TBC.ID_COMENTARIO_USUARIO = ?");
      $comando->bindParam(1, $idResponder);

      if($comando->execute()){
        if($comando->rowCount() > 0){
          $linha = $comando->fetch(PDO::FETCH_OBJ);
          $item = $linha->NOME_ITEM_TEMA;
          $tema = $linha->NOME_TEMA;
          echo "<script> console.log('Seleção de tema e item do comentário feita com sucesso') </script>";
        } else {
          echo "<script> console.log('Erro ao selecionar tema e item do comentário') </script>";
        } // if rowCount
      } else {
        throw new PDOException("Erro: não foi possível executar o comando!");
      } // if execute
    } catch(PDOException $erro) {
      echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
      echo "<script> console.log(document.querySelector('#erro').innerText) </script>";
    } // try/catch


		// envia o e-mail de notificação
		$msgNotificacao = "<h1>Você tem uma nova notificação no EnsinaDev</h1>
											<p>
                        <strong>$nomeRespondeu</strong> respondeu ao seu comentário em <strong>$tema > $item</strong>:
                      </p>

                      <hr>
											<p>$textoOriginal</p>

											<a href='http://localhost/ensinadev/paginas/temas/item.php?tema=$tema&item=$item'>
												Ver página de conteúdo
											</a>
                      <hr>

											<p>Atenciosamente,</p>
											<p>Equipe EnsinaDev</p>";

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
			$mail->addAddress($emailRespondeu);
			// $mail->addAddress('endereco@provedor.com');

			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'Nova notificação | EnsinaDev';
			$mail->Body = $msgNotificacao;

			if($mail->send()) {
				echo "<script> console.log('Notificação enviada com sucesso') </script>";
			} else {
				echo "<script> console.log('ERRO: notificação não enviado') </script>";
			} // if mail send
		} catch (Exception $erro) {
			echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
		} // try contrução e-mail

    unset($emailRespondeu, $nomeRespondeu, $idResponder, $idUsuario, $tema, $item, $textoOriginal, $msgNotificacao, $Mailer, $mail, $linha, $erro, $emailRespondeu, $comando);
  // } // function
?>
