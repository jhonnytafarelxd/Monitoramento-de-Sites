<?php
include '../config.php'; // Inclua o arquivo de configuração com a conexão ao banco de dados

$query = "SELECT COUNT(*) as num_rows FROM errors"; // Query para contar o número de linhas na tabela errors
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
$numRows = $row['num_rows'];

$response = array(
    'num_rows' => $numRows
);

header('Content-Type: application/json');
echo json_encode($response);
?>
