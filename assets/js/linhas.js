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

$('#example-getting-started2').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#example-getting-started2').multiselect('selectAll', false);

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
            $('#exampleModal').modal('hide')

            $('#btnSalvarLinha')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }, 1000)
})

