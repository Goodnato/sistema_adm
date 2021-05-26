<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloAtual; ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/datatable-bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-multiselect.min.css"); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url($caminhoCss); ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">SPD FACILITIES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if (!empty($arrayAcessoPaginas) || in_array(PAGINA_APARELHOS, $arrayAcessoPaginas)) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('Aparelhos/') ?>">Aparelhos</a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($arrayAcessoPaginas) || in_array(PAGINA_LINHAS, $arrayAcessoPaginas)) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('Linhas/') ?>">Linhas</a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($arrayAcessoPaginas) || in_array(PAGINA_DISTRIBUICOES, $arrayAcessoPaginas)) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('Distribuicoes/') ?>">Distribuições</a>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Olá, <?= $this->session->dadosUsuario['nome'] ?> <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item disabled text-primary" href="#"><?= $this->session->dadosUsuario['hierarquia'] ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalAlterarSenha">Alterar senha</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('Sistemas/sair') ?>">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="modalAlterarSenha" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary">Alterar senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div id="editaAlert" class="alert alert-danger d-none" role="alert">
                                    <div id="editaMensagem"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="senhaAntiga">Senha antiga</label>
                                    <input type="password" class="form-control" id="senhaAntiga" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="senhaNova">Senha nova</label>
                                    <input type="password" class="form-control" id="senhaNova" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="senhaRepetir">Confirme a senha</label>
                                    <input type="password" class="form-control" id="senhaRepetir" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnSalvarSenha"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </div>
    </div>