<?php session_start(); ?>

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
		<script>
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

		<title>Recuperar senha &vert; EnsinaDev</title>
	</head>
	<body>
		<header class="containerFlex">
			<!-- logo -->
			<div class="logo">
				<a href="../../index.php">
					<img src="#" alt="EnsinaDev"/>
				</a>
			</div>

			<!-- pesquisar -->
			<div class="areaBuscaMenu">
				<form name="frmBusca" class="frmBusca">
					<input type="search" name="barraPesquisa" class="barraPesquisa" maxlength="20" placeholder="Buscar..."/>
					<button type="button" name="btnPesquisar" class="btnPesquisar">
						<i class="fa-solid fa-magnifying-glass"></i>
					</button>
				</form>
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
				<h1 class="titulo titulo1">Recuperar senha</h1>
				<form action="../../assets/funcoes/acesso/recuperar-senha.php" method="post">
					<?php
						if (isset($_GET["email"])) $_SESSION["emailRec"] = $_GET["email"];

						echo "<input type='text' name='email' style='display:none;' value='" . $_SESSION["emailRec"] . "' readonly />";
					?>

					<!-- nova senha -->
					<div class="frmCampo">
						<label for="novaSenha">Nova senha <span class="frmObrigatorio">*</span></label>

						<input type="password" name="novaSenha" class="frmSenha" id="novaSenha" maxlength="20" placeholder="Nova senha" tabindex="1" required>

						<button type="button" onclick=mostrarNovaSenha()>
							<i class="fa-solid fa-eye"></i>
						</button>
					</div>

					<!-- repetir nova senha -->
					<div class="frmCampo">
						<label for="repeteNovaSenha">Repetir nova senha <span class="frmObrigatorio">*</span></label>

						<input type="password" name="repeteNovaSenha" class="frmSenha" id="repeteNovaSenha" maxlength="20" placeholder="Repetir nova senha" tabindex="2" required>

						<button type="button" onclick=mostrarRepeteNovaSenha()>
							<i class="fa-solid fa-eye"></i>
						</button>
					</div>

					<div class="frmLink acessarConta">
						<a href="acessar-conta.php">
							<p>Voltar para o login</p>
						</a>
					</div>
					<button type="submit" name="btnSubmit">Confirmar</button>
				</form>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>