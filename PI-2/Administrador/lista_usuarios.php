<?php
session_start();
require_once '../conexao.php';
include '../menu.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: ../login.php");
    exit;
}

$sql = 'SELECT * FROM usuarios';
$stmt = $conn -> query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../geral.css">
    <title>Lista de Usuários</title>
</head>
<body>
<div class="lista-user">
    <h2>Lista de Usuários</h2>
    <table class="lista-user">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</t>
        <th>Nível de Acesso</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id_usuario'] ?></td>
                <td><?= $usuario['nome_usuario'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= $usuario['tipo_usuario'] ?></td>
                <td>
                    <a href="editar.php?id_usuario=<?= $usuario['id_usuario'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir.php?id_usuario=<?= $usuario['id_usuario'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<footer class="rodape">
    <div class="container-rodape">
        <div class="logo-rodape">
        <img src="../IMG/sp.png" alt="Logo Governo de São Paulo">
        </div>
        <div class="info-rodape">
            <p>© 2024 Governo do Estado de São Paulo</p>
            <p>Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
