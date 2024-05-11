<?php

session_start();

$mysql = new MySQL();

var_dump($mysql);

$sql = "SELECT idusuario, nome_usuario FROM usuarios WHERE email=? AND senha=?" 

?>