<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $serial_number = $_POST['serial_number'];
    $provenance = $_POST['provenance'];
    $allocation = $_POST['allocation'];
    $entry_date = $_POST['entry_date'];
    $affiliation = $_POST['affiliation'];
    $fund = $_POST['fund'];
    $estado = $_POST['estado']; // Alterado para $estado

    // Prepare a consulta SQL com o nome correto da coluna
    $query = "INSERT INTO dispositivos (nome, tipo, numero_serie, proveniencia, alocacao, data_entrada, afiliacao, fundo, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die('Prepare failed: ' . $mysqli->error); // Mensagem detalhada sobre o erro
    }

    // Vincule os parâmetros à consulta
    $stmt->bind_param('sssssssss', $name, $type, $serial_number, $provenance, $allocation, $entry_date, $affiliation, $fund, $estado);

    if ($stmt->execute()) {
        echo "<script>alert('Dispositivo registrado com sucesso!'); window.location.href = '../Dashboard.php';</script>";
    } else {
        echo "Erro: " . $stmt->error; // Mensagem de erro detalhada
    }

    $stmt->close();
}
$mysqli->close();
?>
