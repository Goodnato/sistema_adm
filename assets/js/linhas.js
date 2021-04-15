//javascript do multiselect, definição de padrões e traduções tela pesquisa
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

$('#pesquisaCadastradoPor').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaCadastradoPor').multiselect('selectAll', false);

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

$('#pesquisaStatusLinha').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});
$('#pesquisaStatusLinha').multiselect('selectAll', false);

//javascript do multiselect, definição de padrões e traduções tela cadastro
$('#cadastroCategoria').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});


$('#cadastroOperadora').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});


$('#editaCategoria').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});

$('#editaOperadora').multiselect({
    buttonWidth: '100%',
    includeSelectAllOption: true,
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});

//mascara dos campos telefone pinpunk - biblioteca mask jquery
$('#pesquisaNumero').mask("(00)00000-0000");
$('#cadastroNumero').mask("(00)00000-0000");
$('#cadastroPinPuk1').mask("0000-00000000");
$('#cadastroPinPuk2').mask("0000-00000000");
$('#cadastroCodigoChip').mask("000000000000000");
$('#editaPinPuk1').mask("0000-00000000");
$('#editaPinPuk2').mask("0000-00000000");

//codigo abaixo de jquery para o botão salvar do modal cadastro efeitos, acionar metodos de Salvar linha
$('#btnSalvarLinha').click(function(event) {
    $(this) 
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...') // para manipular elementos, neste caso o efeito de carregando do botão salvar
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
            pinPuk2: $('#cadastroPinPuk2').val(),
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

//limpa o formulário do modal de cadastro
function limpaFormularioCadastroLinha() {
    $('#cadastroNumero').val('')
    $('#cadastroCodigoChip').val('')
    $("#cadastroCategoria").val($("#cadastroCategoria option:first").val()).multiselect('refresh');
    $("#cadastroOperadora").val($("#cadastroOperadora option:first").val()).multiselect('refresh');
    $('#cadastroPinPuk1').val('')
    $('#cadastroPinPuk2').val('')
}

//javascript da tabela que aciona o metodo Lista Linhas
const tabelaLinhas = $("#tabelaLinhas").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "type": "post",
        "url": base_url("Linhas/listaLinhas"),
        dataType: "json",
        data: function (d) {
            d.numeroLinha = $("#pesquisaNumero").val()
            d.codigoChip = $("#pesquisaCodigoChip").val()
            d.idCategoria = $("#pesquisaCategoria").val()
            d.idUsuarioRegistro = $("#pesquisaCadastradoPor").val()
            d.idDisponibilidade = $("#pesquisaDisponibilidade").val()
            d.status = $("#pesquisaStatusLinha").val()
        }
    },
    "columns": [
        { "data": "id_linha" },
        { "data": "numero_linha" },
        { "data": "codigo_chip" },
        { "data": "nome_categoria" },
        { "data": "status" },
        {
            data: "acao",
            render: function (data, type, row, meta) {
                return '<button style="padding: 0 5px;" class="btn btn-primary visualizar"><i class="fas fa-eye"></i></button>';
            }
        }
        
    ],

    columnDefs: [
        {
            targets: [5],
            orderable: false
        },
        {
            targets: [5],
            className: "text-center",
        }
    ],

    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
    }
});


$("#btnPesquisarFiltros").click(function (event) {
    event.preventDefault()

    tabelaLinhas.ajax.reload();
})

//codigo javascritp referente ao modal visualizar da tabela para editar os dados. Aciona o icone ver na tabela
tabelaLinhas.on('click', '.visualizar', function (event) {
    let td = $(this).closest('tr').find('td')
    let idLinha = td.eq(0).text()
    
    $.ajax({
        url: base_url("Linhas/visualizarLinha"),
        dataType: "json",
        type: "Post",
        data: {
            idLinha 
        }
    }).done(function (response) {
        if (response.status) {
            $('#tituloLinha').text(response.linha.numero_linha)
            $('#editaNumeroLinha').val(response.linha.numero_linha)
            $('#editaCodigoChip').val(response.linha.codigo_chip)
            $('#editaCategoria').val(response.linha.nome_categoria)
            $('#editaOperadora').val(response.linha.nome_operadora)
            $('#editaPinPuk1').val(response.linha.pin_puk1)
            $('#editaPinPuk2').val(response.linha.pin_puk2)
            $('#editaCadastradoPor').val(response.linha.nome_usuario_registro)
            //$('#editaValorDisponibilidade').val(response.linha.valor)
            $('#editaStatus').val(response.linha.status)

            $('#modalVerLinha').modal('show')
        }
    }).fail(function (response) {
        alert("Ocorreu um erro ao visualizar a linha. Contate o administrador do sistema")
        console.log(response)
        $('#modalVerLinha').modal('hide')
    })
})


$('#btnEditarLinha').click(function (event) {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    $('#editaAlert').addClass('d-none')
    $('#editaMensagem').html('')


    $.ajax({
        url: base_url("Linhas/editarLinha"),
        dataType: "json",
        type: "Post",
        data: {
            idLinha: $('#editaIdLinha').val(),
            idCategoria: $('#editaCategoria').val(),
            idOperadora: $('#editaOperadora').val(),
            pinPuk1: $('#editaPinPuk1').val(),
            pinPuk2: $('#editaPinPuk2').val(),
            status: $('#editaStatus').val()
        }
    }).done(function (response) {
        if (!response.status) {
            $('#editaMensagem').html(response.mensagem)
            $('#editaAlert').removeClass('d-none')

            $('#btnEditarLinha')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)

            return false
        }

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Linha alterada com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            tabelaLinhas.ajax.reload()
            $('#modalVerLinha').modal('hide')


            $('#btnEditarLinha')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }).fail(function (response) {
        alert("Ocorreu um erro ao pesquisar os modelos. Contate o administrador do sistema")
        console.log(response)
        $('#btnEditarLinha')
            .html('<i class="fas fa-save"></i> Salvar')
            .prop('disabled', false)
    })
})

$('#modalVerLinha').on('hidden.bs.modal', function (e) {
    limpaFormularioEditar()
})

function limpaFormularioEditar() {
    $('#tituloLinha').text('')
    $('#editaNumeroLinha').val('')
    $("#editaCodigoChip").val('')
    $("#editaCategoria").val($("#editaCategoria option:first").val()).multiselect('refresh')
    $("#editaOperadora").val($("#editaOperadora option:first").val()).multiselect('refresh')
    $('#editaPinPuk1').val('')
    $('#editaCadastradoPor').val('')
    $('#editaValorDisponibilidade').val('')
}

