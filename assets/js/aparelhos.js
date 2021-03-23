$('#pesquisaMarca').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    enableFiltering: true,
    filterPlaceholder: 'Procurar',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaMarca').multiselect('selectAll', false);

$('#pesquisaModelo').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    enableFiltering: true,
    filterPlaceholder: 'Procurar',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaModelo').multiselect('selectAll', false);

$('#pesquisaCadastradoPor').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    enableFiltering: true,
    filterPlaceholder: 'Procurar',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaCadastradoPor').multiselect('selectAll', false);

$('#pesquisaStatusCondicoes').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaStatusCondicoes').multiselect('selectAll', false);

$('#pesquisaDisponibilidade').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaDisponibilidade').multiselect('selectAll', false);

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

$('#cadastroModelo').multiselect({
    buttonWidth: '100%',
    enableFiltering: true,
    filterPlaceholder: 'Procurar',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});

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

$('#cadastroCondicaoAparelho').multiselect({
    buttonWidth: '100%',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});

$("#cadastroValorNotaFiscal").maskMoney({ 
    prefix: 'R$ ', 
    allowNegative: false, 
    thousands: '.', 
    decimal: ','
});

$("#cadastroModelo").change(function(e){
    let idModelo = $(this).val()

    $.ajax({
        url: base_url("Aparelhos/consultaMarcaPeloModelo"),
        dataType: "json",
        type: "Post",
        data: { idModelo: idModelo }
    }).done(function(response){
        if(response.status){
            $('#cadastroMarca').val(response.mensagem[0].id).multiselect("refresh")
            
            return true;
        }
    }).fail(function(response){
        alert("Ocorreu um erro ao pesquisar os modelos. Contate o administrador do sistema")
        console.log(response)
    })
})

$('#btnSalvarAparelho').click(function (event) {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    setTimeout(() => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Aparelho salvo com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            //$('#exampleModal').modal('hide')

            limpaFormularioCadastro()

            $('#btnSalvarAparelho')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }, 1000)
})

function limpaFormularioCadastro() {
    $('#cadastroImei').val('')
    $("#cadastroModelo").val($("#cadastroModelo option:first").val()).multiselect('refresh');
    $("#cadastroMarca").val($("#cadastroMarca option:first").val()).multiselect('refresh');
    $("#cadastroCondicaoAparelho").val($("#cadastroCondicaoAparelho option:first").val()).multiselect('refresh');
    $('#cadastroNotaFiscal').val('')
    $('#cadastroDataNotaFiscal').val('')
    $('#cadastroValorNotaFiscal').val('')
}