<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Remover o "R$" e os pontos antes de salvar no banco de dados
    $preco = str_replace(['R$', '.', ','], ['', '', '.'], $preco);

    $query = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)");
    $query->execute([$nome, $descricao, $preco]);

    header("Location: cafeteria.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="product-container">
    <h1>Adicionar Produto</h1>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Preço:</label>
        <input type="text" name="preco" id="preco" required>

        <label>Descrição:</label>
        <textarea name="descricao"></textarea>

        <button type="submit">Adicionar</button>
    </form>
</div>

<!-- Script de máscara -->
<script src="script.js"></script>
</body>
</html>
