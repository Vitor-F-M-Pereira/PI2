<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários Aceitos ou Recusados</title>
    <script>
        function mostrarComentario(id) {
            const comentario = document.getElementById('comentario-' + id);
            if (comentario.style.display === 'none') {
                comentario.style.display = 'block';
            } else {
                comentario.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="page-container">
        <h2>Formulários Aceitos ou Recusados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID da Solicitação</th>
                    <th>Data de Envio</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemplo de conexão com o banco de dados e obtenção dos formulários aceitos ou recusados
                include 'conexao.php';
                $idProfessor = $_SESSION['id_usuario']; // Supondo que o ID do professor esteja na sessão

                $query = "SELECT id_solicitacao, data_envio, status, comentario FROM solicitacoes WHERE id_usuario = ? AND status IN ('aceito', 'recusado')";
                $stmt = $conn->prepare($query);
                $stmt->execute([$idProfessor]);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_solicitacao']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['data_envio']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td><button onclick=\"mostrarComentario(" . htmlspecialchars($row['id_solicitacao']) . ")\">Ver Comentário</button></td>";
                    echo "</tr>";
                    echo "<tr id='comentario-" . htmlspecialchars($row['id_solicitacao']) . "' style='display: none;'>";
                    echo "<td colspan='4'><strong>Comentário do Coordenador:</strong> " . htmlspecialchars($row['comentario']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
