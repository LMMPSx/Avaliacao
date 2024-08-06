<?php
session_start();

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'PROFESSOR') {
    header("Location: index.html");
    exit();
}

if (!isset($_GET['nome']) || empty($_GET['nome'])) {
    echo '<p>Nome não fornecido.</p>';
    exit();
}

$servername = "localhost";
$username = "root";
$password = "123456"; 
$dbname = "avaliacao"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nome = $conn->real_escape_string($_GET['nome']);

$sql = "SELECT * FROM avaliacoes WHERE Nome = '$nome'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<table class="data-table">';
    echo '<thead>';
    echo '<tr><th>Campo</th><th>Valor</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($row as $key => $value) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($key) . '</td>';
        echo '<td>' . htmlspecialchars($value) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Nenhum detalhe encontrado.</p>';
}

$conn->close();
?>
