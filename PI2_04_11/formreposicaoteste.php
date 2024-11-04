<?php
session_start();
include 'conexao.php';
include 'menu.php';

// Puxa o nome e RM do usuário logado da sessão
$nomeProfessor = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : '';
$rm = isset($_SESSION['rm']) ? $_SESSION['rm'] : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css"> <!-- Link para o CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de Reposição de Aulas</title>
    <script>
        // Função para exibir os campos conforme a quantidade de aulas
        function atualizarCampos() {
            const quantidade = document.getElementById('quantidade_aulas').value;
            const aulasReposicao = document.querySelectorAll('.aulas-reposicao .aula-reposicao');

            aulasReposicao.forEach((campo, index) => {
                campo.style.display = index < quantidade ? 'block' : 'none';
            });
        }
    </script>
</head>
<body>
    <div class="container-reposicao">
        <h2>Plano de Reposição de Aulas</h2>
        <form action="processarPlanoReposicao.php" method="post">
            <!-- Nome do Professor e RM -->
            <label for="nomeProfessor">Nome do Professor:</label>
            <input type="text" id="nomeProfessor" name="nomeProfessor" value="<?= htmlspecialchars($nomeProfessor) ?>" readonly>

            <label for="rm">Registro de Matrícula (RM):</label>
            <input type="text" id="rm" name="rm" value="<?= htmlspecialchars($rm) ?>" readonly>

            <!-- Curso -->
            <label for="curso">Selecione o curso:</label>
            <select id="curso_id" name="curso_id" required>
                <option value="">-- Selecione --</option>
                <option value="1">DSM</option>
                <option value="2">GE</option>
                <option value="3">GPI</option>
            </select>

            <!-- Turno -->
            <label for="turno">Turno:</label>
            <select id="turno" name="turno" required>
                <option value="" disabled selected>Escolha o turno</option>
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
                <option value="Noite">Noite</option>
            </select>

            <!-- Motivo da Reposição -->
            <label for="motivo">Motivo da Reposição:</label>
            <select id="motivo" name="motivo" required>
                <option value="" disabled selected>Escolha o motivo</option>
                <option value="Claro Docente">Claro Docente</option>
                <option value="Falta">Falta</option>
                <option value="Substituição">Substituição</option>
            </select>

            <!-- Dados da aula não ministrada -->
            <h3>Dados da aula não ministrada</h3>
            <label for="data_nao_ministrada">Data:</label>
            <input type="date" id="data_nao_ministrada" name="data_nao_ministrada" max="<?= date('Y-m-d') ?>" required>

            <label for="disciplina_nao_ministrada">Disciplina:</label>
            <input type="text" id="disciplina_nao_ministrada" name="disciplina_nao_ministrada" required>

            <!-- Quantidade de Aulas a Repor -->
            <label for="quantidade_aulas">Quantidade de Aulas a Repor:</label>
            <select id="quantidade_aulas" name="quantidade_aulas" onchange="atualizarCampos()" required>
                <option value="" disabled selected>Escolha a quantidade</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <!-- Dados das aulas de reposição -->
            <h3>Dados da(s) aulas de reposição</h3>
            <div class="aulas-reposicao">
                <div class="aula-reposicao" style="display: none;">
                    <label for="reposicao1">1) Data:</label>
                    <input type="date" id="reposicao1" name="datas_reposicao[]" min="<?= date('Y-m-d') ?>">
                    <label for="horario1">Horário de Início:</label>
                    <input type="time" id="horario_inicio1" name="horarios_inicio[]">
                    <label for="horario_fim1">Horário de Término:</label>
                    <input type="time" id="horario_fim1" name="horarios_fim[]">
                </div>

                <div class="aula-reposicao" style="display: none;">
                    <label for="reposicao2">2) Data:</label>
                    <input type="date" id="reposicao2" name="datas_reposicao[]" min="<?= date('Y-m-d') ?>">
                    <label for="horario2">Horário de Início:</label>
                    <input type="time" id="horario_inicio2" name="horarios_inicio[]">
                    <label for="horario_fim2">Horário de Término:</label>
                    <input type="time" id="horario_fim2" name="horarios_fim[]">
                </div>

                <div class="aula-reposicao" style="display: none;">
                    <label for="reposicao3">3) Data:</label>
                    <input type="date" id="reposicao3" name="datas_reposicao[]" min="<?= date('Y-m-d') ?>">
                    <label for="horario3">Horário de Início:</label>
                    <input type="time" id="horario_inicio3" name="horarios_inicio[]">
                    <label for="horario_fim3">Horário de Término:</label>
                    <input type="time" id="horario_fim3" name="horarios_fim[]">
                </div>

                <div class="aula-reposicao" style="display: none;">
                    <label for="reposicao4">4) Data:</label>
                    <input type="date" id="reposicao4" name="datas_reposicao[]" min="<?= date('Y-m-d') ?>">
                    <label for="horario4">Horário de Início:</label>
                    <input type="time" id="horario_inicio4" name="horarios_inicio[]">
                    <label for="horario_fim4">Horário de Término:</label>
                    <input type="time" id="horario_fim4" name="horarios_fim[]">
                </div>
            </div>

            <button type="submit" class="btn-enviar">Enviar Plano de Reposição</button>
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
</body>
</html>





