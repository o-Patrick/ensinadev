<?php
  function fotoPerfil($conexao, $editar = "") {
    // pega a imagem do usuário
    try{
      $comando = $conexao -> prepare("SELECT IMAGEM_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
      $comando -> bindParam(1, $_SESSION["idUsuario"]);

      if($comando -> execute()){
        if($comando -> rowCount() > 0){
          $linha = $comando -> fetch(PDO::FETCH_OBJ);
          $imgUsuario = $linha -> IMAGEM_USUARIO;
          if ($editar === "") {
            if ($imgUsuario !== null) {
              echo "<img src='../../assets/img/" . $imgUsuario . "' class='fotoPerfil' />";
            } else {
              echo "<img src='../../assets/img/padrao.jpg' class='fotoPerfil' />";
            }
          } else {
            if ($imgUsuario !== null) {
              echo "<img src='../../../assets/img/" . $imgUsuario . "' class='fotoPerfil' />";
            } else {
              echo "<img src='../../../assets/img/padrao.jpg' class='fotoPerfil' />";
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
