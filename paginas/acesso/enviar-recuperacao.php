<?php
	session_start();
	// página requer login para ser acessada
	require "../../assets/funcoes/acesso/verifica-login.php";
	$_SESSION["pagina"] = "recuperar-senha";
	verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="../../assets/estilos/root.css">
		<link rel="stylesheet" href="../../assets/estilos/geral.css">
		<link rel="stylesheet" href="../../assets/estilos/formulario.css">
		<link rel="stylesheet" href="../../assets/estilos/botao.css">

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>Recuperar senha &vert; EnsinaDev</title>
	</head>
	<body>
		<header class="containerFlex">
			<!-- logo -->
			<div class="logo">
				<a href="../../index.php">
					<h1>EnsinaDev</h1>
				</a>
			</div>

			<!-- menu -->
			<div class="menuPrincipal">
				<nav>
					<menu>
						<ul class="lista containerFlex linkMenu">
							<a href="../../index.php" class="itemMenu linkMenu">
								<li>Home</li>
							</a>
							<a href="../faq.php" class="itemMenu linkMenu">
								<li>FAQ</li>
							</a>
							<a href="../sobre-nos.php" class="itemMenu linkMenu">
								<li>Sobre nós</li>
							</a>
							<a href="../contato.php" class="itemMenu linkMenu">
								<li>Contato</li>
							</a>
						</ul>
					</menu>
				</nav>
			</div>

			<!-- usuário -->
			<div class="usuario">
				<a href="../acesso/acessar-conta.php">
					<div class="iconeUsuario">
						<i class="fa-solid fa-user"></i>
					</div>
				</a>
			</div>
		</header>

		<main class="containerFlex">
			<section class="componenteCentral">
				<h1 class="titulo titulo1">Enviar recuperação</h1>
				<form action="../../assets/funcoes/acesso/enviar-recuperacao.php" method="post">
					<div class="frmCampo">
						<label for="email">E-mail <span class="frmObrigatorio">*</span></label>
						<input type="email" name="email" class="frmUsuarioEmail" id="email" maxlength="80" required>
					</div>
					<div class="frmLink acessarConta">
						<a href="acessar-conta.php">
							<p>Voltar para o login</p>
						</a>
					</div>
					<button type="submit" name="btnSubmit">Enviar link</button>
				</form>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>