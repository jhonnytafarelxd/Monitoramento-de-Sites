<?php
// Inclua o arquivo de configuração com a conexão ao banco de dados
include '../config.php';

// Query SQL para selecionar as colunas antigo e novo da tabela config
$sql = "SELECT antigo, novo FROM config";

// Execute a consulta SQL
$result = sqlsrv_query($conn, $sql);

// Verifique se a consulta foi bem-sucedida
if ($result === false) {
    // Se a consulta falhar, exiba um erro e pare a execução
    die("Erro ao executar a consulta SQL: " . sqlsrv_errors());
}

// Inicialize um array para armazenar os resultados
$data = array();

// Loop através dos resultados e adicione-os ao array
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Libere os recursos do resultado
sqlsrv_free_stmt($result);

// Feche a conexão com o banco de dados
sqlsrv_close($conn);

// Codifique o array em formato JSON e envie-o para a saída
echo json_encode($data);
?>
