<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="geral.css"> <!-- Link para o CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Solicitação</title>
    <style>

        /* Estilização específica para a página de visualização de formulário */
body {
    background-color: #f2f2f2; /* Fundo suave */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.page-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Centraliza verticalmente */
    padding: 20px;
}

.container-visualizarform {
    background-color: #fff; /* Fundo branco para o formulário */
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
    padding: 30px;
    width: 100%;
    max-width: 600px; /* Largura máxima */
}

#mensagemvj {
    color: #d32f2f; /* Vermelho para o título */
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: bold;
}

.detalhes-solicitacao p {
    font-size: 14px;
    margin: 8px 0;
    color: #333;
}

.detalhes-solicitacao a {
    color: #d32f2f; /* Vermelho para o link */
    text-decoration: none;
}

.detalhes-solicitacao a:hover {
    text-decoration: underline;
}

label {
    display: block;
    font-weight: bold;
    margin-top: 15px;
    color: #333;
}

.radio-group {
    display: flex;
    align-items: center;
    gap: 15px; /* Espaçamento entre os botões */
    margin-top: 10px;
    margin-bottom: 20px;
}

.radio-group input {
    margin-right: 5px; /* Espaçamento entre o radio button e o label */
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
    font-size: 14px;
    background-color: #f9f9f9;
    box-sizing: border-box;
    resize: vertical;
}

.btn-enviar {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    color: #fff;
    background-color: #d32f2f; /* Cor vermelha */
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 20px;
}

.btn-enviar:hover {
    background-color: #b71c1c; /* Tom mais escuro no hover */
}
    </style>
</head>
<body>
   

    <!-- Container principal -->
    <div class="page-container">
        <div class="container-visualizarform">
            <h2 id="mensagemvj">Detalhes da Solicitação de Justificativa</h2>

            <!-- Detalhes preenchidos pelo professor -->
            <div class="detalhes-solicitacao">
                <p><strong>Nome do Professor:</strong> João Silva</p>
                <p><strong>Matrícula:</strong> 12345</p>
                <p><strong>Função:</strong> Professor de Ensino Superior</p>
                <p><strong>Curso(s) Envolvido(s):</strong> CST-DSM, CST-GTI</p>
                <p><strong>Data da Falta:</strong> 10/10/2024</p>
                <p><strong>Período de Ausência:</strong> 2 dias</p>
                <p><strong>Tipo de Falta:</strong> Licença Médica</p>
                <p><strong>Especificação:</strong> Atestado Médico de 1 dia</p>
                <p><strong>Horário da Ausência:</strong> Das 08:00 às 10:00</p>
                <p><strong>Anexo:</strong> <a href="uploads/arquivo.pdf" target="_blank">Visualizar Documento</a></p>
            </div>

            <!-- Formulário para ação do coordenador -->
            <form action="processarSolicitacao.php" method="post">
                <input type="hidden" name="id_solicitacao" value="123"> <!-- ID da solicitação para referência -->

                <label for="acao">Ação do Coordenador:</label>
                <div class="radio-group">
                    <input type="radio" id="aceitar" name="acao" value="aceitar" required>
                    <label for="aceitar">Aceitar</label>

                    <input type="radio" id="recusar" name="acao" value="recusar" required>
                    <label for="recusar">Recusar</label>
                </div>

                <label for="comentario">Comentário do Coordenador:</label>
                <textarea id="comentario" name="comentario" rows="4" placeholder="Adicione um comentário (opcional)"></textarea>

                <button type="submit" class="btn-enviar">Enviar Resposta</button>
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

