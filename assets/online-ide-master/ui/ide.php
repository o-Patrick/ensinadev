<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- estilos -->
		<link rel="stylesheet" href="../../estilos/root.css">
		<link rel="stylesheet" href="../../estilos/geral.css">
		<link rel="stylesheet" href="../../estilos/mainBtn.css">
		<link rel="stylesheet" href="../../estilos/gerenciador.css">
		<link rel="stylesheet" href="css/style.css">

		<!-- scripts -->
		<script src="https://kit.fontawesome.com/33301695b5.js" crossorigin="anonymous" defer></script>

		<title>EnsinaDev</title>
	</head>
	<body>
		<header class="containerFlex">
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<h1>EnsinaDev</h1>
				</a>
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
						<?php
							if (!isset($_SESSION["idUsuario"]) || $_SESSION["imgUsuario"] == null) {
								echo "<i class='fa-solid fa-user'></i>";
							} else {
								echo "<img src='../../img/" . $_SESSION["imgUsuario"] . "' class='fotoPerfilPequena' />";
							}
						?>
					</div>
				</a>
			</div>
		</header>

    <div class="control-panel">
        Select Language:
        &nbsp; &nbsp;
        <select id="languages" class="languages" onchange="changeLanguage()">
            <option value="html"> HTML e CSS </option>
            <option value="php"> PHP </option>
            <option value="node"> JavaScript </option>
        </select>
    </div>

    <div class="button-container">
        <button class="btn" onclick="executeCode()"> Executar </button>
    </div>
    
    <div class="containerIde">
        <div class="esquerda" id="esquerda">
            <div class="editor" id="editor"></div>
        </div>
        <div class="direita" id="direita">
            <div class="output" id="output"></div>
            <!-- <iframe src="" frameborder="0" class="output"></iframe> -->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/lib/ace.js"></script>
    <script src="js/lib/theme-monokai.js"></script>
    <script src="js/ide.js"></script>
    <script>
        if (sessionStorage.getItem('codigoExemplo') !== null) {
            // pega o código
            const  codigo = sessionStorage.getItem('codigoExemplo');

            // separa o código em um vetor
            let vetorAux = codigo;
            vetorAux = vetorAux.split('\n');

            // remove os dois primeiros e dois últimos itens do vetor
            vetorAux.shift(vetorAux[0])
            vetorAux.shift(vetorAux[0])
            vetorAux.pop(vetorAux[Number(vetorAux.length)-1])
            vetorAux.pop(vetorAux[Number(vetorAux.length)-1])

            // passa o vetor para continuar formatação
            let codTratado = vetorAux;

            // seleciona editor para inserir código
            let editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai");
            editor.getSession().setMode("ace/mode/javascript");
            let posicao = {
                    row: 0,
                    column: 0
                };

            // termina de formatar o código e insere no editor
            for (let i = 0; i < codTratado.length; i++) {
                // tira os espaços antes, troca &nbsp;, <br>, < e >
                codTratado[i] = codTratado[i].trim();
                codTratado[i] = codTratado[i].replace(/&nbsp;/g, ' ');
                codTratado[i] = codTratado[i].replace(/\<br\>/g, '');
                codTratado[i] = codTratado[i].replace(/&lt;/g, '<');
                codTratado[i] = codTratado[i].replace(/&gt;/g, '>');
                codTratado[i] = codTratado[i].replace(/\<span class="escondido"\>|\<\/span\>/g, '');

                posicao.row = i;
                editor.session.insert(posicao, codTratado[i] + '\n');
            }
        }
    </script>

    <footer class="rodapeFlex">
        <p class="direitos">Copyright &copy; 2022 EnsinaDev &vert; ETEC Lauro Gomes</p>
    </footer>
</body>
</html>