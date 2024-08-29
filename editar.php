<?php
include 'conexao.php';

$id = $_GET['id'];
$query = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$query->execute([$id]);
$produto = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $query = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?");
    $query->execute([$nome, $descricao, $preco, $id]);

    header("Location: cafeteria.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
</head>
<body>
<h1>Editar Produto</h1>
<form method="POST">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= $produto['nome'] ?>" required><br>
    <label>Descrição:</label><br>
    <textarea name="descricao"><?= $produto['descricao'] ?></textarea><br>
    <label>Preço:</label><br>
    <input type="text" name="preco" value="<?= $produto['preco'] ?>" required><br><br>
    <button type="submit">Atualizar</button>
</form>
</body>
</html>
