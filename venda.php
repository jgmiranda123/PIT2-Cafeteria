<?php
include 'conexao.php';

// Consulta para buscar os produtos disponíveis
$query = $pdo->prepare("SELECT * FROM produtos");
$query->execute();
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Produtos - Cafeteria</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="venda-container">
    <h2>Venda de Produtos</h2>
    <form id="vendaForm" method="POST" action="processar_venda.php">
        <table>
            <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['nome'] ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <input type="number" name="quantidade[<?= $produto['id'] ?>]" min="0" value="0">
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total-section">
            <p><strong>Total: R$ <span id="total">0.00</span></strong></p>
        </div>
        <button type="submit" class="btn">Finalizar Venda</button>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
