<?php
	$bco = "DB_ENSINA_DEV";
	$usuario = "root";
	$senha = "";

	try {
		$conexao = new PDO("mysql:host=localhost;dbname=$bco", "$usuario", "$senha");
		$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexao -> exec("set names utf8");
	} catch (PDOException $erro){
		echo "<p style='display:none;' id='erro'>Erro na conexão: " . $erro -> getMessage() . "</p>";
		echo "<script>alert(document.querySelector('#erro').innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../paginas/criar-conta.php'/>";
	}
?>