<?php
  function fotoPerfil($conexao) {
    // $numUsuario = 1;

    // O SELECT ABAIXO NÃO FUNCIONA
    try{
      $comando = $conexao -> prepare("SELECT IMAGEM_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
      $comando -> bindParam(1, $numUsuario);
      // if ($_SESSION["pagina"] === "item") {
      //   $comando -> bindParam(1, $numUsuario);
      // } else {
      //   $comando -> bindParam(1, $_SESSION["idUsuario"]);
      // }

      // $numUsuario++;

      if($comando -> execute()){
        if($comando -> rowCount() > 0){
          $linha = $comando -> fetch(PDO::FETCH_OBJ);
          $imgUsuario = $linha -> IMAGEM_USUARIO;
          // e se o nome dado à imagem for igual ao id_usuario (substituindo a anterior sempre)?
          if ($_SESSION["pagina"] === "") {
            if ($imgUsuario !== null) {
              echo "<img src='../../assets/img/" . $imgUsuario . "' class='fotoPerfil' />";
            } else {
              echo "<img src='../../assets/img/padrao.jpg' class='fotoPerfil' />";
            }
          } else {
            if ($imgUsuario !== null) {
              echo "<img src='../../assets/img/" . $imgUsuario . "' class='fotoPerfilPequena' />";
            } else {
              echo "<img src='../../assets/img/padrao.jpg' class='fotoPerfilPequena' />";
            }
          }
        } else{
          echo "<script>console.log('Não foi possível encontrar a imagem do usuário!');</script>";
        }
      } else{
        throw new PDOException("Erro: não foi possível executar o comando");
      }
    } catch(PDOException $erro){
      echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
      echo "<script>console.log(document.querySelector(#erro).innerText);</script>";
    } // try/catch
  } // function
?>
