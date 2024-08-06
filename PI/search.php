<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'PROFESSOR') {
    header("Location: index.html");
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

// Recuperar o termo de pesquisa, se houver
$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

// Modificar a consulta SQL para incluir a pesquisa por "Turma"
$sql = "SELECT Nome, Turma FROM avaliacoes";
if (!empty($search)) {
    $sql .= " WHERE Turma LIKE '%$search%'";
}

$result = $conn->query($sql);

$table_html = "";

if ($result->num_rows > 0) {
    $table_html .= '<table class="data-table">';
    $table_html .= '<thead>';
    $table_html .= '<tr>';
    $table_html .= '<th>Nome</th>';
    $table_html .= '<th>Turma</th>';
    $table_html .= '</tr>';
    $table_html .= '</thead>';
    $table_html .= '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $nome = htmlspecialchars($row['Nome']);
        $turma = htmlspecialchars($row['Turma']);
        $table_html .= '<tr>';
        $table_html .= '<td><a href="#" class="detail-link" data-nome="' . $nome . '">' . $nome . '</a></td>';
        $table_html .= '<td>' . $turma . '</td>';
        $table_html .= '</tr>';
    }

    $table_html .= '</tbody>';
    $table_html .= '</table>';
} else {
    $table_html .= '<p>Nenhum resultado encontrado.</p>';
}

$conn->close();

echo $table_html;
?>
