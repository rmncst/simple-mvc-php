<?php $masterView = null; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Simple MVC - Login</title>
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">Painel de Cadastro</div>
        <div class="card-body">
            <form action="/Authentication/Register" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input name="nome" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                        <label for="inputEmail">Nome</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                        <label for="inputEmail">Email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                        <label for="inputPassword">Senha</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="confirmPassword" class="form-control" placeholder="Password" required="required">
                        <label for="inputPassword">Confirmar Senha</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                <?= isset($_GET['msg']) ? '<p class="text-danger text-center p-1">'.base64_decode($_GET['msg']).'</p>' : null ?>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="login.php">Cancelar</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
