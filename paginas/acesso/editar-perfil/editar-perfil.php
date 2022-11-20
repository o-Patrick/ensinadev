<?php
	session_start();
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

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>
		<script src="../../assets/funcoes/acesso/perfil/ver-mais_feed.js" defer></script> -->

		<script>
			function alteraNome() {
				const nomeUsuario = document.querySelector("#nomeUsuario");
				const btnAlteraNome = document.querySelector("#btnAlteraNome");

				if (nomeUsuario.readOnly == true) {
					nomeUsuario.removeAttribute("readonly");
					btnAlteraNome.innerText = "Concluir";
				} else {
					nomeUsuario.setAttribute("readonly", "true");
					btnAlteraNome.innerText = "Alterar";
				}
			}

			function alteraEmail() {
				const emailUsuario = document.querySelector("#emailUsuario");
				const btnAlteraEmail = document.querySelector("#btnAlteraEmail");

				if (emailUsuario.readOnly == true) {
					emailUsuario.removeAttribute("readonly");
					btnAlteraEmail.innerText = "Concluir";
				} else {
					emailUsuario.setAttribute("readonly", "true");
					btnAlteraEmail.innerText = "Alterar";
				}
			}

			function alteraSenha() {
				const senhaUsuario = document.querySelector("#senhaUsuario");
				const btnAlteraSenha = document.querySelector("#btnAlteraSenha");

				if (senhaUsuario.readOnly == true) {
					senhaUsuario.removeAttribute("readonly");
					btnAlteraSenha.innerText = "Concluir";
				} else {
					senhaUsuario.setAttribute("readonly", "true");
					btnAlteraSenha.innerText = "Alterar";
				}
			}
		</script>

		<title>Perfil &vert; EnsinaDev</title>
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
			<a href="./../perfil.php">
				<button>
					<i class="fa-solid fa-arrow-left-long"></i>
				</button>
			</a>
		</div>

		<main class="containerFlex">
			<div class="componenteCentral">
				<h1 class="titulo">Editar perfil</h1>
				<section class="componenteCentral">
					<!-- informações usuário + btn editar -->
					<form action="../../../assets/funcoes/acesso/editar-perfil/salvar-alteracoes.php" method="post">
						<div class="dadosUsuario">
							<div class="fotoPerfil">
								<?php
									$editar = true;
									fotoPerfil($conexao, $editar);
								?>
								<a href="alterar-foto-usuario.php">
									<button type="button">Alterar</button>
								</a>
							</div>

							<div class="infoUsuario nomeUsuario">
								<?php echo "<input type='text' value='" . mostraNomeUsuario($conexao) . "' name='nomeUsuario' id='nomeUsuario' readonly />"; ?>
								<button type="button" id="btnAlteraNome" onclick=alteraNome()>Alterar</button>
							</div>

							<div class="infoUsuario emailUsuario">
								<?php echo "<input type='text' value='" . mostraEmailUsuario($conexao) . "' name='emailUsuario' id='emailUsuario' readonly />"; ?>
								<button type="button" id="btnAlteraEmail" onclick=alteraEmail()>Alterar</button>
							</div>

							<div class="infoUsuario senhaUsuario">
								<input type='password' value='               ' name='senhaUsuario' id='senhaUsuario' readonly />
								<a href="alterar-senha-usuario.php">
									<button type="button" name="btnSubmit" id="btnAlteraSenha">Alterar</button>
								</a>
							</div>
						</div>

						<!-- btns sair e excluir conta -->
						<div class="botoesPerfil">
							<div class="btnSair">
								<button type="submit" name="btnSubmit" class="btnSubmit" id="btnSubmit" tabindex="1">Salvar</button>
							</div>

							<div class="btnExcluir">
								<button type="submit" name="btnSubmit" class="btnSubmit" tabindex="2">Excluir conta</button>
							</div>
						</div>
					</form>
				</section>
			</div>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>
