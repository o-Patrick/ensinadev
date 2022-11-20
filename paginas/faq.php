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
		<link rel="stylesheet" href="../assets/estilos/enviarTexto.css">
		<link rel="stylesheet" href="../assets/estilos/botao.css">
		<link rel="stylesheet" href="../assets/estilos/faq.css">
		<link rel="stylesheet" href="../assets/estilos/gerenciador.css">

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
			<article class="componenteCentral faq">
				<h2 class="titulo">FAQ</h2>
				<section class="containerFaq">

					<div class="acordeao">
						<button type="button" class="collapsible">O que é o EnsinaDev?</button>
						<div class="content">
							<p>O EnsinaDev é um site de ensino de programação em conteúdo textual! Buscamos entrar na linha de frente da educação de uma forma mais similar a sites de documentação das próprias linguagens ou de referências em geral, porém com nosso grande diferencial da busca pela maior didática possível, seja em cada conteúdo explicado, como na própria ordem destes, existindo contraste com os modelos de sites citados que normalmente possuem um linguajar mais técnico e uma organização de textos que não busca construir a escada do conhecimento degrau por degrau, como apenas mostrando temas em ordem alfabética.</p>
						</div>
					</div>

					<div class="acordeao">
						<button type="button" class="collapsible">O site tem cursos?</button>
						<div class="content">
							<p>Não. No momento, o EnsinaDev apenas possui um modelo de conteúdo textual. Porém, no futuro pretendemos ampliar nossas mídias, inclusive certificando nossos estudantes ;)</p>
						</div>
					</div>

					<div class="acordeao">
						<button type="button" class="collapsible">Os estudantes podem emitir certificados?</button>
						<div class="content">
							<p>Não. No momento, o EnsinaDev não possui um sistema de certificação porque não temos formas de avaliar os estudantes, garantindo que estes absorveram os conteúdos. Nos baseamos em um modelo auto-didata que serve de apoio da maneira que os alunos bem entenderem.</p>
						</div>
					</div>

					<div class="acordeao">
						<button type="button" class="collapsible">É possível testar o que estou aprendendo?</button>
						<div class="content">
							<p>Sim! Em todas as páginas de conteúdos existe ao menos um exemplo de código com um botão "Testar" ao lado, que leva o estudante ao nosso editor de código, onde podem ser executados códigos em HTML, CSS, JavaScript e PHP!</p>
						</div>
					</div>

					<div class="acordeao">
						<button type="button" class="collapsible">Onde posso tirar dúvidas?</button>
						<div class="content">
							<p>Prezamos muito pelo trabalho coletivo e a ajuda mútua, por isso criamos uma seção de comentários para cada conteúdo, onde os próprios estudantes podem ajudar uns aos outros ou serem ajudados pelos próprios administradores do site! Além disso, estamos à disposição de qualquer um na aba Contato do menu, onde você pode nos enviar qualquer dúvida, que responderemos por e-mail.</p>
						</div>
					</div>

				</section>
			</article>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>