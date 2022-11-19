<?php
	session_start();

  require "../../../funcoes/conexao.php";

  if (isset($_POST["btnSubmit"])) {
		// select dados atuais
		try{
			$comando = $conexao -> prepare("SELECT NOME_USUARIO, EMAIL_USUARIO, SENHA_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
			$comando -> bindParam(1, $_SESSION["idUsuario"]);

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$nomeAtual = $linha -> NOME_USUARIO;
					$emailAtual = $linha -> EMAIL_USUARIO;
					$senhaAtual = $linha -> SENHA_USUARIO;
				} else{
					echo "<script>console.log('Não foi possível buscar as informações');</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
				}
			} else{
				throw new PDOException("Erro: não foi possível executar o comando");
			}
		} catch(PDOException $erro){
			echo "<p style='display:none;' id='erro' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
		} // try/catch

		if(isset($_POST["nomeUsuario"])){
			$nomeUsuario = $_POST["nomeUsuario"];
		} else {
			$nomeUsuario = null;
		}

		if(isset($_POST["emailUsuario"])){
			$emailUsuario = $_POST["emailUsuario"];
		} else {
			$emailUsuario = null;
		}

		if(isset($_POST["senhaUsuario"])){
			$senhaUsuario = $_POST["senhaUsuario"];
		} else {
			$senhaUsuario = null;
		}

		// altera nome
		if ($nomeAtual !== $nomeUsuario && $nomeUsuario !== null) {
			try{
				$comando = $conexao -> prepare("UPDATE TB_USUARIO SET NOME_USUARIO = ? WHERE ID_USUARIO = ?");
				$comando -> bindParam(1, $nomeUsuario);
				$comando -> bindParam(2, $_SESSION["idUsuario"]);

				unset($nomeUsuario);

				if($comando -> execute()){
					if($comando -> rowCount() <= 0){
						echo "<script>console.log('Não foi possível alterar o nome de usuário');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
					}
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				}
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
			} // try/catch
		} // altera nome

		// altera e-mail
		if ($emailAtual !== $emailUsuario && $emailUsuario !== null) {
			try{
				$comando = $conexao -> prepare("UPDATE TB_USUARIO SET EMAIL_USUARIO = ? WHERE ID_USUARIO = ?");
				$comando -> bindParam(1, $emailUsuario);
				$comando -> bindParam(2, $_SESSION["idUsuario"]);

				unset($emailUsuario);

				if($comando -> execute()){
					if($comando -> rowCount() <= 0){
						echo "<script>console.log('Não foi possível alterar o e-mail de usuário');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
					}
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				}
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
			} // try/catch
		} // altera e-mail

		echo "<script>alert('Informações salvas com sucesso!')</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
	} // if btnSubmit
?>
