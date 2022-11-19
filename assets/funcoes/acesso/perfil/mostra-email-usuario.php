<?php
  function mostraEmailUsuario($conexao) {
    try{
      $comando = $conexao -> prepare("SELECT EMAIL_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
      $comando -> bindParam(1, $_SESSION["idUsuario"]);

      if($comando -> execute()){
        if($comando -> rowCount() > 0){
          $linha = $comando -> fetch(PDO::FETCH_OBJ);
          $emailUsuario = $linha -> EMAIL_USUARIO;
        } else{
          echo "<script>console.log('Não foi possível encontrar o nome do usuário!');</script>";
        }
      } else{
        throw new PDOException("Erro: não foi possível executar o comando");
      }
    } catch(PDOException $erro){
      echo "<p style='display:none;'>Erro: " . $erro -> getMessage() . "</p>";
      echo "<script>console.log(document.getElementsByTagName('p')[0].innerText);</script>";
    } // try/catch

    return $emailUsuario;
  } // function
?>