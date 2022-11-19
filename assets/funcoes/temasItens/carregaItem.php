<?php
	function carregaItem() {
		require "../../assets/funcoes/conexao.php";

		if (isset($_GET["item"])) {
			$_SESSION["item"] = $_GET["item"];
		} elseif (isset($_POST["btnItem"])) {
			$_SESSION["item"] = $_POST["btnItem"];
		}

		if (isset($_GET["tema"])) $_SESSION["tema"] = $_GET["tema"];

		try {
			if (intval($_SESSION["item"]) == 0) {
				$Comando = $conexao -> prepare ("SELECT * FROM TB_ITEM_TEMA AS TBI JOIN TB_TEMA AS TBT ON TBI.ID_TEMA = TBT.ID_TEMA WHERE TBI.NOME_ITEM_TEMA = ? AND TBT.NOME_TEMA = ?");
				$Comando -> bindParam (1, $_SESSION["item"]);
				$Comando -> bindParam (2, $_SESSION["tema"]);
			} else {
				$Comando = $conexao -> prepare ("SELECT * FROM TB_ITEM_TEMA AS TBI JOIN TB_TEMA AS TBT ON TBI.ID_TEMA = TBT.ID_TEMA WHERE TBI.ID_ITEM_TEMA = ? AND TBT.NOME_TEMA = ?");
				$Comando -> bindParam (1, $_SESSION["item"]);
				$Comando -> bindParam (2, $_SESSION["tema"]);
			}

			if($Comando -> execute()) {
				if ($Comando -> rowCount() > 0) {
					$linha = $Comando -> fetch(PDO::FETCH_OBJ);

					$_SESSION["item"] = $linha -> ID_ITEM_TEMA;

					require "../../assets/funcoes/temasItens/" . $linha -> NOME_TEMA . "/carrega" . $linha -> NOME_ITEM_TEMA . ".html";
				} // if rowCount
			} else {
				throw new PDOException("Erro: não foi possível executar o comando.");
			} // if execute
		} catch (PDOException $erro) {
			echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.querySelector('#erro').innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../paginas/contato.php'>";
		} // try/catch
	} // function
?>
