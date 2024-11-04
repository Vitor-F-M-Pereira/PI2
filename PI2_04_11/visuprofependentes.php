<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários Pendentes</title>
</head>
<body>
    <div class="page-container">
        <h2>Formulários Pendentes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID da Solicitação</th>
                    <th>Data de Envio</th>
                    <th>Tipo de Falta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemplo de conexão com o banco de dados e obtenção dos formulários pendentes
                include 'conexao.php';
                $idProfessor = $_SESSION['id_usuario']; // Supondo que o ID do professor esteja na sessão

                $query = "SELECT id_solicitacao, data_envio, tipo_falta FROM solicitacoes WHERE id_usuario = ? AND status = 'pendente'";
                $stmt = $conn->prepare($query);
                $stmt->execute([$idProfessor]);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_solicitacao']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['data_envio']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tipo_falta']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
