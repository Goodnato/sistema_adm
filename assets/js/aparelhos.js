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

$("#editaStatusCondicaoAparelho").multiselect({
    buttonWidth: '100%',
    selectAllText: 'TODOS',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
});

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

$('#editaStatus').multiselect({
    buttonWidth: '100%',
    nonSelectedText: 'SELECIONE UMA OPÇÃO',
    allSelectedText: 'TODOS',
    nSelectedText: 'SELECIONADO(S)',
    buttonClass: 'form-control form-control-sm'
})

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

$("#editaValorNotaFiscal").maskMoney({
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
    Swal.fire({
        title: 'Deseja salvar o aparelho?',
        text: "Favor, confirme se os dados registrados estão corretos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if (!result.isConfirmed) {
            return
        }

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
                imei2: $('#cadastroImei2').val(),
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
                title: 'Salvo com sucesso!',
                showConfirmButton: false,
                timer: 1500,
                heightAuto: false
            }).then((result) => {
                tabelaAparelhos.ajax.reload()
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
})

function limpaFormularioCadastro() {
    $('#cadastroImei').val('')
    $('#cadastroImei2').val('')
    $("#cadastroModelo").val($("#cadastroModelo option:first").val()).multiselect('refresh');
    $("#cadastroStatusCondicaoAparelho").val($("#cadastroStatusCondicaoAparelho option:first").val()).multiselect('refresh');
    $('#cadastroMarca').val('SELECIONE UM MODELO')
    $('#cadastroNotaFiscal').val('')
    $('#cadastroDataNotaFiscal').val('')
    $('#cadastroValorNotaFiscal').val('')
}

$("#btnPesquisarFiltros").click(function (event) {
    event.preventDefault()

    tabelaAparelhos.ajax.reload()
})

tabelaAparelhos.on('click', '.visualizar', function (event) {
    let td = $(this).closest('tr').find('td')
    let idAparelho = td.eq(0).text()

    $('#btnInativarAparelho').show()
    $('#btnEditarAparelho').show()

    $.ajax({
        url: base_url("Aparelhos/visualizarAparelho"),
        dataType: "json",
        type: "Post",
        data: {
            idAparelho
        }
    }).done(function (response) {
        console.log(response)
        if (response.status) {
            $('#editaIdAparelho').val(idAparelho)
            $('#tituloAparelho').text(response.aparelho.nome_modelo)
            $('#editaImei').val(response.aparelho.imei1)
            $('#editaImei2').val(response.aparelho.imei2)
            $('#editaModelo').val(response.aparelho.nome_modelo)
            $('#editaMarca').val(response.aparelho.nome_marca)
            $('#editaStatusCondicaoAparelho').val(response.aparelho.id_status_condicao_aparelho).multiselect('refresh')
            $('#editaNotaFiscal').val(response.aparelho.nota_fiscal)
            $('#editaDataNotaFiscal').val(response.aparelho.data_nota)
            $('#editaValorNotaFiscal').val(response.aparelho.valor)
            $('#editaValorDepreciado').val(response.aparelho.valor_depreciado)
            $('#editaCadastradoPor').val(response.aparelho.nome_usuario_registro)
            $('#editaValorDisponibilidade').val(response.aparelho.status_disponibilidade)
            $('#editaStatus').val(response.aparelho.status).multiselect('refresh')

			let tabelaLogAparelho = $('#logAparelho')
			tabelaLogAparelho.empty()

			let contador = 1
			let contadorCondicao = 0;

			$.each(response.logs, function (index, value) {
				if(
					(
						parseInt(value.valor_novo.id_status_condicao_aparelho) === STATUS_CONDICAO_MANUTENCAO &&
						parseInt(value.valor_antigo.id_status_condicao_aparelho) !== STATUS_CONDICAO_MANUTENCAO
					)
					||
					(
						parseInt(value.valor_novo.id_status_condicao_aparelho) !== STATUS_CONDICAO_MANUTENCAO &&
						parseInt(value.valor_antigo.id_status_condicao_aparelho) === STATUS_CONDICAO_MANUTENCAO
					)
                    ||
					(
						parseInt(value.valor_novo.status) === STATUS_INATIVO
					)
				) {
					contadorCondicao++;
					
					tabelaLogAparelho.append(
						`<tr>
							<td>${contador}</td>
							<td>${value.nome_usuario}</td>
							<td>${OBJETO_CONDICAO[value.valor_novo.id_status_condicao_aparelho]}</td>
                            <td>${value.valor_novo.status === STATUS_INATIVO ? "INATIVO" : "ATIVO"}</td> 
							<td>${value.data_registro}</td>
						</tr>`
					)
					
					if(contadorCondicao == 2) {
						contadorCondicao = 0;
					}

					contador++;
				}
            })

            if (response.aparelho.status == STATUS_INATIVO) {
                $('#btnInativarAparelho').hide()
                $('#btnEditarAparelho').hide()
            }

            $('#modalVerAparelho').modal('show')
        }
    }).fail(function (response) {
        alert("Ocorreu um erro ao visualizar o aparelho. Contate o administrador do sistema")
        console.log(response)
        $('#modalVerAparelho').modal('hide')
    })
})

$('#modalVerAparelho').on('shown.bs.modal', function () {
    $('#editaValorNotaFiscal').focus().blur();
})

$('#btnEditarAparelho').click(function (event) {
    $(this)
        .html('<div class="spinner-border spinner-border-sm text-light" role="status"></div> Salvando...')
        .prop('disabled', true)

    $('#editaAlert').addClass('d-none')
    $('#editaMensagem').html('')

    $.ajax({
        url: base_url("Aparelhos/editarAparelho"),
        dataType: "json",
        type: "Post",
        data: {
            idAparelho: $('#editaIdAparelho').val(),
            idStatusCondicaoAparelho: $('#editaStatusCondicaoAparelho').val(),
            notaFiscal: $('#editaNotaFiscal').val(),
            dataNotaFiscal: $('#editaDataNotaFiscal').val(),
            valorNotaFiscal: formataDecimal($('#editaValorNotaFiscal').val()),
            status: $('#editaStatus').val()
        }
    }).done(function (response) {
        if (!response.status) {
            $('#editaMensagem').html(response.mensagem)
            $('#editaAlert').removeClass('d-none')

            $('#btnEditarAparelho')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)

            return false
        }

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Alterado com sucesso!',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false
        }).then((result) => {
            tabelaAparelhos.ajax.reload()
            $('#modalVerAparelho').modal('hide')

            limpaFormularioCadastro()

            $('#btnEditarAparelho')
                .html('<i class="fas fa-save"></i> Salvar')
                .prop('disabled', false)
        })
    }).fail(function (response) {
        alert("Ocorreu um erro ao pesquisar os modelos. Contate o administrador do sistema")
        console.log(response)
        $('#btnEditarAparelho')
            .html('<i class="fas fa-save"></i> Salvar')
            .prop('disabled', false)
    })
})

