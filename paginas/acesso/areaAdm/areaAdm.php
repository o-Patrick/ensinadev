<?php
  session_start();
	require "../../../assets/funcoes/acesso/verifica-login.php";
	$_SESSION["pagina"] = "restrita";
	verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- estilos -->
		<link rel="stylesheet" href="../../../assets/estilos/root.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/geral.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/mainBtn.css">

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>Área de administração &vert; EnsinaDev</title>
	</head>
	<body>
		<header class="containerFlex">
			<!-- logo -->
			<div class="logo">
				<a href="../../../index.php">
					<h1>EnsinaDev</h1>
				</a>
			</div>

			<!-- menu -->
			<div class="menuPrincipal">
				<nav>
					<menu>
						<ul class="lista containerFlex linkMenu">
							<a href="../../../index.php" class="itemMenu linkMenu">
								<li>Home</li>
							</a>
							<a href="../../faq.php" class="itemMenu linkMenu">
								<li>FAQ</li>
							</a>
							<a href="../../sobre-nos.php" class="itemMenu linkMenu">
								<li>Sobre nós</li>
							</a>
							<a href="../../contato.php" class="itemMenu linkMenu">
								<li>Contato</li>
							</a>
						</ul>
					</menu>
				</nav>
			</div>

			<!-- usuário -->
			<div class="usuario">
				<a href="../../acesso/acessar-conta.php">
					<div class="iconeUsuario">
						<i class="fa-solid fa-user"></i>
					</div>
				</a>
			</div>
		</header>

		<main class="containerFlex">
			<section class="componenteCentral">
				<h1 class="titulo titulo1">Área de administração</h1>
        <!-- grupo de botões -->
        <section class="botoesCentrais">
					<!-- apenas margem do botão -->
					<div class="btnMargem">
						<!-- botão -->
						<a href="../perfil.php">
							<div class="mainBtn">
								<label>Meu perfil</label>
							</div>
						</a>
					</div>
					<!-- apenas margem do botão -->
					<div class="btnMargem">
						<!-- botão -->
						<a href="gerenciadorPerfis.php">
							<div class="mainBtn">
								<label>Gerenciador de perfis</label>
							</div>
						</a>
					</div>
					<!-- apenas margem do botão -->
					<div class="btnMargem">
						<!-- botão -->
						<a href="contato/mensagensContato.php">
							<div class="mainBtn">
								<label>Mensagens de contato</label>
							</div>
						</a>
					</div>
        </section>
      </section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
</body>
</html>