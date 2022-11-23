<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
	require "../../../assets/funcoes/conexao.php";
	// página requer login para ser acessada
	require "../../../assets/funcoes/acesso/verifica-login.php";
	$_SESSION["pagina"] = "restrita";
	verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- estilos -->
		<link rel="stylesheet" href="../../../assets/estilos/root.css" />
		<link rel="stylesheet" href="../../../assets/estilos/geral.css" />
		<link rel="stylesheet" href="../../../assets/estilos/mainBtn.css" />
		<link rel="stylesheet" href="../../../assets/estilos/item.css" />
		<link rel="stylesheet" href="../../../assets/estilos/comentarios.css" />
		<link rel="stylesheet" href="../../../assets/estilos/enviarTexto.css" />
		<link rel="stylesheet" href="../../../assets/estilos/botao.css" />
		<link rel="stylesheet" href="../../../assets/estilos/gerenciador.css" />
		<link rel="stylesheet" href="../../../assets/estilos/btnVoltar.css" />
		<link rel="stylesheet" href="../../../assets/estilos/gerenciador.css" />

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>
		<script src="../../../assets/funcoes/acesso/adm-perfis/ver-perfil.js" defer></script>

		<title>Gerenciador de perfis &vert; EnsinaDev</title>
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
							<a href="../../../paginas/faq.php" class="itemMenu linkMenu">
								<li>FAQ</li>
							</a>
							<a href="../../../paginas/sobre-nos.php" class="itemMenu linkMenu">
								<li>Sobre nós</li>
							</a>
							<a href="../../../paginas/contato.php" class="itemMenu linkMenu">
								<li>Contato</li>
							</a>
						</ul>
					</menu>
				</nav>
			</div>

			<!-- usuário -->
			<div class="usuario">
				<a href="../../../paginas/acesso/acessar-conta.php">
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

		<div class="voltar">
			<a href="./areaAdm.php">
				<i class="fa-solid fa-arrow-left-long"></i>
			</a>
		</div>

		<main>
			<section class="containerComentarios">
				<?php
					require "../../../assets/funcoes/acesso/adm-perfis/adm-carrega-perfis.php";
				?>
			</section> <!-- containerComentarios -->
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>