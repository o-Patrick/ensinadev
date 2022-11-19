<?php
	session_start();
	unset($_SESSION["idUsuario"]);
	unset($_SESSION["tipoUsuario"]);
	session_destroy();
	echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
?>