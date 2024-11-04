<?php
session_start();
require 'conexao.php'; // Arquivo onde está a conexão PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificando se o email existe no banco de dados
    $stmt = $conn->prepare("SELECT id_usuario, nome_usuario, senha, tipo_usuario, rm FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) { // Verifica a senha usando a coluna correta
        // Login bem-sucedido, armazenando informações na sessão
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['rm'] = $usuario['rm'];

        // Redirecionar com base no nível de acesso
        if ($usuario['tipo_usuario'] == 'administrador') {
            header('Location: admin_dashboard.php');
        } elseif ($usuario['tipo_usuario'] == 'coordenador') {
            header('Location: menucoordenador.php');
        } elseif ($usuario['tipo_usuario'] == 'professor') {
            header('Location: menuprofessor.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        // Falha no login, redireciona de volta para o login
        $_SESSION['erro_login'] = 'Email ou senha inválidos.';
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
