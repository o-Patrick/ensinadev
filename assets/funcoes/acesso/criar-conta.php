<?php

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
			$comando = $conexao -> prepare("INSERT INTO TB_USUARIO VALUES (DEFAULT, ?, ?, ?, NULL, 'E')");
			$comando -> bindParam(1, $email);
			$comando -> bindParam(2, $senha);
			$comando -> bindParam(3, $usuario);

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					logarAoCriar($conexao);

					$usuario = null;
					$email = null;
					$senha = null;

					echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
				} else {
					echo "<script>alert('Erro ao cadastrar! Se o problema persistir fale conosco em Contato no menu')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/criar-conta.php'>";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando!");
			}; // if execute
		} catch(PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/criar-conta.php'>";
		} // try geral
	} // if isset btnSubmit

	function logarAoCriar($conexao) {
		$idUsuario = $conexao -> lastInsertId();
		$_SESSION['idUsuario'] = $idUsuario;

		$comando = $conexao -> prepare("SELECT TIPO_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
		$comando -> bindParam(1, $_SESSION["idUsuario"]);

		if($comando -> execute()){
			if($comando -> rowCount() > 0){
				while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
					$_SESSION["tipoUsuario"] = $linha -> TIPO_USUARIO;
				}
			}
			$idUsuario = null;
		}
	} // function

?>