<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header("Location: index.html");
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];

if ($tipo_usuario === 'ALUNO') {
    header("Location: avaliacao.html");
} elseif ($tipo_usuario === 'PROFESSOR') {
    header("Location: retorno_avaliacao.php"); 
} else {
    header("Location: index.html");
}
exit();
?>
