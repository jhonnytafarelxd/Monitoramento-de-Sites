function adicionarLink() {
    var novaUrl = $('#novaUrl').val();
    if (novaUrl.trim() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Por favor, insira uma URL válida.'
        });
        return;
    }
    // Envia uma solicitação AJAX para adicionar o novo URL no banco de dados
    $.ajax({
        url: 'backend/adicionar_link.php',
        type: 'POST',
        data: { url: novaUrl },
        success: function(response) {
            if (response === 'success') {
                $('#linksTable tbody').append('<tr><td>' + novaUrl + '</td><td><button class="btn btn-danger" onclick="confirmarDeletarLink(this)">Deletar</button></td></tr>');
                $('#adicionarModal').modal('hide');
                $('#novaUrl').val('');
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Link adicionado com sucesso.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao adicionar o link.'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao adicionar o link.'
            });
        }
    });
}


function deletarLink(id) {
    // Enviar uma solicitação GET para deletar o link com base no ID
    $.get('backend/deletar_link.php?id=' + id)
        .done(function(response) {
            if (response === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Link deletado com sucesso.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao deletar o link.'
                });
            }
        })
        .fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao deletar o link.'
            });
        });
}

function confirmarDeletarLink(id) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você realmente deseja deletar este link?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            deletarLink(id);
        }
    });
}



