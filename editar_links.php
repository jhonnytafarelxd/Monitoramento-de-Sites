<?php
include 'config.php'; // Inclui o arquivo de configuração com a conexão ao banco de dados

// Query para selecionar os URLs da tabela
$query = "SELECT * FROM Urls";
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>
<html>
<head>
    <title>Editar Links de Monitoramento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="css/editar.style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-4">Links de Monitoramento</h3>
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#adicionarModal">Adicionar Link</button>
                  <table class="table" id="linksTable">
                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row['Url'] . '</td>';
                            echo '<td><button class="btn btn-danger" onclick="confirmarDeletarLink(' . $row['Id'] . ', this)">Deletar</button></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="adicionarModal" tabindex="-1" role="dialog" aria-labelledby="adicionarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adicionarModalLabel">Adicionar Novo Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionar">
                        <div class="form-group">
                            <label for="novaUrl">URL:</label>
                            <input type="text" class="form-control" id="novaUrl" name="novaUrl">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="adicionarLink()">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/editar.functions.js"></script>
</body>
</html>