$("#editaStatusCondicaoAparelho").change(function () {
    if ($(this).val() == STATUS_CONDICAO_DESCARTADO) {
        $('#editaStatus').val(STATUS_INATIVO).multiselect('refresh')

        return
    }

    $('#editaStatus').val(STATUS_ATIVO).multiselect('refresh')
})

$('#modalVerAparelho').on('hidden.bs.modal', function (e) {
    limpaFormularioEditar()
})

function limpaFormularioEditar() {
    $('#tituloAparelho').text('')
    $('#editaIdAparelho').val('')
    $('#editaImei').val('')
    $("#editaModelo").val('')
    $('#editaMarca').val('')
    $("#editaStatusCondicaoAparelho").val($("#editaStatusCondicaoAparelho option:first").val()).multiselect('refresh')
    $('#editaNotaFiscal').val('')
    $('#editaDataNotaFiscal').val('')
    $('#editaValorNotaFiscal').val('')
    $('#editaValorDepreciado').val('')
    $('#editaCadastradoPor').val('')
    $('#editaValorDisponibilidade').val('')
    $('#editaStatus').val(STATUS_ATIVO).multiselect('refresh')
}


$("#btnInativarAparelho").click(function () {
    Swal.fire({
        title: 'Deseja Inativar?',
        text: "Não será possível desfazer",
        icon: 'warning',
		input: 'select',
		inputOptions: INATIVO,
		customClass: {
			input: 'form-control-sm mb-1 mt-3 h-100',
		},
		inputPlaceholder: 'SELECIONE MOTIVO',
		inputValidator: (value) => {
			return new Promise((resolve) => {
			  if (value == "") {
				resolve('SELECIONE UM MOTIVO')
			  } else {
				  resolve()
			  }
			})
		},
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if (!result.isConfirmed) {
            return
        }

        let idAparelho = $("#editaIdAparelho").val()
        $.ajax({
            url: base_url("Aparelhos/inativarAparelho"),
            dataType: "json",
            type: "Post",
            data: {
                idAparelho,
				idMotivoInativacao: result.value
            }
        }).done(function (response) {
			if(response.status) {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Inativado com sucesso!',
					showConfirmButton: false,
					timer: 1500,
					heightAuto: false
				}).then((result) => {
					tabelaAparelhos.ajax.reload()
					$('#modalVerAparelho').modal('hide')
				})

				return
			}

			alert(response.mensagem)
        }).fail(function (response) {
            alert("Ocorreu um erro ao inativar o aparelho. Contate o administrador do sistema")
            console.log(response)
            $('#modalVerDistribuicao').modal('hide')
        })
    })
})
