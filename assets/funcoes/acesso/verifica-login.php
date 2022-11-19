<?php
	function verificaLogin(){
		// verifica se o usuário está logado
		if(!isset($_SESSION["idUsuario"])){
			if($_SESSION["pagina"] === "restrita"){
				echo "<meta http-equiv='refresh' content='0; ../../../../../ensinadev_mao/index.php'/>";
			} // perfil
		} else {
			if ($_SESSION["tipoUsuario"] === "E") {
				if($_SESSION["pagina"] === "acessar-conta"){
					echo "<meta http-equiv='refresh' content='0; ../../paginas/acesso/perfil.php'/>";
				} elseif($_SESSION["pagina"] === "criar-conta"){
					echo "<meta http-equiv='refresh' content='0; ../../paginas/acesso/perfil.php'/>";
				} elseif($_SESSION["pagina"] === "recuperar-senha"){
					echo "<meta http-equiv='refresh' content='0; ../../paginas/acesso/perfil.php'/>";
				} // if outras páginas
			} elseif ($_SESSION["tipoUsuario"] === "A") {
				if($_SESSION["pagina"] === "acessar-conta"){
					echo "<meta http-equiv='refresh' content='0; ../../paginas/acesso/areaAdm/areaAdm.php'/>";
				} elseif($_SESSION["pagina"] === "criar-conta"){
					echo "<meta http-equiv='refresh' content='0; ../../paginas/acesso/areaAdm/areaAdm.php'/>";
				} elseif($_SESSION["pagina"] === "recuperar-senha"){
					echo "<meta http-equiv='refresh' content='0; ../../paginas/acesso/areaAdm/areaAdm.php'/>";
				} // if outras páginas
			} // if tipo usuario
		} // if logado
	} // verificaLogin()
?>
