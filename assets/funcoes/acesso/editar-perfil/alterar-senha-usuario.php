<?php
  session_start();

  require "../../conexao.php";

  if (isset($_POST["btnSubmit"])) {
    try{
      $comando = $conexao -> prepare("SELECT SENHA_USUARIO FROM TB_USUARIO WHERE ID_USUARIO = ?");
      $comando -> bindParam(1, $_SESSION["idUsuario"]);

      if($comando -> execute()){
        if($comando -> rowCount() > 0){
          $linha = $comando -> fetch(PDO::FETCH_OBJ);
          $senhaBco = $linha -> SENHA_USUARIO;
        } else {
          echo "<script>alert('Não foi possível selecionar o valor');</script>";
          echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
        }
      } else{
        throw new PDOException("Erro: não foi possível executar o comando");
      }
    } catch(PDOException $erro){
      echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
      echo "<script>alert(document.querySelector('#erro').innerText);</script>";
      echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
    } // try/catch

    if (isset($_POST["senhaAtual"])) {
      $senhaAtual = $_POST["senhaAtual"];
    }

    if (isset($_POST["novaSenha"])) {
      $novaSenha = $_POST["novaSenha"];
    }

    if (isset($_POST["repeteNovaSenha"])) {
      $repeteNovaSenha = $_POST["repeteNovaSenha"];
    }

    if ($novaSenha !== $senhaBco) {
      if ($senhaAtual === $senhaBco) {
        if ($novaSenha === $repeteNovaSenha) {
          try{
            $comando = $conexao -> prepare("UPDATE TB_USUARIO SET SENHA_USUARIO = ? WHERE ID_USUARIO = ?");
            $comando -> bindParam(1, $novaSenha);
            $comando -> bindParam(2, $_SESSION["idUsuario"]);

            unset($senhaBco);
            unset($senhaAtual);
            unset($novaSenha);
            unset($repeteNovaSenha);

            if($comando -> execute()){
              if($comando -> rowCount() > 0){
                echo "<script>alert('Senha alterada com sucesso!');</script>";
                echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-senha-usuario.php'>";
              } else {
                echo "<script>alert('Não foi possível alterar a senha');</script>";
                echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-senha-usuario.php'>";
              }
            } else{
              throw new PDOException("Erro: não foi possível executar o comando");
            }
          } catch(PDOException $erro){
            echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
            echo "<script>alert(document.querySelector('#erro').innerText);</script>";
            echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-senha-usuario.php'>";
          } // try/catch
        } else {
          echo "<script>alert('A senha nova está diferente da repetida!');</script>";
          echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-senha-usuario.php'>";
        } // verifica nova senha
      } else {
        echo "<script>alert('Senha atual incorreta!');</script>";
        echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-senha-usuario.php'>";
      } // verifica senha atual
    } else {
      echo "<script>alert('A nova senha não pode ser igual à atual!');</script>";
      echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-senha-usuario.php'>";
    } // nova senha igual à antiga
  } // if isset btnSubmit
?>
