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

$('#cadastroMarca').multiselect({
    buttonWidth: '100%',
    enableFiltering: true,
    filterPlaceholder: 'Procurar',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});

//codigo abaixo de jquery e para manipular elementos, neste caso o efeito de carregando do botão salvar
$('#btnSalvarLinha').click(function(event) {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    setTimeout(() => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Linha cadastrada com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            //$('#exampleModal').modal('hide')

            limpaFormularioCadastroLinha()

            $('#btnSalvarLinha')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }, 1000)
})

function limpaFormularioCadastroLinha() {
    $('#cadastroNumero').val('')
    $('#cadastroCodigoChip').val('')
    $("#cadastroCategoria").val($("#cadastroCategoria option:first").val()).multiselect('refresh');
    $('#cadastroOperadora').val('')
    $('#cadastroPinPuk1').val('')
    $('#cadastroPinPuk2').val('')
}

