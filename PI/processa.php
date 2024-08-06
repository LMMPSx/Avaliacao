<?php
$servername = "localhost";
$username = "root";
$password = "123456"; 
$dbname = "avaliacao";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$limit_lengths = [
    'docente_presenca' => 20,
    'docente_pontualidade' => 50,
    'docente_comunicacao' => 20,
    'docente_dominio' => 20,
    'docente_interesse' => 20,
    'docente_interacao' => 20,
    'docente_avaliacao' => 20,
    'curso_needs' => 20,
    'curso_temas' => 20,
    'curso_carga' => 20,
    'curso_relacao' => 20,
    'material_suficiente' => 20,
    'instalacoes_satisfatorias' => 20,
    'coordenacao_presente' => 20,
    'aluno_presenca' => 20,
    'aluno_pontualidade' => 20,
    'aluno_motivacao' => 20,
    'aluno_participacao' => 20,
    'aluno_aproveitamento' => 20,
    'aluno_capacidade' => 20,
    'curso_origem' => 50,
];

foreach ($limit_lengths as $key => $length) {
    if (isset($_POST[$key])) {
        $_POST[$key] = substr($_POST[$key], 0, $length);
    }
}

$sql = "INSERT INTO avaliacoes (
    nome, turma, docente_presenca, docente_pontualidade, docente_comunicacao, docente_dominio,
    docente_interesse, docente_interacao, docente_avaliacao, curso_needs, curso_temas,
    curso_carga, curso_relacao, material_suficiente, instalacoes_satisfatorias,
    coordenacao_presente, aluno_presenca, aluno_pontualidade, aluno_motivacao, aluno_participacao,
    aluno_aproveitamento, aluno_capacidade, comentarios, curso_origem
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$params = [
    $_POST['nome'], 
    $_POST['turma'],
    $_POST['docente_presenca'], 
    $_POST['docente_pontualidade'], 
    $_POST['docente_comunicacao'], 
    $_POST['docente_dominio'], 
    $_POST['docente_interesse'], 
    $_POST['docente_interacao'], 
    $_POST['docente_avaliacao'], 
    $_POST['curso_needs'], 
    $_POST['curso_temas'], 
    $_POST['curso_carga'], 
    $_POST['curso_relacao'], 
    $_POST['material_suficiente'], 
    $_POST['instalacoes_satisfatorias'], 
    $_POST['coordenacao_presente'], 
    $_POST['aluno_presenca'], 
    $_POST['aluno_pontualidade'], 
    $_POST['aluno_motivacao'], 
    $_POST['aluno_participacao'], 
    $_POST['aluno_aproveitamento'], 
    $_POST['aluno_capacidade'], 
    $_POST['comentarios'], 
    $_POST['curso_origem']
];

$typeString = str_repeat('s', count($params));

$stmt->bind_param($typeString, ...$params);

if ($stmt->execute() === false) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

echo '<script>alert("Dados inseridos com sucesso!"); window.location.href = "index.html";</script>';
?>
