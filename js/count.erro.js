   $(document).ready(function(){
       function updateErrorCount() {
           $.ajax({
               url: 'backend/get_num_erro.php',
               type: 'GET',
               dataType: 'json',
               success: function(data) {
                   $('#errorCount').text(data.num_rows);
               },
               error: function(xhr, status, error) {
                   console.error('Erro ao obter contagem de erros:', error);
               }
           });
       }

       // Chama a função inicialmente e a cada 10 segundos
       updateErrorCount();
       setInterval(updateErrorCount, 10000);
   });  