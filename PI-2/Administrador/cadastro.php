<?php
session_start();
include '../conexao.php';
include '../menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo_usuario = $_POST['nivel'];
    $rm = $_POST['rm'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 


    $sql = "INSERT INTO usuarios (nome_usuario, email, senha, tipo_usuario, rm) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nome, $email, $senha, $tipo_usuario, $rm]);

    echo "<script>
            alert('Usuário registrado com sucesso!');
            window.location.href = 'admin_dashboard.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../geral.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <div class="container-cadastro">
        <h2>Cadastrar Usuário</h2>
        <form action="cadastro.php" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="rm">RM:</label>
                <input type="text" name="rm" id="rm" required>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <div>
                <label for="nivel">Nível de Acesso:</label>
                <select name="nivel" id="nivel" required>
                    <option value="">Selecione...</option>
                    <option value="professor">Professor</option>
                    <option value="coordenador">Coordenador</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
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

