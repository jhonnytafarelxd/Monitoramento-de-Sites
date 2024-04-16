<?php

// Configurações do banco de dados
$dbServer = 'WIN-629VH2OP7GT'; // Endereço do servidor SQL Server
$dbUsername = 'monitor'; // Nome de usuário do banco de dados
$dbPassword = 'Dedkjsd1@'; // Senha do banco de dados
$dbName = 'monitor'; // Nome do banco de dados

// Estabelecer conexão com o banco de dados
$conn = sqlsrv_connect($dbServer, array(
    "Database" => $dbName,
    "UID" => $dbUsername,
    "PWD" => $dbPassword
));

// Verificar conexão
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>
