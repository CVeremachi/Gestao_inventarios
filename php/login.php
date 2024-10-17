<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara a consulta
    $stmt = $mysqli->prepare("SELECT senha FROM usuarios WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Verifica a senha sem hashing
        if ($password === $stored_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: ../Dashboard.php');
        } else {
            echo "<script>alert('Credenciais inválidas!'); window.location.href = '../Login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href = '../Login.html';</script>";
    }

    $stmt->close();
}
$mysqli->close();
?>
