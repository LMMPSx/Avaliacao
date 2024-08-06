<?php
$hostname = "localhost";
$username = "root";
$password = "123456"; 
$database = "login";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT tipo_usuario FROM usuario WHERE email = ? AND senha = ?");
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_usuario);
    $stmt->fetch();
    
    session_start();
    $_SESSION['tipo_usuario'] = $tipo_usuario;

    echo '<script>alert("Login realizado com sucesso!"); window.location.href = "pagina_inicial.php";</script>';
} else {
    echo '<script>alert("Login ou senha incorretos!"); window.location.href = "index.html";</script>';
}

$stmt->close();
$conn->close();
?>
