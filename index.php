<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta ao banco de dados
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();

    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Login bem-sucedido
        $_SESSION['username'] = $usuario['username'];
        header("Location: cafeteria.php");
        exit();
    } else {
        // Login falhou
        $error = "Usuário ou senha incorretos.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cafeteria</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="login-container">
    <form id="loginForm" class="login-form" method="POST" action="index.php">
        <h2>Login - Cafeteria</h2>
        <div class="input-group">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>
        </div>
        <div class="input-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="btn">Entrar</button>
        <?php if (isset($error)) { ?>
            <p class="error-msg"><?= $error ?></p>
        <?php } ?>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
