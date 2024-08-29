<?php
include 'conexao.php';

$query = $pdo->query("SELECT * FROM produtos");
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria - Produtos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Cafeteria - Produtos</h1>
    <a href="adicionar_produto.php" class="btn">Adicionar Produto</a>
</header>

<main>
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= $produto['nome'] ?></td>
                    <td><?= $produto['descricao'] ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <a href="editar.php?id=<?= $produto['id'] ?>" class="btn-edit">Editar</a>
                        <a href="excluir.php?id=<?= $produto['id'] ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>
