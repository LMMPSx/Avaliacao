<?php
$hostname = "localhost"; 
$username = "root"; 
$password = "123456"; 
$database = "login"; 

// Cria uma conexão com o banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Obtém e sanitiza os dados do POST
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo_usuario = $_POST['tipo_usuario'];

// Verifica se o e-mail já está cadastrado
$stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // E-mail já está registrado
    echo '<script>alert("Já existe um cadastro com esse e-mail. Tente com um e-mail diferente."); window.location.href = "index.html";</script>';
} else {
    // E-mail não está registrado, prossegue com a inserção
    $stmt = $conn->prepare("INSERT INTO usuario (email, senha, tipo_usuario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $senha, $tipo_usuario);

    if ($stmt->execute()) {
        echo '<script>alert("Cadastro realizado com sucesso. Faça o login na página inicial."); window.location.href = "index.html";</script>';
    } else {
        echo '<script>alert("O cadastro não pode ser realizado. Tente novamente."); window.location.href = "index.html";</script>';
    }
}

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>
