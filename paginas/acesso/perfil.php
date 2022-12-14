<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
	require "../../assets/funcoes/conexao.php";
	// página requer login para ser acessada
	require "../../assets/funcoes/acesso/verifica-login.php";
	require "../../assets/funcoes/acesso/foto-perfil.php";
	require "../../assets/funcoes/acesso/nome-usuario.php";
	require "../../assets/funcoes/acesso/mostrar-componente-perfil.php";
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
		<link rel="stylesheet" href="../../assets/estilos/root.css"/>
		<link rel="stylesheet" href="../../assets/estilos/geral.css"/>
		<link rel="stylesheet" href="../../assets/estilos/formulario.css"/>
		<link rel="stylesheet" href="../../assets/estilos/botao.css"/>
		<link rel="stylesheet" href="../../assets/estilos/perfil.css"/>
		<link rel="stylesheet" href="../../assets/estilos/comentarios.css"/>
		<link rel="stylesheet" href="../../assets/estilos/gerenciador.css"/>
		<link rel="stylesheet" href="../../assets/estilos/btnVoltar.css" />
		<link rel="stylesheet" href="../../assets/estilos/progressoTema.css" />
		<link rel="stylesheet" href="../../assets/estilos/notificacoes.css" />
		<link rel="stylesheet" href="../../assets/estilos/gerenciador.css" />

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>
		<script src="ver-mais_feed.js"></script>

		<title>Perfil &vert; EnsinaDev</title>
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
								echo "<img src='../../assets/img/" . $_SESSION["imgUsuario"] . "' class='fotoPerfilPequena' />";
							}
						?>
					</div>
				</a>
			</div>
		</header>

		<!-- botão voltar -->
		<?php
			if ($_SESSION["tipoUsuario"] === "A") {
				echo "<a href='./areaAdm/areaAdm.php'>";
			} else {
				echo "<a href='../../index.php'>";
			}
		?>
			<div class="voltar">
				<i class="fa-solid fa-arrow-left-long"></i>
			</div>
		</a>

		<main class="containerFlex">
			<div class="componenteCentral">
				<h1 class="titulo">Meu perfil</h1>
				<section class="componenteCentral">
					<!-- informações usuário + btn editar -->
					<div class="dadosUsuario">
						<div class="fotoPerfil">
							<?php fotoPerfil($conexao); ?>
						</div>
						<div class="nomeUsuario">
							<?php echo "<p class='nomeUsuario'>" . mostraNomeUsuario($conexao) . "</p>"; ?>
						</div>
						<div class="editarPerfil">
							<a href="./editar-perfil/editar-perfil.php">
								<button>Editar perfil</button>
							</a>
						</div>
					</div>

					<!-- menu progresso/feed/favoritos/notificações -->
					<nav>
						<menu>
							<ul class="lista containerFlex">
								<!-- aparece apenas para estudante -->
								<?php
									if ($_SESSION["tipoUsuario"] === "E") {
										echo "<a href='perfil.php?mostrar=progresso' class='linkMenuPerfil' onclick='progressoEstudante()'>";
										echo   "<li class='itemMenuPerfil'>Progresso</li>";
										echo "</a>";
									}
								?>

								<a href="perfil.php?mostrar=feed" class="linkMenuPerfil">
								 <li class="itemMenuPerfil">Feed</li>
								</a>

								</a>
							</ul>
						</menu>
					</nav>

					<section class="componentesPerfil">
						<?php
							if (!isset($_POST["btnVerMais"])) {
								mostrarComponentePerfil($conexao);
							} else {
								mostrarComponentePerfil($conexao, $_POST["btnVerMais"]);
							}
						?>
					</section>

					<!-- btns sair e excluir conta -->
					<div class="botoesPerfil">
						<div class="btnSair">
							<a href="../../assets/funcoes/acesso/sair-conta.php">
								<button type="button" name="btnSubmit" class="btnSubmit" id="btnSubmit" tabindex="1">Sair da conta</button>
							</a>
						</div>
					</div>
				</section>
			</div>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>