<?php
  session_start();

  require "../conexao.php";

  if (isset($_POST["btnSubmit"])) {
    if (isset($_SESSION["emailRec"])) $email = $_SESSION["emailRec"];
    if (isset($_POST["novaSenha"])) $novaSenha = $_POST["novaSenha"];
    if (isset($_POST["repeteNovaSenha"])) $repeteNovaSenha = $_POST["repeteNovaSenha"];

    // echo "Nova senha " . $novaSenha . " e-mail " . $email;
    // exit;
    try{
      $comando = $conexao -> prepare("SELECT SENHA_USUARIO FROM TB_USUARIO WHERE EMAIL_USUARIO = ?");
      $comando -> bindParam(1, $email);

      if($comando -> execute()){
        if($comando -> rowCount() > 0){
          $linha = $comando -> fetch(PDO::FETCH_OBJ);
          $senhaBco = $linha -> SENHA_USUARIO;
          echo $senhaBco;
        } else {
          echo "<script> console.log('Não foi possível selecionar a senha atual'); </script>";
          echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
        }
      } else{
        throw new PDOException("Erro: não foi possível executar o comando");
      }
    } catch(PDOException $erro){
      echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
      echo "<script> console.log(document.querySelector('#erro').innerText); </script>";
      echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php'>";
    } // try/catch

    if ($novaSenha !== $senhaBco) {
      if ($novaSenha === $repeteNovaSenha) {
        try {
          $comando = $conexao -> prepare("UPDATE TB_USUARIO SET SENHA_USUARIO = ? WHERE EMAIL_USUARIO = ?");
          $comando -> bindParam(1, $novaSenha);
          $comando -> bindParam(2, $email);

          unset($email);
          unset($senhaBco);
          unset($novaSenha);
          unset($repeteNovaSenha);

          if($comando -> execute()){
            if($comando -> rowCount() > 0){
              echo "<script>alert('Senha alterada com sucesso!');</script>";
              echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/acessar-conta.php'>";
            } else {
              echo "<script>alert('Não foi possível alterar a senha');</script>";
              echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/recuperar-senha.php'>";
            }
          } else{
            throw new PDOException("Erro: não foi possível executar o comando");
          }
        } catch(PDOException $erro){
          echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
          echo "<script>alert(document.querySelector('#erro').innerText);</script>";
          echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/recuperar-senha.php'>";
        } // try/catch
      } else {
        echo "<script>alert('A senha nova está diferente da repetida!');</script>";
        echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/recuperar-senha.php'>";
      } // verifica nova senha
    } else {
      echo "<script>alert('A nova senha não pode ser igual à atual!');</script>";
      echo "<meta http-equiv='refresh' content='0; ../../../paginas/acesso/recuperar-senha.php'>";
    } // nova senha igual à antiga
  } // if isset btnSubmit
?>
