const tabelaDistribuicao = $("#tabelaDistribuicao").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        type: "post",
        url: base_url("Distribuicoes/listaDistribuicoes"),
        dataType: "json",
        data: function (d) {
            d.imei = $("#pesquisaImei").val()
            d.numeroLinha = $("#pesquisaNumero").val()
            d.nomeColaborador = $("#pesquisaColaborador").val()
            d.matricula = $("#pesquisaMatricula").val()
            d.cidade = $("#pesquisaCidade").val()
            d.area = $("#pesquisaArea").val()
            d.idDisponibilidade = $("#pesquisaDisponibilidade").val()
        }
    },
    columns: [
        { data: "id_distribuicao" },
        { data: "modelo" },
        { data: "numero_linha" },
        { data: "nome_colaborador" },
        { data: "centro_custo" },
        { data: "cidade" },
        { data: "status_disponibilidade" },
        {
            data: "acao",
            render: function (data, type, row, meta) {
                return '<button style="padding: 0 5px;" class="btn btn-primary visualizar"><i class="fas fa-eye"></i></button>';
            }
        }
    ],
    columnDefs: [
        {
            targets: [7],
            orderable: false
        },
        {
            targets: [7],
            className: "text-center",
        }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
    }
});

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
        $('#cadastroModelo').val(response.mensagem)
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
        $('#cadastroCategoria').val(response.mensagem)
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

$('#btnSalvarDistribuicao').click(function () {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    $.ajax({
        url: base_url('Distribuicoes/salvaDistribuicao'),
        dataType: 'json',
        type: 'Post',
        data: {
            matricula: $("#cadastroMatricula").val(),
            imei: $("#cadastroImei").val(),
            semAparelho: $("#cadastroSemAparelho").is(":checked") ? 1 : 0,
            linha: $("#cadastroLinha").val(),
            semLinha: $("#cadastroSemLinha").is(":checked") ? 1 : 0,
        }
    }).done(function (response) {
        if (!response.status) {
            $('#cadastroMensagem').html(response.mensagem)
            $('#cadastroAlert').removeClass('d-none')

            $('#btnSalvarDistribuicao')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)

            return false
        }

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Salvo com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            $('#modalNovaDistribuicao').modal('hide')

            limpaFormularioCadastro()

            $('#btnSalvarDistribuicao')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })

    }).fail(function (response) {
        alert("Ocorreu um erro ao salvar a distribuição. Contate o administrador do sistema")
        console.log(response)
        $('#btnSalvarDistribuicao')
            .html('<i class="fas fa-save"></i> Salvar')
            .prop('disabled', false)
    })
})

function limpaFormularioCadastro() {
    $('#cadastroMatricula').val('')
    $('#cadastroColaborador').val('')
    $('#cadastroImei').val('').prop('disabled', false)
    $('#cadastroSemAparelho').prop('checked', false)
    $('#cadastroModelo').val('')
    $('#cadastroLinha').val('').prop('disabled', false)
    $('#cadastroSemLinha').prop('checked', false)
    $('#cadastroCategoria').val('')
}