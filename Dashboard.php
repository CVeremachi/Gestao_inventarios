<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: Login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <img src="images.png" alt="">
        <h2>Painel de Controle</h2>
        <div class="menu-options">
            <a href="php/view.php?filter=Disponivel" class="btn">Dispositivos Disponíveis</a>
            <a href="php/view.php?filter=inativo" class="btn">Dispositivos Inativos</a>
            <a href="php/view.php?filter=Novo" class="btn">Dispositivos Novos</a>
            <a href="registar.php" class="btn">Registrar Novo Dispositivo</a>
        </div>
        <a href="php/logout.php" class="btn">Sair</a>
    </div>
</body>
</html>
