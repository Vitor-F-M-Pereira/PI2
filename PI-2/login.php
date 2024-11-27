<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css"> <!-- Link para o CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body id="fundo">
    <div class="cabecalho">
        <img src="IMG/logofatec.png" alt="Logo" class="logo-fatec">
    </div>
    
    <!-- Mensagem de erro como balão -->
    <?php 
    session_start();
    if (isset($_SESSION['erro_login'])): ?>
        <div class="alerta-balao" id="alerta-balao"><?php echo $_SESSION['erro_login']; ?></div>
        <?php unset($_SESSION['erro_login']); ?>
    <?php endif; ?>
    
    <div class="container-login">
        <p id="oi">Seja Bem Vindo!</p>
        <p>Faça seu Login</p>
        <form action="autenticar.php" method="post"> 
            <div class="usuario">
                <label for="email">Usuário:</label>
                <input type="email" name="email" id="email" placeholder="user123@fatec.sp.gov.br" required>
            </div>
            <div class="senha">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <button type="submit" class="button">Entrar</button>
        </form>
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

    <!-- Script para ocultar o balão após alguns segundos -->
    <script>
        const alertaBalao = document.getElementById('alerta-balao');
        if (alertaBalao) {
            setTimeout(() => {
                alertaBalao.style.opacity = '0';
                setTimeout(() => alertaBalao.remove(), 300); // Remove do DOM após animação
            }, 3000); // Exibe por 3 segundos
        }
    </script>
</body>
</html>



