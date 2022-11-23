<?php
	session_start();
	// página requer login para ser acessada
	require "../../assets/funcoes/acesso/verifica-login.php";
	$_SESSION["pagina"] = "criar-conta";
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
		<link rel="stylesheet" href="../../assets/estilos/btnVoltar.css" />
		<link rel="stylesheet" href="../../assets/estilos/botao.css"/>

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>Criar conta &vert; EnsinaDev</title>
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

		<!-- botão voltar -->
		<div class="voltar">
			<a href="acessar-conta.php">
				<i class="fa-solid fa-arrow-left-long"></i>
			</a>
		</div>

		<main class="containerFlex">
			<section class="componenteCentral">
				<h1 class="titulo titulo1">Criar conta</h1>
				<form action="../../assets/funcoes/acesso/criar-conta.php" method="post">
					<div class="frmCampo">
						<label for="usuario">Nome de usuário <span class="frmObrigatorio">*</span></label>
						<input type="text" name="usuario" class="frmUsuario" id="usuario" maxlength="20" tabindex="1" required>
					</div>
					<div class="frmCampo">
						<label for="email">E-mail <span class="frmObrigatorio">*</span></label>
						<input type="text" name="email" class="frmUsuarioEmail" id="email" maxlength="80" tabindex="2" required>
					</div>
					<div class="frmCampo">
						<label for="senha">Senha <span class="frmObrigatorio">*</span></label>
						<input type="password" name="senha" class="frmSenha" id="senha" maxlength="255" tabindex="3" required>
					</div>
					<div class="frmLink acessarConta">
						<a href="acessar-conta.php">
							<p tabindex="4">Já tem login?</p>
						</a>
					</div>
					<button type="submit" name="btnSubmit" class="btnSubmit" id="btnSubmit" tabindex="5">Criar</button>
				</form>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>