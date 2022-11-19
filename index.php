<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="assets/estilos/root.css">
		<link rel="stylesheet" href="assets/estilos/geral.css">
		<link rel="stylesheet" href="assets/estilos/mainBtn.css">

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>EnsinaDev</title>
	</head>
	<body>
		<header class="containerFlex">
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
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
							<a href="index.php" class="itemMenu linkMenu">
								<li>Home</li>
							</a>
							<a href="paginas/faq.php" class="itemMenu linkMenu">
								<li>FAQ</li>
							</a>
							<a href="paginas/sobre-nos.php" class="itemMenu linkMenu">
								<li>Sobre nós</li>
							</a>
							<a href="paginas/contato.php" class="itemMenu linkMenu">
								<li>Contato</li>
							</a>
						</ul>
					</menu>
				</nav>
			</div>

			<!-- usuário -->
			<div class="usuario">
				<a href="paginas/acesso/acessar-conta.php">
					<div class="iconeUsuario">
						<i class="fa-solid fa-user"></i>
					</div>
				</a>
			</div>
		</header>

		<main class="containerFlex">
			<!-- grupo de botões -->
			<section class="botoesCentrais">
				<form action="paginas/temas/tema.php" method="post">
					<!-- linha de botões -->
					<div class="linha">
						<!-- apenas margem do botão -->
						<div class="btnMargem">
							<!-- botão -->
							<button type="submit" class="mainBtn" name="btnTema" value="html">
								<label>HTML</label>
							</button>
						</div>
						<!-- apenas margem do botão -->
						<div class="btnMargem">
							<!-- botão -->
							<button type="submit" class="mainBtn" name="btnTema" value="css">
								<label>CSS</label>
							</button>
						</div>
					</div>
					<!-- linha de botões -->
					<div class="linha">
						<!-- apenas margem do botão -->
						<div class="btnMargem">
							<!-- botão -->
							<button type="submit" class="mainBtn" name="btnTema" value="javascript">
								<label>JavaScript</label>
							</button>
						</div>
						<!-- apenas margem do botão -->
						<div class="btnMargem">
							<!-- botão -->
							<button type="submit" class="mainBtn" name="btnTema" value="php">
								<label>PHP</label>
							</button>
						</div>
					</div>
				</form>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>