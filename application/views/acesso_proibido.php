<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Title -->
    <title>Acesso proibido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">
    <style>
        #footer {
            text-align: center;
            position: fixed;
            margin-left: 530px;
            bottom: 0px
        }
    </style>
</head>

<body class="bg-dark text-white py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-2 text-center">
                <p><i class="fa fa-exclamation-triangle fa-5x"></i><br />Status Code: 403</p>
            </div>
            <div class="col-md-10">
                <h3>OPPSSS!!!! Desculpe...</h3>
                <p>Desculpe, você não tem acesso a essa página</p>
                <a class="btn btn-danger" href="javascript:history.back()">Voltar para página anterior</a>
            </div>
        </div>
    </div>
</body>

</html>