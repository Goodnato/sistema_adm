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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SISTEMA ADM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?=$paginaAtual == PAGINA_APARELHOS ? 'active' : ''?>" href="<?= base_url('Aparelhos/') ?>">Aparelhos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$paginaAtual == PAGINA_LINHAS ? 'active' : ''?>" href="<?= base_url('Linhas/') ?>">Linhas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$paginaAtual == PAGINA_DISTRIBUICOES ? 'active' : ''?>" href="<?= base_url('Distribuicoes/') ?>">Distribuições</a>
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