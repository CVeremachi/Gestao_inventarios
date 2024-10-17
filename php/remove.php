<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: Login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $mysqli->prepare("DELETE FROM dispositivos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view.php?filter=" . ($_GET['filter'] ?? ''));
        exit;
    } else {
        echo "Erro ao remover o dispositivo: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do dispositivo não foi fornecido.";
}

$mysqli->close();
?>
