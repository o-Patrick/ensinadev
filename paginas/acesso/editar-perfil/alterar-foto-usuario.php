<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
	require "../../../assets/funcoes/conexao.php";
	// página requer login para ser acessada
	require "../../../assets/funcoes/acesso/verifica-login.php";
	require "../../../assets/funcoes/acesso/foto-perfil.php";
	require "../../../assets/funcoes/acesso/nome-usuario.php";
	require "../../../assets/funcoes/acesso/perfil/mostra-email-usuario.php";
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
		<link rel="stylesheet" href="../../../assets/estilos/formulario.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/botao.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/perfil.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/comentarios.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/gerenciador.css"/>
		<link rel="stylesheet" href="../../../assets/estilos/btnVoltar.css" />
		<link rel="stylesheet" href="../../../assets/estilos/progressoTema.css" />
		<link rel="stylesheet" href="../../../assets/estilos/gerenciador.css"/>

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>Alterar foto &vert; EnsinaDev</title>
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
			<div class="componenteCentral">
        <form enctype="multipart/form-data" action="../../../assets/funcoes/acesso/editar-perfil/alterar-foto-usuario.php" method="post">
          <label for="">Selecione o arquivo</label>
          <input type="file" name="foto" id="" />

          <button type="submit" name="btnSubmit">Alterar</button>
        </form>
      </div>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>
