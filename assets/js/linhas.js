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

//mascara dos campos telefone pinpunk - biblioteca mask jquery
$('#pesquisaNumero').mask("(00)00000-0000");
$('#cadastroNumero').mask("(00)00000-0000");
$('#cadastroPinPuk1').mask("0000-00000000");
$('#cadastroPinPuk2').mask("0000-00000000");


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
const tabelaLinhas = $("#tabelaLinhas").dataTable({
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
        
    ],

    columnDefs: [
        {
            targets: [4],
            orderable: false
        },
        {
            targets: [4],
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

