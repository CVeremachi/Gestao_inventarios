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
        
        <!-- Filter Form -->
        <form action="php/view.php" method="GET">
            <label for="filter">Filtrar por:</label>
            <select id="filter" name="filter" onchange="this.form.submit()">
                <option value="">Selecione</option>
                <option value="Disponiveis" <?php echo $filter === 'Disponiveis' ? 'selected' : ''; ?>>Disponíveis</option>
                <option value="Inativos" <?php echo $filter === 'Inativos' ? 'selected' : ''; ?>>Inativos</option>
                <option value="Novos" <?php echo $filter === 'Novos' ? 'selected' : ''; ?>>Novos</option>
            </select>
        </form>
        
        <!-- Display Devices Table -->
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
                    <th>Ações</th> <!-- Nova coluna para ações -->
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
                            <a href="edit.php?id=<?php echo $device['id']; ?>">Editar</a> | 
                            <a href="delete.php?id=<?php echo $device['id']; ?>" onclick="return confirm('Tem certeza que deseja remover este dispositivo?');">Remover</a>
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
