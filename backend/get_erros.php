<?php
include '../config.php'; // Inclua o arquivo de configuração com a conexão ao banco de dados

$query = "SELECT * FROM errors"; // Query para selecionar os erros do banco de dados
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$errors = array();
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $errors[] = $row;
}

header('Content-Type: application/json');
echo json_encode($errors);
?>
