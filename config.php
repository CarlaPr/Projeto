<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'formulario-rivest';

   $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

   if ($conexao->connect_errno) {
     echo "Erro de conexão: " . $conexao->connect_error; 
   } else {
     echo "Conexão bem-sucedida";
   }
?>