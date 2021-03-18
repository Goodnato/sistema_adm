$('#example-getting-started').multiselect({
        buttonWidth: '100%',
        includeSelectAllOption: true,
        selectAllText: 'TODOS',
        nonSelectedText: 'SELECIONE UMA OPÇÃO',
        allSelectedText: 'TODOS',
        nSelectedText: 'SELECIONADO(S)',
        buttonClass: 'form-control form-control-sm'
    });
    $('#example-getting-started').multiselect('selectAll', false);

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

    $('#example-getting-started3').multiselect({
        buttonWidth: '100%',
        includeSelectAllOption: true,
        selectAllText: 'TODOS',
        nonSelectedText: 'SELECIONE UMA OPÇÃO',
        allSelectedText: 'TODOS',
        nSelectedText: 'SELECIONADO(S)',
        buttonClass: 'form-control form-control-sm'
    });
    $('#example-getting-started3').multiselect('selectAll', false);

    $('#example-getting-started4').multiselect({
        buttonWidth: '100%',
        includeSelectAllOption: true,
        selectAllText: 'TODOS',
        nonSelectedText: 'SELECIONE UMA OPÇÃO',
        allSelectedText: 'TODOS',
        nSelectedText: 'SELECIONADO(S)',
        buttonClass: 'form-control form-control-sm'
    });
    $('#example-getting-started4').multiselect('selectAll', false);

    $('#example-getting-started5').multiselect({
        buttonWidth: '100%',
        includeSelectAllOption: true,
        selectAllText: 'TODOS',
        nonSelectedText: 'SELECIONE UMA OPÇÃO',
        allSelectedText: 'TODOS',
        nSelectedText: 'SELECIONADO(S)',
        buttonClass: 'form-control form-control-sm'
    });
    $('#example-getting-started5').multiselect('selectAll', false);

    $('#btnSalvarAparelho').click(function(event) {
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
                $('#exampleModal').modal('hide')

                $('#btnSalvarAparelho')
                    .html('<i class="fas fa-save"></i> Salvar')
                    .prop('disabled', false)
            })
        }, 1000)
    })