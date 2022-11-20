<?php
	if (session_status() == PHP_SESSION_NONE) session_start();

  require "../conexao.php";

  if (isset($_GET["idComentario"])) {
    $idComentario = $_GET["idComentario"];

    try{
      $comando = $conexao->prepare("DELETE FROM TB_COMENTARIO_USUARIO WHERE ID_COMENTARIO_USUARIO = ?");
      $comando->bindParam(1, $idComentario);

      if($comando->execute()){
        if($comando->rowCount() > 0){
          echo "<script> alert('Comentário apagado com sucesso!') </script>";
          echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php' />";
        } else {
          echo "<script>alert('Erro ao apagar comentário! Se o problema persistir, fale conosco em Contato')</script>";
          echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php' />";
        } // if rowCount
      } else {
        throw new PDOException("Erro: não foi possível executar o comando!");
        echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php' />";
      } // if execute
    } catch(PDOException $erro) {
      echo "<p style='display:none;' id='erro'>Erro: " . $erro->getMessage() . "</p>";
      echo "<script>alert(document.querySelector('#erro').innerText);</script>";
      echo "<meta http-equiv='refresh' content='0; ../../../paginas/temas/item.php' />";
    } // try/catch
  } // if isset idComentario

?>