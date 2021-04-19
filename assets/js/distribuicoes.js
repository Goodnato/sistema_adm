$('#pesquisaColaborador').multiselect({
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
$('#pesquisaColaborador').multiselect('selectAll', false);

$('#pesquisaCidade').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaCidade').multiselect('selectAll', false);

$('#pesquisaArea').multiselect({
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
$('#pesquisaArea').multiselect('selectAll', false);

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

$('#cadastroMatricula').blur(function () {
    let matricula = $(this).val()

    $.ajax({
        url: base_url('Distribuicoes/consultarColaboradorPelaMatricula'),
        dataType: 'json',
        type: 'Post',
        data: {
            matricula
        }
    }).done(function (response) {
        if(response.status) {
            $('#cadastroColaborador').val(response.colaborador)

            return
        }

        $('#cadastroColaborador').val("NÃO ENCONTRADO")
    }).fail(function (response){
        console.log(response)

        alert("Ocorreu um erro ao consultar a matrícula. Contate o administrador do sistema")
    })
})


$('#cadastroImei').blur(function () { 
   let imei = $(this).val() 

   $.ajax({
       url: base_url('Distribuicoes/consultarModeloPeloImei'),
       dataType: 'json',
       type: 'Post',
       data: {
           imei
       }
    }).done(function (response) {
        if(response.status){
            $('#cadastroModelo').val(response.modelo)

            return
        }

        $('#cadastroModelo').val("NÃO ENCONTRADO")
    }).fail(function (response) {
        console.log(response)

        alert("Ocorreu um erro ao consultar o imei. Contate o administrador do sistema")
    })
})


$('#cadastroLinha').blur(function () { 
    let numeroLinha = $(this).val()

   $.ajax({
       url: base_url('Distribuicoes/consultarCategoriaPeloNumero'),
       dataType: 'json',
       type: 'Post',
       data: {
            numeroLinha 
       }
     }).done(function (response) {
         if(response.status){
             $('#cadastroCategoria').val(response.categoria)
 
             return
         }
 
         $('#cadastroCategoria').val("NÃO ENCONTRADO")
     }).fail(function (response) {
         console.log(response)
 
         alert("Ocorreu um erro ao consultar o número da linha. Contate o administrador do sistema")
     })
 })