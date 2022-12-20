<?php

  $dbHost = 'localhost';
  $dbUsername = 'robert';
  $dbPassword = '';
  $dbName = 'hotspot';

  $conexao = new mysqli($dbHost,$dbUsername,$dbPassword, $dbName);
  if($conexao){
    echo 'funcionou';
  }
?>