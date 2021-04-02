//javascript do multiselect, definição de padrões e traduções
$('#pesquisaCategoria').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaCategoria').multiselect('selectAll', false);

$('#pesquisaStatus').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaStatus').multiselect('selectAll', false);


$('#cadastroCategoria').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#cadastroCategoria').multiselect('selectAll', false);

$('#cadastroOperadora').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#cadastroOperadora').multiselect('selectAll', false);


//codigo abaixo de jquery e para manipular elementos, neste caso o efeito de carregando do botão salvar
$('#btnSalvarLinha').click(function(event) {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)
    //faz exibir d-none seção de mensagens. d-nome é pra ocultar a seção
    $('#cadastroAlert').addClass('d-none')
    $('#cadastroMensagem').html('')
    //ajax para pegar os dados do formulário no modal pelo metodo post 
    $.ajax({
        url: base_url("Linhas/salvarLinha"),
        dataType: "json",
        type: "Post",
        data: { 
            numeroLinha: $('#cadastroNumero').val(), 
            codigoChip: $('#cadastroCodigoChip').val(),
            idCategoria: $('#cadastroCategoria').val(),
            idOperadora: $('#cadastroOperadora').val(),
            pinPuk1: $('#cadastroPinPuk1').val(),
            pinPuk2: formataDecimal($('#cadastroPinPuk2').val()),
        }
    }).done(function (response) {
        if(!response.status){
            $('#cadastroMensagem').html(response.mensagem) //prepara a mensagem de erro
            $('#cadastroAlert').removeClass('d-none') //remove class d-nome para exibir a seção

            $('#btnSalvarLinha')
                .html('<i class="fas fa-save"></i> Salvar') // quando exibe o erro o botão volta o texto salvar
                .prop('disabled', false)

            return false
        }

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Linha cadastrada com sucesso!',
                showConfirmButton: false,
                timer: 1500,
                heightAuto: false
            }).then((result) => {
                $('#modalNovaLinha').modal('hide')

                limpaFormularioCadastroLinha()

                $('#btnSalvarLinha')
                    .html('<i class="fas fa-save"></i> Salvar')
                    .prop('disabled', false)
            })
    })   
})

function limpaFormularioCadastroLinha() {
    $('#cadastroNumero').val('')
    $('#cadastroCodigoChip').val('')
    $("#cadastroCategoria").val($("#cadastroCategoria option:first").val()).multiselect('refresh');
    $("#cadastroOperadora").val($("#cadastroOperadora option:first").val()).multiselect('refresh');
    $('#cadastroPinPuk1').val('')
    $('#cadastroPinPuk2').val('')
}

