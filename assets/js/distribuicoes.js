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


//mascara dos campos telefone pinpunk - biblioteca mask jquery
$('#cadastroLinha').mask("(00)00000-0000");



$('#cadastroMatricula').blur(function () {
    let matricula = $(this).val()

    if (matricula == '') {
        return
    }

    $.ajax({
        url: base_url('Distribuicoes/consultarColaboradorPelaMatricula'),
        dataType: 'json',
        type: 'Post',
        data: {
            matricula
        }
    }).done(function (response) {
        if (response.status) {
            $('#cadastroColaborador').val(response.colaborador)

            return
        }

        $('#cadastroColaborador').val("NÃO ENCONTRADO")
    }).fail(function (response) {
        console.log(response)

        alert("Ocorreu um erro ao consultar a matrícula. Contate o administrador do sistema")
    })
})

$('#cadastroImei').blur(function () {
    let imei = $(this).val()

    if (imei == '') {
        return
    }

    $.ajax({
        url: base_url('Distribuicoes/consultarModeloPeloImei'),
        dataType: 'json',
        type: 'Post',
        data: {
            imei
        }
    }).done(function (response) {
        if (response.status) {
            $('#cadastroModelo').val(response.modelo)

            return
        }

        $('#cadastroModelo').val("NÃO ENCONTRADO")
    }).fail(function (response) {
        console.log(response)

        alert("Ocorreu um erro ao consultar o imei. Contate o administrador do sistema")
    })
})

$('#cadastroSemAparelho').click(function () {
    if ($(this).is(':checked')) {
        $('#cadastroModelo').val("")
        $('#cadastroImei').val("").prop('disabled', true)

        $('#cadastroLinha').prop('disabled', false)
        $('#cadastroSemLinha').prop('checked', false)
        return
    }

    $('#cadastroImei').val("").prop('disabled', false).focus()
})

$('#cadastroLinha').blur(function () {
    let numeroLinha = $(this).val()

    if (numeroLinha == '') {
        return
    }

    $.ajax({
        url: base_url('Distribuicoes/consultarCategoriaPeloNumero'),
        dataType: 'json',
        type: 'Post',
        data: {
            numeroLinha
        }
    }).done(function (response) {
        if (response.status) {
            $('#cadastroCategoria').val(response.categoria)

            return
        }

        $('#cadastroCategoria').val("NÃO ENCONTRADO")
    }).fail(function (response) {
        console.log(response)

        alert("Ocorreu um erro ao consultar o número da linha. Contate o administrador do sistema")
    })
})

$('#cadastroSemLinha').click(function () {
    if ($(this).is(':checked')) {
        $('#cadastroCategoria').val("")
        $('#cadastroLinha').val("").prop('disabled', true)

        $('#cadastroImei').prop('disabled', false)
        $('#cadastroSemAparelho').prop('checked', false)
        return
    }

    $('#cadastroLinha').val("").prop('disabled', false).focus()
})

$('#btnSalvarAparelho').click(function () {
    $.ajax({
        url: base_url('Distribuicoes/salvaDistribuicao'),
        dataType: 'json',
        type: 'Post',
        data: {
            matricula: $("#cadastroMatricula").val()
        }
    }).done(function (response) {
        console.log(response)
    }).fail(function (response) {
        console.log(response)

        alert("Ocorreu um erro ao consultar o imei. Contate o administrador do sistema")
    })
})