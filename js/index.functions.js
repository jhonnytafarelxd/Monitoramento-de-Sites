        $(document).ready(function(){
            const urlsComProblema = [];
            const urlsOnline = [];

            function loadAndCheckURLs() {
                $.ajax({
                    url: 'backend/get_urls_from_database.php',
                    dataType: 'json',
                    success: function(response) {
                        const urls = response.urls;
                        checkStatus(urls);
                    },
                    error: function(xhr) {
                        console.error('Erro ao carregar as URLs do banco de dados:', xhr.statusText);
                    }
                });
            }

            loadAndCheckURLs();
            setInterval(loadAndCheckURLs, 10000); // Atualizar a cada 5 segundos

            // Função para verificar o status das URLs
             function checkStatus(urls) {
                urlsComProblema.length = 0;
                urlsOnline.length = 0;

                // Array contendo os códigos de status que não queremos incluir
                var excludedStatusCodes = [200, 301, 302, 405];
                
                // Variável para verificar se há algum site offline
                var isSiteOffline = false;

                urls.forEach(function(url) {
                    // Verifica se o código de status não está na lista de códigos excluídos
                    if (!excludedStatusCodes.includes(url.Status)) {
                        urlsComProblema.push(url);
                    } else {
                        urlsOnline.push(url);
                    }
                    updateTable();

                    // Verifica se o site está offline
                    if (!excludedStatusCodes.includes(url.Status)) {
                        isSiteOffline = true;
                    }
                });

                // Exibe o Swal.fire se algum site estiver offline
                if (isSiteOffline) {
                //Swal.fire({
                //    position: "top-end",
                //    icon: "error",
                //    title: "Oops...",
                //    text: "Algum site está offline no momento.",
                //    imageUrl: "https://media1.tenor.com/m/Ar34YOlC40gAAAAd/fat-turkish-guy-dancing-belly-dance.gif",
                //    imageAlt: "Site Offline",
                //    timer: 4000, // Auto-fechar em 15 segundos
                //    timerProgressBar: true, // Barra de progresso para o temporizador
                //    showConfirmButton: false // Não mostrar botão de confirmação
                //});
                }
            }


            // Atualizar a tabela com os resultados da verificação
            function updateTable() {
                const tbody = $('#table_body').empty();

                // Adiciona linhas para URLs com problemas
                urlsComProblema.forEach(function(url) {
                    addTableRow(url, tbody);
                });

                // Adiciona linhas para URLs online
                urlsOnline.forEach(function(url) {
                    addTableRow(url, tbody);
                });
            }

            // Adicionar uma linha à tabela
            function addTableRow(urlInfo, tbody) {
                const tr = $('<tr>').addClass(getStatusClass(urlInfo.Status));

                const link = $('<a>').attr('href', urlInfo.Url).attr('target', '_blank').css('color', 'white').text(urlInfo.Url);
                const tdLink = $('<td>').append(link);

                tr.append(tdLink);
                tr.append(`<td>${urlInfo.Status}</td><td>${getStatusText(urlInfo.Status)}</td><td>${urlInfo.ResponseTimeSeconds}</td>`);

                tbody.append(tr);
            }

            // Obter o texto do status
            function getStatusText(statusCode) {
                switch(statusCode) {
                    case 200: return "Online";
                    case 400: return "Bad Request";
                    case 401: return "Unauthorized";
                    case 403: return "Forbidden";
                    case 404: return "Not Found";
                    case 405: return "Online";
                    case 500: return "Internal Server Error";
                    case 502: return "Bad Gateway";
                    case 503: return "Service Unavailable";
                    case 301: return "Online";
                    case 302: return "Online";     
                    default: return "Desconhecido";
                }
            }

            // Obter a classe de status
            function getStatusClass(statusCode) {
                var excludedStatusCodes = [200, 301, 302, 405];

                // Verifica se o código de status está na lista de códigos excluídos
                if (excludedStatusCodes.includes(statusCode)) {
                    return 'table-success';
                } else {
                    return 'table-danger';
                }
            }

        });





