<?php
include 'config.php'; // Inclui o arquivo de configuração com a conexão ao banco de dados

// Consulta SQL para selecionar os erros da tabela
$query = "SELECT * FROM errors";
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Monitoramento de Erros</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/erro.style.css">
</head>
<body>
    <div class="container">
        <h3 class="mb-4 text-center">Monitoramento de Erros</h3>
         <button id="excluir-dados" class="btn btn-danger mb-3">Excluir Todos os Dados</button> 
        <table id="tabela-erros" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Link</th>
                    <th>Código de Erro</th>
                    <th>Descrição do Erro</th>
                    <th>Data e Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $row['link'] . '</td>';
                    echo '<td>' . $row['errorCode'] . '</td>';
                    echo '<td>' . $row['errorDescription'] . '</td>';
                    echo '<td>' . $row['dateTime']->format('Y-m-d H:i:s') . '</td>'; // Ajuste o formato conforme necessário
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="js/erro.functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>

