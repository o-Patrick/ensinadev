<?php

	session_start();

	require "../conexao.php";

	if(isset($_POST["btnSubmit"])){
		if(isset($_POST["usuario"])){
			$usuario = $_POST["usuario"];
		}

		try{
			$comando = $conexao -> prepare("INSERT INTO TB_USUARIO VALUES (DEFAULT, ?, ?, ?, 'padrao.jpg', FALSE, 'C')");
			$comando -> bindParam(1, $email);

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					$idUsuario = $conexao -> lastInsertId();
					$_SESSION['idUsuario'] = $idUsuario;

					$usuario = null;

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
		// retorna para tela de login
	}

?>