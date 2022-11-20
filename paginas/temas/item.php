<?php
	session_start();
	$_SESSION["pagina"] = "item";
	require "./../../assets/funcoes/temasItens/carregaItem.php";
	require "./../../assets/funcoes/temasItens/botaoMarcarConcluido.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- estilos -->
		<link rel="stylesheet" href="../../assets/estilos/root.css" />
		<link rel="stylesheet" href="../../assets/estilos/geral.css" />
		<link rel="stylesheet" href="../../assets/estilos/mainBtn.css" />
		<link rel="stylesheet" href="../../assets/estilos/item.css" />
		<link rel="stylesheet" href="../../assets/estilos/comentarios.css" />
		<link rel="stylesheet" href="../../assets/estilos/enviarTexto.css" />
		<link rel="stylesheet" href="../../assets/estilos/gerenciador.css" />
		<link rel="stylesheet" href="../../assets/estilos/btnVoltar.css" />
		<link rel="stylesheet" href="../../assets/estilos/botao.css"/>
		<link rel="stylesheet" href="../../assets/estilos/faq.css" />

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>
		<script src="../../assets/funcoes/comentarios/responde-comentario.js" defer></script>
		<script src="../../assets/funcoes/comentarios/btn-ver.js" defer></script>
		<!-- editor -->
		<script>
			function carregaEditor(i) {
				const codigoExemplo = document.getElementsByClassName('codigo');
				sessionStorage.setItem('codigoExemplo', codigoExemplo[i].innerHTML);
				open("./../../assets/online-ide-master/ui/ide.html", '_blank');
			}
		</script>
		<!-- voltar ao topo -->
		<script>
			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
				document.body.scrollTop = 0; // For Safari
				document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			} 
		</script>

		<title>EnsinaDev</title>
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
							<a href="../../paginas/faq.php" class="itemMenu linkMenu">
								<li>FAQ</li>
							</a>
							<a href="../../paginas/sobre-nos.php" class="itemMenu linkMenu">
								<li>Sobre nós</li>
							</a>
							<a href="../../paginas/contato.php" class="itemMenu linkMenu">
								<li>Contato</li>
							</a>
						</ul>
					</menu>
				</nav>
			</div>

			<!-- usuário -->
			<div class="usuario">
				<a href="../../paginas/acesso/acessar-conta.php">
					<div class="iconeUsuario">
						<i class="fa-solid fa-user"></i>
					</div>
				</a>
			</div>
		</header>

		<!-- botão voltar -->
		<?php
			echo "<div class='voltar'>";
			echo 	"<form action='tema.php' method='post'>";
			echo 		"<button type='submit' name='btnTema' value='" . $_SESSION["tema"] . "'>";
			echo 			"<i class='fa-solid fa-arrow-left-long'></i>";
			echo 		"</button>";
			echo 	"</form>";
			echo "</div>";
		?>

		<main>
			<article class="conteudoItem">
				<?php
					carregaItem();
					botaoMarcarConcluido();
				?>
			</article>

			<!-- onde o usuário comenta -->
			<section class="componenteCentral containerFlex containerComentarios containerResponder">
				<div id="comentarioOriginal"></div>

				<form action="../../assets/funcoes/comentarios/insereComentario.php" method="post" id="frmEnviarComentario">
					<textarea name="campoComentario" id="campoComentario" class="campoComentario" maxlength="2000" placeholder="Digite um comentário..."></textarea>
					<a href="#" class="btnItem">
						<button name="btnSubmit" class="btn">Enviar</button>
					</a>
				</form>
			</section>

			<!-- mostra os comentários -->
			<section class="containerComentarios">
				<?php require "./../../assets/funcoes/comentarios/carregaComentarios.php"; ?>
			</section> <!-- containerComentarios -->
		</main>

		<button onclick="topFunction()" id="myBtn" title="Go to top">&uparrow;</button> 
		
		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>
