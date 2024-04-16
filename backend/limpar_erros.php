<?php
include '../config.php'; // Inclua o arquivo de configuração com a conexão ao banco de dados

try {
    // Query para excluir todos os dados da tabela 'errors'
    $sql = "TRUNCATE TABLE errors";
    
    // Executa a query
    $stmt = sqlsrv_query($conn, $sql);
    
    echo "success"; // Retorna sucesso para a requisição AJAX
} catch (Exception $e) {
    // Se houver um erro, retorna o erro
    echo "error: " . $e->getMessage();
}
?>
