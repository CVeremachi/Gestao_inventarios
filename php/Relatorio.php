<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$month = date('m');
$year = date('Y');

$sql = "SELECT * FROM dispositivos WHERE MONTH(data_entrada) = $month AND YEAR(data_entrada) = $year";
$result = $mysqli->query($sql);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="relatorio_mensal.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Nome', 'Tipo', 'Número de Série', 'Proveniência', 'Alocação', 'Data de Entrada', 'Afiliação', 'Fundo', 'Status']);

while ($device = $result->fetch_assoc()) {
    fputcsv($output, $device);
}

fclose($output);
$result->free();
$mysqli->close();
?>
