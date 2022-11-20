<?php
  if (session_status() == PHP_SESSION_NONE) session_start();
	require "../../../../assets/funcoes/acesso/verifica-login.php";
	$_SESSION["pagina"] = "restrita";
	verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="../../../../assets/estilos/root.css">
		<link rel="stylesheet" href="../../../../assets/estilos/geral.css">
		<link rel="stylesheet" href="../../../../assets/estilos/mainBtn.css">
		<link rel="stylesheet" href="../../../../assets/estilos/enviarTexto.css">
		<link rel="stylesheet" href="../../../../assets/estilos/botao.css">
		<link rel="stylesheet" href="../../../../assets/estilos/comentarios.css">
		<link rel="stylesheet" href="../../../../assets/estilos/gerenciador.css">

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>Responder Contato &vert; EnsinaDev</title>
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
				<a href="acesso/acessar-conta.php">
					<div class="iconeUsuario">
						<?php
							if (!isset($_SESSION["idUsuario"]) || $_SESSION["imgUsuario"] == null) {
								echo "<i class='fa-solid fa-user'></i>";
							} else {
								echo "<img src='../../../../assets/img/" . $_SESSION["imgUsuario"] . "' class='fotoPerfilPequena' />";
							}
						?>
					</div>
				</a>
			</div>
		</header>

		<div class="voltar">
			<a href="./mensagensContato.php">
				<i class="fa-solid fa-arrow-left-long"></i>
			</a>
		</div>

		<main>
			<section class="containerComentarios">
				<?php
					require "../../../../assets/funcoes/conexao.php";

					$Comando = $conexao -> prepare ("SELECT * FROM TB_CONTATO WHERE ID_CONTATO = ?");
					$Comando -> bindParam(1, $_SESSION["idMensagem"]);

					try {
						if($Comando -> execute()) {
							if ($Comando -> rowCount() > 0) {
								while($linha = $Comando -> fetch(PDO::FETCH_OBJ)){
									echo "<form action='../../../assets/funcoes/contato/admContato.php' method='post' class='comentario'>";
									echo   "<input type='text' name='idMensagem' value='" . $linha -> ID_CONTATO . "' readonly />";
									echo 	 "<div class='usuario'>";
									echo 		 "<a href='../../../paginas/acesso/acessar-conta.php'>";
									echo 			 "<div class='iconeUsuario'>";
									echo 				 "<i class='fa-solid fa-user'></i>";
									echo 			 "</div>";
									echo 		 "</a>";
									echo 	 "</div>";
									echo 	 "<textarea name='pergunta' readonly>";
									echo 		 $linha -> TEXTO_CONTATO;
									echo   "</textarea>";
									echo "</form>";
								} // if while
							} else {
								echo "<p style='text-align:center;'>Não foi possível encontrar a pergunta!</p>";
							}// if rowCount
						} else {
							throw new PDOException("Erro: não foi possível executar o comando.");
						} // if execute
					} catch (PDOException $erro) {
						echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
						echo "<script>alert(document.querySelector('#erro').innerText);</script>";
						echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/areaAdm/perguntasContato.php'>";
					}
				?>
			</section>

			<section class="containerEnviarTexto">
				<form action="../../../../assets/funcoes/contato/respondeContato.php" method="post" class="frmEnviarTexto">
					<textarea name="campoTexto" id="campoTexto" class="campoTexto" maxlength="2000" placeholder="Digite um comentário..."></textarea>
					<a href="#" class="btnItem">
						<button type="submit" name="btnSubmit" class="btnResponder">Responder</button>
					</a>
				</form>
			</section>
		</main>

		<footer class="rodapeFlex">
			<p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
		</footer>
	</body>
</html>