<?php
  if (session_status() == PHP_SESSION_NONE) session_start();

  require "../../conexao.php";

  if (isset($_SESSION["idUsuario"])) {
    if (isset($_POST["btnSubmit"])) {
      $foto = $_FILES["foto"];
      $pasta = "../../../img/";
      $nomeFoto = $foto["name"];
      $novoNomeFoto = uniqid();
      $extensao = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));
      $sucessoAlterar = move_uploaded_file($foto["tmp_name"], "$pasta$novoNomeFoto.$extensao");

      // erro
      if ($foto["error"]) {
        echo "<script> alert('Falha ao enviar arquivo') </script>";
        echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-foto-usuario.php' />";
      } // if error

      // arquivo maior que 5MB
      if ($foto["size"] > 5242880) {
        echo "<script> alert('Arquivo muito grande! Max: 5MB') </script>";
        echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-foto-usuario.php' />";
      } // if size < 5MB

      // extensão inválida
      if ($extensao != "jpg" && $extensao != "jpeg" && $extensao != "png") {
        echo "<script> alert('Tipo de arquivo inválido! Permitidos: jpg, jpeg e png') </script>";
        echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-foto-usuario.php' />";
      } // if size < 5MB

      // alteração sucedida ou não
      if ($sucessoAlterar) {
        try{
          $comando = $conexao -> prepare("UPDATE TB_USUARIO SET IMAGEM_USUARIO = ? WHERE ID_USUARIO = ?");
          $comando -> bindParam(1, $novoNomeFoto);
          $comando -> bindParam(2, $_SESSION["idUsuario"]);

          if($comando -> execute()){
            if($comando -> rowCount() > 0){
              echo "<script> console.log('Foto incluída no bco com sucesso') </script>";
            } else{
              echo "<script> console.log('Erro ao incluir foto no bco') </script>";
            }
          } else{
            throw new PDOException("Erro: não foi possível executar o comando");
          }
        } catch(PDOException $erro){
          echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
          echo "<script> console.log(document.querySelector('#erro').innerText) </script>";
        } // try/catch

        echo "<script> alert('Foto alterada com sucesso!') </script>";
        echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/editar-perfil.php' />";
      } else {
        echo "<script> alert('Erro ao alterar foto!') </script>";
        echo "<meta http-equiv='refresh' content='0; ../../../../paginas/acesso/editar-perfil/alterar-foto-usuario.php' />";
      } // if sucesso alteração

    } // isset arquivo
  } // isset idUsuario
?>
