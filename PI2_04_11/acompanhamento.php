<?php
session_start();
include 'conexao.php'; // Conexão com o banco de dados
include 'menu.php'; // Inclui o menu

// Obtém o ID do usuário logado
$id_usuario = $_SESSION['id_usuario'];

// Consulta para buscar os formulários pendentes
$sql_pendentes = "SELECT * FROM reposicoes WHERE id_usuario = ? AND status = 'pendente'";
$stmt_pendentes = $conn->prepare($sql_pendentes);
$stmt_pendentes->execute([$id_usuario]);
$formularios_pendentes = $stmt_pendentes->fetchAll(PDO::FETCH_ASSOC);

// Consulta para buscar os formulários com resposta
$sql_respondidos = "SELECT * FROM reposicoes WHERE id_usuario = ? AND status != 'pendente'";
$stmt_respondidos = $conn->prepare($sql_respondidos);
$stmt_respondidos->execute([$id_usuario]);
$formularios_respondidos = $stmt_respondidos->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acompanhamento de Formulários</title>
    <link rel="stylesheet" href="geral.css"> <!-- Link para o CSS -->
    <style>
        .tabela-reposicao {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .tabela-reposicao th, .tabela-reposicao td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .tabela-reposicao th {
            background-color: #f4f4f4;
        }
        .tabela-reposicao tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .tabela-reposicao tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container-acompanhamento">
        <h2>Acompanhamento de Formulários de Reposição</h2>

        <!-- Tabela de Formulários Pendentes -->
        <h3>Formulários Pendentes</h3>
        <table class="tabela-reposicao">
            <thead>
                <tr>
                    <th>Data de Envio</th>
                    <th>Detalhes da Reposição</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($formularios_pendentes)): ?>
                    <?php foreach ($formularios_pendentes as $form): ?>
                        <tr>
                            <td><?= htmlspecialchars($form['data_envio']) ?></td>
                            <td><?= htmlspecialchars($form['detalhes_reposicao']) ?></td>
                            <td><?= htmlspecialchars($form['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Nenhum formulário pendente.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tabela de Formulários Respondidos -->
        <h3>Formulários com Resposta</h3>
        <table class="tabela-reposicao">
            <thead>
                <tr>
                    <th>Data de Envio</th>
                    <th>Detalhes da Reposição</th>
                    <th>Status</th>
                    <th>Resposta</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($formularios_respondidos)): ?>
                    <?php foreach ($formularios_respondidos as $form): ?>
                        <tr>
                            <td><?= htmlspecialchars($form['data_envio']) ?></td>
                            <td><?= htmlspecialchars($form['detalhes_reposicao']) ?></td>
                            <td><?= htmlspecialchars($form['status']) ?></td>
                            <td><?= htmlspecialchars($form['resposta']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum formulário com resposta.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

