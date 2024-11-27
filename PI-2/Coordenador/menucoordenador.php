<?php
session_start();
include '../conexao.php';
include '../menu.php';


$sql_reposicoes = "SELECT r.id_reposicao, u.nome_usuario, u.rm, r.data_envio 
                   FROM reposicoes r 
                   JOIN usuarios u ON r.id_usuario = u.id_usuario
                   WHERE r.status = 'pendente'";

$stmt_reposicoes = $conn->prepare($sql_reposicoes);
$stmt_reposicoes->execute();
$reposicoes = $stmt_reposicoes->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="../geral.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários Reposição</title>
</head>

<body>
    <div class="container">
        <div class="container-justificativa">
            <h1 id="Subtitulo">Formulários Reposição</h1>
        

        <!-- Tabela de Reposição de Aulas -->
        <div id="visuReposicao">
            <table class="tabela-reposicao">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RM</th>
                        <th>Data Envio</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reposicoes)): ?>
                        <?php foreach ($reposicoes as $reposicao): ?>
                            <tr>
                                <td><?= htmlspecialchars($reposicao['nome_usuario']) ?></td>
                                <td><?= htmlspecialchars($reposicao['rm']) ?></td>
                                <td><?= htmlspecialchars($reposicao['data_envio']) ?></td>
                                <td>
                                    <a href="visualizarreposCoord.php?id=<?= $reposicao['id_reposicao'] ?>" class="btn-visualizar">Visualizar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhuma reposição de aula encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
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
        </div>
    </footer>
</body>
</html>
