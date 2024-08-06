<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "avaliacao";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

echo '<script>alert("Registro inserido com sucesso!"); window.location.href = "index.html";</script>';

$stmt->close();
$conn->close();
?>
