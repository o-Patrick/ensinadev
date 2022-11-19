<?php
	session_start();
	$_SESSION["pagina"] = "tema";
	require "../../assets/funcoes/conexao.php";
	require "../../assets/funcoes/acesso/perfil/mostra-progresso_tema.php";
	require "../../assets/funcoes/temasItens/carregaTema.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="../../assets/estilos/root.css" />
		<link rel="stylesheet" href="../../assets/estilos/geral.css" />
		<link rel="stylesheet" href="../../assets/estilos/mainBtn.css" />
		<link rel="stylesheet" href="../../assets/estilos/tema.css" />
		<link rel="stylesheet" href="../../assets/estilos/progressoTema.css" />
		<link rel="stylesheet" href="../../assets/estilos/btnVoltar.css" />

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>Tema &vert; EnsinaDev</title>
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

		<!-- botão voltar -->
		<div class="voltar">
			<a href="../../index.php">
				<i class="fa-solid fa-arrow-left-long"></i>
			</a>
		</div>

		<?php
			if (isset($_POST["btnTema"])) {
				$_SESSION["tema"] = $_POST["btnTema"];
			}

			if (isset($_SESSION["tipoUsuario"]) && $_SESSION["tipoUsuario"] === "E") {
				mostraProgresso($conexao);
			}
			carregaTema();
		?>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>
