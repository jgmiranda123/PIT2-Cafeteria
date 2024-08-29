<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantidades = $_POST['quantidade'] ?? [];

    // Calcula o total da venda
    $totalVenda = 0;

    // Insere a venda na tabela vendas
    $insertVenda = $pdo->prepare("INSERT INTO vendas (total) VALUES (0)");
    $insertVenda->execute();
    $vendaId = $pdo->lastInsertId();

    // Insere cada item da venda
    foreach ($quantidades as $produtoId => $quantidade) {
        if ($quantidade > 0) {
            // Consulta o produto
            $queryProduto = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
            $queryProduto->bindParam(':id', $produtoId);
            $queryProduto->execute();
            $produto = $queryProduto->fetch(PDO::FETCH_ASSOC);

            if ($produto) {
                $precoUnitario = $produto['preco'];
                $totalItem = $precoUnitario * $quantidade;
                $totalVenda += $totalItem;

                // Insere o item na tabela itens_venda
                $insertItem = $pdo->prepare("
                    INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario, total_item)
                    VALUES (:venda_id, :produto_id, :quantidade, :preco_unitario, :total_item)
                ");
                $insertItem->bindParam(':venda_id', $vendaId);
                $insertItem->bindParam(':produto_id', $produtoId);
                $insertItem->bindParam(':quantidade', $quantidade);
                $insertItem->bindParam(':preco_unitario', $precoUnitario);
                $insertItem->bindParam(':total_item', $totalItem);
                $insertItem->execute();
            }
        }
    }

    // Atualiza o total da venda
    $updateVenda = $pdo->prepare("UPDATE vendas SET total = :total WHERE id = :id");
    $updateVenda->bindParam(':total', $totalVenda);
    $updateVenda->bindParam(':id', $vendaId);
    $updateVenda->execute();

    // Redireciona para a página de sucesso
    header("Location: venda_sucesso.php");
    exit();
} else {
    // Caso o método não seja POST, redireciona para a página inicial
    header("Location: venda.php");
    exit();
}
