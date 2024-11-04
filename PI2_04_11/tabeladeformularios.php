<?php
session_start();
include 'conexao.php';
include 'menu.php';

$id = $_GET['id_justificativa'];
$justificativa = $conn->prepare("SELECT * FROM justificativas INNER JOIN usuarios ON justificativas.id_usuario = usuarios.id_usuario WHERE id_justificativa = ?");
$justificativa->execute([$id]);
$justificativa = $justificativa->fetch(PDO::FETCH_ASSOC);

// Função para formatar o valor do campo
function formatFieldValue($value) {
    return ucwords(strtolower($value)); // Exemplo de formatação: deixa a primeira letra de cada palavra maiúscula
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css"> <!-- Link para o CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações</title>
</head>

<body>

    <!-- Container centralizado -->
    <div class="page-container">
        <div class="visuProfessor">
            <form action="autenticar.php" method="post"> 
                <h2>Solicitações</h2>
                <div class="linha-usuario">
                    <div class="usuario">
                        <label for="rm_professor">RM do Professor:</label>
                        <input type="text" id="rm_professor" name="rm_professor" value="<?= htmlspecialchars(formatFieldValue($justificativa['rm'])) ?>" readonly>

                        <label for="nome">Nome do Professor:</label>
                        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars(formatFieldValue($justificativa['nome_usuario'])) ?>" readonly>
                    </div>

                    <div class="tipo">
                        <label for="tipo_falta">Tipo da Falta:</label>
                        <input type="text" id="tipo_falta" name="tipo_falta" value="<?= htmlspecialchars(formatFieldValue($justificativa['tipo_falta'])) ?>" readonly>
                    </div>

                    <div class="data">
                        <label for="data_falta">Data:</label>
                        <input type="date" id="data_falta" name="data_falta" value="<?= htmlspecialchars($justificativa['data_falta']) ?>" readonly>
                    </div>
                </div>

                <!-- Botão de Enviar -->
                <button type="submit" class="button">Entrar</button>

                <?php if (isset($erro)): ?>
                    <p style="color: red;"><?php echo $erro; ?></p>
                <?php endif; ?>
            </form>
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
