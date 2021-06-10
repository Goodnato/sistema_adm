<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Login</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 420px;
            padding: 15px;
            margin: auto;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            height: 3.125rem;
            padding: .75rem;
        }
    </style>

</head>

<body>

    <!-- imagem do logotipo claro-->
    <!-- para chamar imagens necessário incluir o echo base_url devido ao arquivo config -->
    <form action="<?php echo base_url("Usuarios/login"); ?>" method="Post" id="submit" class="form-signin" autocomplete="off">
        <div class="text-center mb-4">
            <img src="<?php echo base_url("assets/images/logo-claro2.png"); ?>" class="img-fluid">
        </div>
        <?php
        if ($this->session->mensagemLogin) { ?>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissable fade-in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php
                        echo $this->session->mensagemLogin;
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- campo para inclusão do email -->
        <div class="form-label-group">
            <input type="text" name="login" id="login" class="form-control" placeholder="Login" autofocus required>
        </div>

        <!-- campo para inclusão da senha -->
        <div class="form-label-group">
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
        </div>

        <!-- botão para entrar no sistema base_url direciona o usuário para o dashboard -->
        <button class="btn btn-lg btn-danger btn-block" id="btn_login">Entrar</button>
        <p class="text-center mt-3">Não possui acesso? <a href="#" data-toggle="modal" data-target="#novoCadastroModal">Solicite </a></p>


    </form>
    <!-- tela modal para inclusão dos dados de solicitação do acesso-->

    <div class="modal fade text-dark" id="novoCadastroModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Solicitação de acesso ou suporte</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <h5 class="modal-title text-danger">PLANEJAMENTO ADM SP</h5>
                        </div>
                        <div class="row">
                            <h9><b>CLEYTON CARVALHO NEVES</b> - cleyton.neves@claro.com.br </h9><br>
                            <h9><b> FELIPE LIMA FERREIRA</b>   - felipe.ferreira@claro.com.br </h9><br>
                            <h9><b> ADRIANA PEREIRA PRIMO</b>  - adriana.primo2@claro.com.br</h9><br><br>
                            <h9><b>COORDENADOR:</b></h9>
                            <h9><b>PAULO BATISTA DE SOUSA</b> - paulo.batista@claro.com.br</h9>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.0/dist/sweetalert2.all.min.js"></script>
</body>

</html>