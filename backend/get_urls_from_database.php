<?php
include('../config.php');

// Consulta SQL para selecionar os dados da tabela Urls
$sql = "SELECT Id, Url, Status, ResponseTimeSeconds FROM Urls";
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die('Erro na consulta SQL: ' . print_r(sqlsrv_errors(), true));
}

// Array para armazenar os resultados
$urls = array();

// Percorre o resultado da consulta e adiciona os dados ao array
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $urls[] = $row;
}

// Fecha a conexão com o banco de dados
sqlsrv_close($conn);

// Função para ordenar URLs alfabeticamente após "http://" ou "https://"
function compareUrls($a, $b) {
    $urlA = substr($a['Url'], strpos($a['Url'], '//') + 2);
    $urlB = substr($b['Url'], strpos($b['Url'], '//') + 2);
    return strcmp($urlA, $urlB);
}

// Ordena os resultados usando a função de comparação personalizada
usort($urls, 'compareUrls');

// Retorna os resultados em formato JSON
echo json_encode(array('urls' => $urls));
?>
