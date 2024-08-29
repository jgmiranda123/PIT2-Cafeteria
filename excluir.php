<?php
include 'conexao.php';

$id = $_GET['id'];

$query = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
$query->execute([$id]);

header("Location: cafeteria.php");
?>
