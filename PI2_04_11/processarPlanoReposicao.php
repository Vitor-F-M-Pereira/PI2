<?php
session_start();
include 'conexao.php'; // Conexão com o banco de dados

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nomeProfessor = $_POST['nomeProfessor'];
    $rm = $_POST['rm'];
    $curso_id = $_POST['curso_id'];
    $turno = $_POST['turno'];
    $motivo = $_POST['motivo'];
    $data_nao_ministrada = $_POST['data_nao_ministrada'];
    $disciplina_nao_ministrada = $_POST['disciplina_nao_ministrada'];
    $quantidade_aulas = $_POST['quantidade_aulas'];
    $datas_reposicao = $_POST['datas_reposicao'];
    $horarios_inicio = $_POST['horarios_inicio'];
    $horarios_fim = $_POST['horarios_fim'];

    try {
        // Inicia uma transação
        $conn->beginTransaction();

        // Insere os dados principais na tabela de reposições
        $sql = "INSERT INTO reposicoes (
                    nome_professor, rm, curso_id, turno, motivo, data_nao_ministrada,
                    disciplina_nao_ministrada, quantidade_aulas
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $nomeProfessor, $rm, $curso_id, $turno, $motivo, $data_nao_ministrada,
            $disciplina_nao_ministrada, $quantidade_aulas
        ]);

        // Obtém o ID da reposição recém-criada
        $reposicao_id = $conn->lastInsertId();

        // Insere os dados das aulas de reposição
        for ($i = 0; $i < $quantidade_aulas; $i++) {
            if (!empty($datas_reposicao[$i]) && !empty($horarios_inicio[$i]) && !empty($horarios_fim[$i])) {
                $sql_aula = "INSERT INTO aulas_reposicao (
                                reposicao_id, data_reposicao, horario_inicio, horario_fim
                             ) VALUES (?, ?, ?, ?)";
                $stmt_aula = $conn->prepare($sql_aula);
                $stmt_aula->execute([
                    $reposicao_id, $datas_reposicao[$i], $horarios_inicio[$i], $horarios_fim[$i]
                ]);
            }
        }

        // Confirma a transação
        $conn->commit();

        // Exibe uma mensagem de sucesso
        echo "<div class='alert alert-success'>Formulário enviado com sucesso!</div>";

    } catch (Exception $e) {
        // Em caso de erro, desfaz a transação
        $conn->rollBack();
        echo "<div class='alert alert-danger'>Erro ao enviar o arquivo. Tente novamente.</div>";
    }
} else {
    // Redireciona para a página do formulário caso o método não seja POST
    header("Location: planoReposicao.php");
    exit;
}

