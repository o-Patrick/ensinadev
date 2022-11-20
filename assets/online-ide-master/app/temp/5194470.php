<?php
  $pessoa = "registrada";

  function autenticacao($pessoa) {
    if ($pessoa == "registrada") {
      $liberada = true;
    } else { 
      $liberada = false;
    }

    return $liberada;
  }

  echo autenticacao($pessoa);
?>
