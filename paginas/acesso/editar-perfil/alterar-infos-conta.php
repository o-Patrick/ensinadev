<?php
// ../../assets/funcoes/acesso/alterar-infos-conta.php
	session_start();
	require "../conexao.php";

	if(isset($_POST["btnSubmit"])){
		if(isset($_POST["usuario"])){
			$usuario = $_POST["usuario"];
		}

		if(isset($_POST["email"])){
			$email = $_POST["email"];
		}

		if(isset($_POST["senha"])){
			$senha = $_POST["senha"];
		}

		try{
			if(isset($usuario)){
				$comando = $conexao -> prepare("UPDATE TB_USUARIO SET NOME_USUARIO = ? WHERE NOME_USUARIO = ?");
				$comando -> bindParam(1, $usuario);
				$comando -> bindParam(2, $_SESSION["idUsuario"]);
			} else {
				echo "<script>alert('Erro ao trocar usuário! Se o problema persistir fale conosco em Contato no menu')</script>";
			}

			if(isset($email)){
				$comando = $conexao -> prepare("UPDATE TB_USUARIO SET EMAIL_USUARIO = ? WHERE NOME_USUARIO = ?");
				$comando -> bindParam(1, $email);
				$comando -> bindParam(2, $_SESSION["idUsuario"]);
			} else {
				echo "<script>alert('Erro ao trocar e-mail! Se o problema persistir fale conosco em Contato no menu')</script>";
			}

			if(isset($senha)){
				$comando = $conexao -> prepare("UPDATE TB_USUARIO SET SENHA_USUARIO = ? WHERE NOME_USUARIO = ?");
				$comando -> bindParam(1, $senha);
				$comando -> bindParam(2, $_SESSION["idUsuario"]);
			} else {
				echo "<script>alert('Erro ao trocar senha! Se o problema persistir fale conosco em Contato no menu')</script>";
			}

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					echo "<script>alert('Troca efetuada com sucesso!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
				} else {
					echo "<script>alert('Erro ao trocar dados! Se o problema persistir fale conosco em Contato no menu')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/alterar-infos-conta.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			}; // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/alterar-infos-conta.php'>";
		} // try geral
	} // isset btnSubmit
?>