<?php
include '../config.php'; // Inclui o arquivo de configuração com a conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['url'])) {
        $novaUrl = $_POST['url'];
        $query = "INSERT INTO Urls (Url) VALUES (?)";
        $params = array($novaUrl);
        $stmt = sqlsrv_query($conn, $query, $params);
        if ($stmt === false) {
            echo 'error';
        } else {
            echo 'success';
        }
    } else {
        echo 'error';
    }
}
?>
