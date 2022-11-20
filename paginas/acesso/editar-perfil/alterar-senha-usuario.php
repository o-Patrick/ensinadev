<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="../../../assets/estilos/root.css">
		<link rel="stylesheet" href="../../../assets/estilos/geral.css">
		<link rel="stylesheet" href="../../../assets/estilos/formulario.css">
		<link rel="stylesheet" href="../../../assets/estilos/botao.css">
		<link rel="stylesheet" href="../../../assets/estilos/gerenciador.css">

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>
		<script>
			function mostrarSenhaAtual() {
				const senhaAtual = document.querySelector("#senhaAtual");

				if (senhaAtual.type == "password") {
					senhaAtual.type = "text";
				} else {
					senhaAtual.type ="password";
				}
			}

			function mostrarNovaSenha() {
				const novaSenha = document.querySelector("#novaSenha");

				if (novaSenha.type == "password") {
					novaSenha.type = "text";
				} else {
					novaSenha.type ="password";
				}
			}

			function mostrarRepeteNovaSenha() {
				const repeteNovaSenha = document.querySelector("#repeteNovaSenha");

				if (repeteNovaSenha.type == "password") {
					repeteNovaSenha.type = "text";
				} else {
					repeteNovaSenha.type ="password";
				}
			}
		</script>

		<title>Alterar senha &vert; EnsinaDev</title>
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
						<?php
							if (!isset($_SESSION["idUsuario"]) || $_SESSION["imgUsuario"] == null) {
								echo "<i class='fa-solid fa-user'></i>";
							} else {
								echo "<img src='../../../assets/img/" . $_SESSION["imgUsuario"] . "' class='fotoPerfilPequena' />";
							}
						?>
					</div>
				</a>
			</div>
		</header>

		<!-- botão voltar -->
		<div class="voltar">
			<a href="editar-perfil.php">
				<button>
					<i class="fa-solid fa-arrow-left-long"></i>
				</button>
			</a>
		</div>

		<main class="containerFlex">
			<section class="componenteCentral">
				<h1 class="titulo titulo1">Alterar senha</h1>
				<form action="../../../assets/funcoes/acesso/editar-perfil/alterar-senha-usuario.php" method="post">
					<div class="frmCampo">
						<label for="senhaAtual">Senha atual <span class="frmObrigatorio">*</span></label>

						<input type="password" name="senhaAtual" class="frmSenha" id="senhaAtual" maxlength="20" placeholder="Senha atual" tabindex="1" required>

						<button type="button" onclick=mostrarSenhaAtual()>
							<i class="fa-solid fa-eye"></i>
						</button>
					</div>

					<div class="frmCampo">
						<label for="novaSenha">Nova senha <span class="frmObrigatorio">*</span></label>

						<input type="password" name="novaSenha" class="frmSenha" id="novaSenha" maxlength="20" placeholder="Nova senha" tabindex="2" required>

						<button type="button" onclick=mostrarNovaSenha()>
							<i class="fa-solid fa-eye"></i>
						</button>
					</div>

					<div class="frmCampo">
						<label for="repeteNovaSenha">Repetir nova senha <span class="frmObrigatorio">*</span></label>

						<input type="password" name="repeteNovaSenha" class="frmSenha" id="repeteNovaSenha" maxlength="20" placeholder="Repetir nova senha" tabindex="3" required>

						<button type="button" onclick=mostrarRepeteNovaSenha()>
							<i class="fa-solid fa-eye"></i>
						</button>
					</div>

					<button type="submit" name="btnSubmit" class="btnSubmit" id="btnSubmit" tabindex="4">Alterar</button>
				</form>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>