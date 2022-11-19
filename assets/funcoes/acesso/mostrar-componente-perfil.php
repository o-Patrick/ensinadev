<?php
	require "perfil/mostra-progresso_perfil.php";

	function mostrarComponentePerfil($conexao, $idComentario = 0) {
		if (isset($_GET["mostrar"])) {
			$mostrar = $_GET["mostrar"];

			if ($mostrar === "feed") {
				require "perfil/mostra-feed.php";
			} else {
				mostraProgresso($conexao);
			}
		} else {
			if ($_SESSION["tipoUsuario"] === "E") {
				mostraProgresso($conexao);
			} else {
				require "perfil/mostra-feed.php";
			}
		} // if isset get mostrar
	} // function
?>
