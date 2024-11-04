<?php
include 'conexao.php';

$id = $_GET['id_usuario'];

$stmt = $conn -> prepare("DELETE FROM usuarios WHERE id_usuario=?");
$stmt -> execute([$id]);

header("Location: lista_usuarios.php");
exit;
?>