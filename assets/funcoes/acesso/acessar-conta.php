<?php
	session_start();

	require "../conexao.php";

	if(isset($_POST["btnSubmit"])){
		if(isset($_POST["usuario"])){
			$usuario = $_POST["usuario"];
		}
		if(isset($_POST["senha"])){
			$senha = $_POST["senha"];
		}

		try{
			$comando = $conexao -> prepare("SELECT * FROM TB_USUARIO WHERE NOME_USUARIO = ? AND SENHA_USUARIO = ?");
			$comando -> bindParam(1, $usuario);
			$comando -> bindParam(2, $senha);

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					$linha = $comando -> fetch(PDO::FETCH_OBJ);
					$_SESSION["idUsuario"] = $linha -> ID_USUARIO;
					$_SESSION["tipoUsuario"] = $linha -> TIPO_USUARIO;
					$_SESSION["imgUsuario"] = $linha -> IMAGEM_USUARIO;
					
					$usuario = null;
					$senha = null;

					echo "<script>alert('Login efetuado com sucesso!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
				} else{
					$usuario = null;
					$senha = null;

					echo "<script>alert('Usuário ou senha inválidos!');</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/acessar-conta.php'>";
				}
			} else{
				throw new PDOException("Erro: não foi possível executar o comando");
			}
		} catch(PDOException $erro){
			echo "<p style='display:none;'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.getElementsByTagName('p')[0].innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/acessar-conta.php'>";
		} // try/catch
	} // if isset btnSubmit
?>