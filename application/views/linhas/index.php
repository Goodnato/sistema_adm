<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linhas</title>
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-multiselect.min.css"); ?>"> <!--para função selecionar multiplos items no select  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> <!-- biblioteca do font-awesome-->

    <style>
        label {
            font-weight: bold;
        }
    </style>
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SISTEMA ADM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Aparelhos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Linhas <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Olá, Cleyton <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item disabled text-primary" href="#">Administrador</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Configuraçao</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Painel de filtros de linhas -->
    <div class="container-fluid">
                <div class="row justify-content-center mt-5">
                    <div class="col-6 p-3" style="background-color: #FAFBFC;">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="text-center">Linhas</h1>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">Número da Linha</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">Código do Chip</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="formGroupExampleInput" class="form-label">Categoria</label><br>
                                    <!-- Build your select: -->
                                    <select id="example-getting-started" multiple="multiple">
                                        <option value="cheese">Categoria I </option>
                                        <option value="tomatoes">Categoria II</option>
                                        <option value="mozarella">Categoria III</option>
                                        <option value="mushrooms">Categoria IV</option>
                                        <option value="pepperoni">Categoria V</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="formGroupExampleInput" class="form-label">Status</label><br>
                                    <!-- Build your select: -->
                                    <select id="example-getting-started2" multiple="multiple">
                                        <option value="cheese">Em uso</option>
                                        <option value="tomatoes">Disponível</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i> Pesquisar</button>
                                    <button class="btn btn-warning"><i class="fas fa-file-excel"></i> Excel</button>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-square"></i> Nova Linha</button>
                                    <!-- botão do modal botão do modal /// ids do modal => data-toggle="modal" data-target="#exampleModal" -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- tabela -->
                <div class="row mt-5">
                    <div class="table-responsive">
                        <table class="table table-striped" style="min-width: 1200px;">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                     </div>
                </div>
    </div>

    <!-- modal cadastrar linhas-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Nova Linha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Número da Linha</label>
                                            <input type="number" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Código do Chip</label>
                                            <input type="number" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Categoria</label>
                                            <select class="form-control form-control-sm">
                                                <option value="1">Selecione aqui </option>
                                                <option value="1">Categoria I </option>
                                                <option value="2">Categoria II</option>
                                                <option value="3">Categoria III</option>
                                                <option value="3">Categoria IV</option>
                                                <option value="3">Categoria V</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Operadora</label>
                                            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">PIN-PUK1</label>
                                            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                        <div class="col-6">
                                        <label for="formGroupExampleInput" class="form-label">PIN-PUK2</label>
                                            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnSalvarLinha"><i class="fas fa-save"></i> Cadastrar </button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script> <!-- multi-select -->
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-multiselect.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/alertsweet2.min.js'); ?>"></script> <!--libraries alertsweet2 para exibir telas de mensagens/notificações -->
    
    <!-- javascript do multiselect, definição de padrões e traduções-->
    <script>
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

    </script>

</body>

</html>