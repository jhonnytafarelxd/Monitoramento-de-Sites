<?php
include '../config.php'; // Inclui o arquivo de configuração com a conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query para deletar o link com base no ID
    $query = "DELETE FROM Urls WHERE ID = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt === false) {
        echo 'error';
    } else {
        echo 'success';
    }
} else {
    echo 'error';
}
?>
