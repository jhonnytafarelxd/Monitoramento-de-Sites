<?php
include 'config.php';

$sql = "SELECT COUNT(*) AS total FROM Urls";

$result = sqlsrv_query($conn, $sql);

if ($result === false) {
die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

$totalUrls = $row['total'];

sqlsrv_close($conn);
?>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Monitor CRECISP</title>
      <script src="https://cdn.crecisp.gov.br/js/jquery/jquery-3.6.0.min.js"></script>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/index.style.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   </head>
   <script src="js/count.erro.js"></script>

   <body class="bg-dark text-white">

      <main class="mb-5 mt-5">
         <div class="container">

            <h2 class="centralizar mb-5">Monitoramento das aplicações CRECISP - Versão 3.0</h2> 
            <div>
               <a href="editar_links.php" target="_blank" class="label label-info">Editar Links</a> <a href="erro_list.php" target="_blank" class="label label-warning">Logs de Erro</a> <a class="label label-success">Total Monitorado: <?php echo $totalUrls;?></a> <a id="errorCountLabel" class="label label-danger">Total Erros: <span id="errorCount"></span></a>
            </div>
            </br>
            <div class="bg-light border border-light">
               <table class="table table-dark table-bordered table-hover border-white" style="margin-bottom: 0;">
                  <thead>
                     <tr>
                        <th scope="col" class="centralizar">Aplicação</th>
                        <th scope="col" class="centralizar">Codigo</th>
                        <th scope="col" class="centralizar">Status</th>
                        <th scope="col" class="centralizar">Tempo</th>
                     </tr>
                  </thead>
                  <tbody id="table_body">
                  </tbody>
               </table>
            </div>
         </div>
        </br>
      </br>
      </main>
      <script src="js/index.functions.js"></script>
   </body>
</html>
