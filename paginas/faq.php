<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="../assets/estilos/root.css">
		<link rel="stylesheet" href="../assets/estilos/geral.css">
		<link rel="stylesheet" href="../assets/estilos/mainBtn.css">
		<link rel="stylesheet" href="../assets/estilos/enviarTexto.css">
		<link rel="stylesheet" href="../assets/estilos/botao.css">
		<link rel="stylesheet" href="../assets/estilos/faq.css">

		<!-- font awesome -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<script src="../assets/funcoes/faq.js" defer></script>


		<title>FAQ &vert; EnsinaDev</title>
	</head>
	<body>
		<header class="containerFlex">
			<!-- logo -->
			<div class="logo">
				<a href="../index.php">
					<img src="#" alt="EnsinaDev"/>
				</a>
			</div>

			<!-- menu -->
			<div class="menuPrincipal">
				<nav>
					<menu>
						<ul class="lista containerFlex linkMenu">
							<a href="../index.php" class="itemMenu linkMenu">
								<li>Home</li>
							</a>
							<a href="faq.php" class="itemMenu linkMenu">
								<li>FAQ</li>
							</a>
							<a href="sobre-nos.php" class="itemMenu linkMenu">
								<li>Sobre nós</li>
							</a>
							<a href="contato.php" class="itemMenu linkMenu">
								<li>Contato</li>
							</a>
						</ul>
					</menu>
				</nav>
			</div>

			<!-- usuário -->
			<div class="usuario">
				<a href="acesso/acessar-conta.php">
					<div class="iconeUsuario">
						<i class="fa-solid fa-user"></i>
					</div>
				</a>
			</div>
		</header>

		<main>
			<h2 class="titulo">FAQ</h2>

			<section class="containerFaq">
				<div class="acordeao">
					<button type="button" class="collapsible">Open Collapsible</button>
					<div class="content">
						<p>Lorem ipsum...</p>
					</div>
				</div>

				<div class="acordeao">
					<button type="button" class="collapsible">Open Collapsible</button>
					<div class="content">
						<p>Lorem ipsum...</p>
					</div>
				</div>

				<div class="acordeao">
					<button type="button" class="collapsible">Open Collapsible</button>
					<div class="content">
						<p>Lorem ipsum...</p>
					</div>
				</div>

				<div class="acordeao">
					<button type="button" class="collapsible">Open Collapsible</button>
					<div class="content">
						<p>Lorem ipsum...</p>
					</div>
				</div>

				<div class="acordeao">
					<button type="button" class="collapsible">Open Collapsible</button>
					<div class="content">
						<p>Lorem ipsum...</p>
					</div>
				</div>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>