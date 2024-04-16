       $(document).ready(function() {
            $('#tabela-erros').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                },
                "order": [
                    [3, 'desc']
                ], // Ordenar por data e hora, da mais recente para a mais antiga
                "buttons": [
                    'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar para Excel',
                        filename: 'erros_excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        titleAttr: 'Exportar para Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar para PDF',
                        filename: 'erros_pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        titleAttr: 'Exportar para PDF',
                        className: 'btn btn-info'
                    }
                ]
            });
           // Event listener para o botão de exclusão
            $('#excluir-dados').click(function() {
                // Exibe o modal Sweet Alert para confirmar a exclusão
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Esta ação irá excluir todos os dados da tabela de erros!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Se o usuário confirmar, faz a requisição AJAX para excluir os dados
                        $.ajax({
                            url: 'backend/limpar_erros.php', // Arquivo PHP que executará a exclusão
                            type: 'POST',
                            success: function(response) {
                                // Se a exclusão for bem-sucedida, recarrega a página para atualizar a tabela
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                // Se houver um erro, exibe uma mensagem de erro
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro!',
                                    text: 'Ocorreu um erro ao excluir os dados.'
                                });
                            }
                        });
                    }
                });
            });
        });