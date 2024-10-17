<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
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
    <div class="form-container">
        <h2>Registrar Equipamento</h2>
        <form action="php/register.php" method="POST">
            <label for="name">Nome do Dispositivo:</label>
            <input type="text" id="name" name="name" required>

            <label for="type">Tipo:</label>
            <input type="text" id="type" name="type" required>

            <label for="serial_number">Número de Série:</label>
            <input type="text" id="serial_number" name="serial_number" required>

            <label for="provenance">Proveniência:</label>
            <input type="text" id="provenance" name="provenance" required>

            <label for="allocation">Alocação:</label>
            <input type="text" id="allocation" name="allocation" required>

            <label for="entry_date">Data de Entrada:</label>
            <input type="date" id="entry_date" name="entry_date" required>

            <label for="affiliation">Afiliação:</label>
            <input type="text" id="affiliation" name="affiliation" required>

            <label for="fund">Fundo de Aquisição:</label>
            <input type="text" id="fund" name="fund" required>

            <label for="estado">Status:</label>
            <select id="estado" name="estado" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>

            <button type="submit">Registrar</button>
        </form>
        <br>
        <a href="php/Relatorio.php">Gerar Relatório Mensal</a>
    </div>
</body>
</html>
