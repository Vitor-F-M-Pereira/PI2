
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="cabecalho">
        <img src="IMG/logofatec.png" class="logo-fatec">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <?php
                    // Verifica o tipo de usuário e define o link da página inicial
                    if ($_SESSION['tipo_usuario'] == 'administrador') {
                        echo '<a class="nav-link active" aria-current="page" href="admin_dashboard.php">Página Inicial</a>';
                    } elseif ($_SESSION['tipo_usuario'] == 'professor') {
                        echo '<a class="nav-link active" aria-current="page" href="menuprofessor.php">Página Inicial</a>';
                    } elseif ($_SESSION['tipo_usuario'] == 'coordenador') {
                        echo '<a class="nav-link active" aria-current="page" href="coordenador.php">Página Inicial</a>';
                    }
                    ?>
                </li>
                <!-- Adicione mais links se for necessário -->
            </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link btn btn-outline-danger" href="logout.php">Sair</a>
                </li>
                
                <li class="nav-item">
                    <span class="nav-link subtitulo">Bem-vindo, <?php echo $_SESSION['nome_usuario'] . ", RM: " . $_SESSION['rm']; ?></span>
                </li>
            </ul>
        </div>
    </div>
</nav>
