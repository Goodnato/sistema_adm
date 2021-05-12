function formataDecimal(value) {
    return value.substring(3).replace(".", "").replace(",", ".")
}

$('#btnSalvarSenha').click(function () {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    $('#editaAlert').addClass('d-none')
    $('#editaMensagem').html('')

    $.ajax({
        url: base_url("Sistemas/alterarSenha"),
        dataType: "json",
        type: "Post",
        data: {
            senhaAntiga: $('#senhaAntiga').val(),
            senhaNova: $('#senhaNova').val(),
            senhaRepetir: $('#senhaRepetir').val(),
        }
    }).done(function (response) {
        if (!response.status) {
            $('#editaMensagem').html(response.mensagem)
            $('#editaAlert').removeClass('d-none')

            $('#btnSalvarSenha')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)

            return false
        }

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Alterado com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            $('#btnSalvarSenha').modal('hide')

            $('#senhaAntiga').val('')
            $('#senhaNova').val('')
            $('#senhaRepetir').val('')

            $('#btnSalvarSenha')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }).fail(function (response) {
        alert("Ocorreu um erro ao pesquisar os modelos. Contate o administrador do sistema")
        console.log(response)
        $('#btnSalvarSenha')
            .html('<i class="fas fa-save"></i> Salvar')
            .prop('disabled', false)
    })
})