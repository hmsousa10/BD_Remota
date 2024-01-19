<?php
include 'include/config.inc.php';
include 'utilizadores.php';

$nomeJogador = $_POST["nome"];
$passwordJogador = $_POST["pass"];

adicionarUtilizador($nomeJogador, $passwordJogador, $ligacao);
?>