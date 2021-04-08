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

$('#cadastroStatusCondicaoAparelho').multiselect({
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

$("#cadastroModelo").change(function (e) {
    let idModelo = $(this).val()

    $.ajax({
        url: base_url("Aparelhos/consultaMarcaPeloModelo"),
        dataType: "json",
        type: "Post",
        data: { idModelo: idModelo }
    }).done(function (response) {
        if (response.status) {
            $('#cadastroMarca').val(response.marca.nome)

            return true;
        }

        $('#cadastroMarca').val('SELECIONE UM MODELO')
    }).fail(function (response) {
        alert("Ocorreu um erro ao pesquisar os modelos. Contate o administrador do sistema")
        console.log(response)
    })
})

$('#btnSalvarAparelho').click(function (event) {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    $('#cadastroAlert').addClass('d-none')
    $('#cadastroMensagem').html('')

    $.ajax({
        url: base_url("Aparelhos/salvarAparelho"),
        dataType: "json",
        type: "Post",
        data: {
            imei: $('#cadastroImei').val(),
            idModelo: $('#cadastroModelo').val(),
            idStatusCondicaoAparelho: $('#cadastroStatusCondicaoAparelho').val(),
            notaFiscal: $('#cadastroNotaFiscal').val(),
            dataNotaFiscal: $('#cadastroDataNotaFiscal').val(),
            valorNotaFiscal: formataDecimal($('#cadastroValorNotaFiscal').val()),
        }
    }).done(function (response) {
        if (!response.status) {
            $('#cadastroMensagem').html(response.mensagem)
            $('#cadastroAlert').removeClass('d-none')

            $('#btnSalvarAparelho')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)

            return false
        }

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Aparelho salvo com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            $('#modalNovoAparelho').modal('hide')

            limpaFormularioCadastro()

            $('#btnSalvarAparelho')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }).fail(function (response) {
        alert("Ocorreu um erro ao pesquisar os modelos. Contate o administrador do sistema")
        console.log(response)
        $('#btnSalvarAparelho')
            .html('<i class="fas fa-save"></i> Salvar')
            .prop('disabled', false)
    })
})

function limpaFormularioCadastro() {
    $('#cadastroImei').val('')
    $("#cadastroModelo").val($("#cadastroModelo option:first").val()).multiselect('refresh');
    $("#cadastroStatusCondicaoAparelho").val($("#cadastroStatusCondicaoAparelho option:first").val()).multiselect('refresh');
    $('#cadastroMarca').val('SELECIONE UM MODELO')
    $('#cadastroNotaFiscal').val('')
    $('#cadastroDataNotaFiscal').val('')
    $('#cadastroValorNotaFiscal').val('')
}

const tabelaAparelhos = $("#tabelaAparelhos").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        type: "post",
        url: base_url("Aparelhos/listaAparelhos"),
        dataType: "json",
        data: function (d) {
            d.idMarca = $("#pesquisaMarca").val()
            d.idModelo = $("#pesquisaModelo").val()
            d.imei = $("#pesquisaImei").val()
            d.idUsuarioRegistro = $("#pesquisaCadastradoPor").val()
            d.idStatusCondicaoAparelho = $("#pesquisaStatusCondicoes").val()
            d.idDisponibilidade = $("#pesquisaDisponibilidade").val()
            d.status = $("#pesquisaStatus").val()
        }
    },
    columns: [
        { data: "id_aparelho" },
        { data: "imei1" },
        { data: "nome_marca" },
        { data: "nome_modelo" },
        { data: "status_condicao" },
        {
            data: "valor",
            render: function (data, type, row, meta) {
                return 'R$ ' + parseFloat(data).toLocaleString('pt-br', { minimumFractionDigits: 2 });
            }
        },
        { data: "status" },
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

$("#btnPesquisarFiltros").click(function (event) {
    event.preventDefault()

    tabelaAparelhos.ajax.reload();
})