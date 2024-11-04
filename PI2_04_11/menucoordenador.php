<?php
session_start();
include 'conexao.php';
include 'menu.php';

// Obtém o ID do usuário logado
$id_usuario = $_SESSION['id_usuario'];

// Consulta para buscar as justificativas de faltas
$sql_justificativas = "SELECT j.id_justificativa, u.nome_usuario, u.rm, j.data_envio 
                       FROM justificativas j 
                       JOIN usuarios u ON j.id_usuario = u.id_usuario 
                       WHERE j.id_usuario = ?";
$stmt_justificativas = $conn->prepare($sql_justificativas);
$stmt_justificativas->execute([$id_usuario]);
$justificativas = $stmt_justificativas->fetchAll(PDO::FETCH_ASSOC);

// Consulta para buscar as reposições de aulas
$sql_reposicoes = "SELECT r.id_reposicao, u.nome_usuario, u.rm, r.data_envio 
                   FROM reposicoes r 
                   JOIN usuarios u ON r.id_usuario = u.id_usuario 
                   WHERE r.id_usuario = ?";
$stmt_reposicoes = $conn->prepare($sql_reposicoes);
$stmt_reposicoes->execute([$id_usuario]);
$reposicoes = $stmt_reposicoes->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css"> <!-- Link para o CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Solicitações</title>
    <script>
        function mostrarOpcoes() {
            const opcoesCoordenador = document.getElementById('opcoesCoordenador').value;
            document.getElementById('visuFalta').classList.add('hidden');
            document.getElementById('visuReposicao').classList.add('hidden');

            if (opcoesCoordenador === 'falta') {
                document.getElementById('visuFalta').classList.remove('hidden');
            } else if (opcoesCoordenador === 'reposicao') {
                document.getElementById('visuReposicao').classList.remove('hidden');
            }
        }
    </script>
</head>

<body>
    <div class="page-container">
        <div class="container-justificativa">
            <h1 id="Subtitulo">Visualizar Solicitações</h1>

            <label for="opcoesCoordenador">Selecione o tipo de formulário:</label>
            <select id="opcoesCoordenador" onchange="mostrarOpcoes()">
                <option value="">-- Selecione --</option>
                <option value="falta">Justificativa de Faltas</option>
                <option value="reposicao">Reposição de Aulas</option>
            </select>
        </div>

        <!-- Tabela de Justificativas de Faltas -->
        <div id="visuFalta" class="opcoes-especificas hidden">
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
                    <?php if (!empty($justificativas)): ?>
                        <?php foreach ($justificativas as $justificativa): ?>
                            <tr>
                                <td><?= htmlspecialchars($justificativa['nome_usuario']) ?></td>
                                <td><?= htmlspecialchars($justificativa['rm']) ?></td>
                                <td><?= htmlspecialchars($justificativa['data_envio']) ?></td>
                                <td>
                                    <a href="visualizarformCoord.php?id=<?= $justificativa['id_justificativa'] ?>" class="btn-visualizar">Visualizar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhuma justificativa de falta encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tabela de Reposição de Aulas -->
        <div id="visuReposicao" class="opcoes-especificas hidden">
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
                                    <a href="visualizarformCoord.php?id=<?= $reposicao['id_reposicao'] ?>" class="btn-visualizar">Visualizar</a>
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

    <footer class="rodape">
        <div class="container-rodape">
            <div class="logo-rodape">
                <img src="IMG/sp.png" alt="Logo Governo de São Paulo">
            </div>
            <div class="info-rodape">
                <p>© 2024 Governo do Estado de São Paulo</p>
                <p>Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
