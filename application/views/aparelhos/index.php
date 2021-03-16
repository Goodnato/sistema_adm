<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aparelhos</title>
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-multiselect.min.css"); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Aparelhos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Linhas <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Olá Renato <i class="fas fa-user"></i>
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
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-6 p-3" style="background-color: #FAFBFC;">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-center">Aparelhos</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Marca</label>
                            <select id="example-getting-started5" multiple="multiple">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Modelo</label>
                            <select id="example-getting-started4" multiple="multiple">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">IMEI</label>
                            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Área</label>
                            <select id="example-getting-started3" multiple="multiple">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="formGroupExampleInput" class="form-label">Estado</label>
                            <select id="example-getting-started2" multiple="multiple">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="formGroupExampleInput" class="form-label">Status</label><br>
                            <select id="example-getting-started" multiple="multiple">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button class="btn btn-primary"><i class="fas fa-search"></i> Pesquisar</button>
                            <button class="btn btn-warning"><i class="fas fa-file-excel"></i> Excel</button>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-square"></i> Novo aparelho</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Novo aparelho</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <label for="formGroupExampleInput" class="form-label">Marca</label>
                                            <select class="form-control form-control-sm">
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="formGroupExampleInput" class="form-label">Modelo</label>
                                            <select class="form-control form-control-sm">
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label for="formGroupExampleInput" class="form-label">IMEI</label>
                                            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Estado</label>
                                            <select class="form-control form-control-sm">
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Nota fiscal</label>
                                            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                        </div>
                                        <div class="col-6">
                                            <label for="formGroupExampleInput" class="form-label">Valor R$</label>
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
                    <button type="button" class="btn btn-success" id="btnSalvarAparelho"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-multiselect.min.js'); ?>"></script>
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
        })
    </script>
</body>

</html>