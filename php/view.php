<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: Login.html');
    exit;
}

$filter = $_GET['filter'] ?? '';

$sql = "SELECT * FROM dispositivos";

if ($filter === 'ativo') {
    $sql .= " WHERE estado = 'ativo'";
} elseif ($filter === 'inativo') {
    $sql .= " WHERE estado = 'inativo'";
} elseif ($filter === 'ativo') {
    $current_month = date('m');
    $current_year = date('Y');
    $sql .= " WHERE MONTH(data_entrada) = $current_month AND YEAR(data_entrada) = $current_year";
}

$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos - <?php echo ucfirst($filter); ?></title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Dispositivos - <?php echo ucfirst($filter); ?></h2>
        
        <form action="view.php" method="GET">
            <label for="filter">Filtrar por:</label>
            <select id="filter" name="filter" onchange="this.form.submit()">
                <option value="">Selecione</option>
                <option value="Disponiveis" <?php echo $filter === 'activo' ? 'selected' : ''; ?>>Disponíveis</option>
                <option value="Inativos" <?php echo $filter === 'inativo' ? 'selected' : ''; ?>>Inativos</option>
                <option value="Novos" <?php echo $filter === 'ativo' ? 'selected' : ''; ?>>Novos</option>
            </select>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Número de Série</th>
                    <th>Proveniência</th>
                    <th>Alocação</th>
                    <th>Data de Entrada</th>
                    <th>Afiliação</th>
                    <th>Fundo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($device = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($device['nome']); ?></td>
            <td><?php echo htmlspecialchars($device['tipo']); ?></td>
            <td><?php echo htmlspecialchars($device['numero_serie']); ?></td>
            <td><?php echo htmlspecialchars($device['proveniencia']); ?></td>
            <td><?php echo htmlspecialchars($device['alocacao']); ?></td>
            <td><?php echo htmlspecialchars($device['data_entrada']); ?></td>
            <td><?php echo htmlspecialchars($device['afiliacao']); ?></td>
            <td><?php echo htmlspecialchars($device['fundo']); ?></td>
            <td><?php echo htmlspecialchars($device['estado']); ?></td>
            <td>
                <form action="remove.php" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este dispositivo?');">
                    <input type="hidden" name="id" value="<?php echo $device['id']; ?>">
                    <button type="submit" class="btn1">Remover</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="10">Nenhum dispositivo encontrado.</td>
        </tr>
    <?php endif; ?>
            </tbody>
        </table>
        <br>
        <a href="../Dashboard.php" class="btn">Voltar ao Dashboard</a>
    </div>
</body>
</html>
<?php
$result->free();
$mysqli->close();
?>
