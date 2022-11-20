<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

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
	<link rel="stylesheet" href="../assets/estilos/gerenciador.css">
	<link rel="stylesheet" href="../assets/estilos/sobreNos.css">

	<!-- scripts -->
	<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

	<title>Sobre nós &vert; EnsinaDev</title>
</head>
<body>
	<header class="containerFlex">
		<!-- logo -->
		<div class="logo">
			<a href="../index.php">
				<h1>EnsinaDev</h1>
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
					<?php
						if (!isset($_SESSION["idUsuario"]) || $_SESSION["imgUsuario"] == null) {
							echo "<i class='fa-solid fa-user'></i>";
						} else {
							echo "<img src='../assets/img/" . $_SESSION["imgUsuario"] . "' class='fotoPerfilPequena' />";
						}
					?>
				</div>
			</a>
		</div>
	</header>

	<main>
		<article class="componenteCentral sobreNos">
			<h2>Sobre nós</h2>

			<p>O EnsinaDev nasceu do desejo de ajudar colegas de classe da sua equipe desenvolvedora. Algumas pessoas buscaram ajuda com matérias e, vendo que um grande número de outros alunos também tinham dificuldade de absorver os conteúdos das aulas, nós entedemos que era necessário produzir conteúdo didático que pudesse suprir essa necessidade, agrupando temas das linguagens estudadas em um único lugar e de forma acessível, fugindo dos termos mais técnicos usados por sites similares, tendo também espaço para testar os códigos passadas, além de toda uma comunidade que amplia o apoio aos estudantes.</p>

			<p>A equipe EnsinaDev acredita que o ensino deve ser gratuito, de qualidade e que possa realmente ser incorporado na visão de mundo das pessoas. Isso é o que nos guia.</p>
		</article>
	</main>

	<footer class="rodapeFlex">
		<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
	</footer>
</body>
</html>