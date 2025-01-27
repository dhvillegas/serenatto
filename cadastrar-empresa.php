<?php

    // import dependencies
    require 'vendor/autoload.php';

    // get the Mixpanel class instance, replace with your project token
    $mp = Mixpanel::getInstance("6b31e334c5f590b2cbd9775dd7c598fd", array(
        "debug"          => true,    // enable debug mode
        "use_ssl"        => false   //Tell the consumer whether or not to use ssl
        ));

    // track an event
    $mp->track("PageViewed", array("name" => "Cadastrar Empresa Page")); 

    //Importa arquivo src/conexao-db.php
    require "src/conexao-bd.php";
    require "src/model/Empresa.php";
    require "src/repository/EmpresaRepository.php";

    if (isset($_POST['cadastro'])){

        $empresa = new empresa(
            null,
            $_POST['nome'],
            $_POST['razaosocial'],
            $_POST['cnpj']

        );


        $empresaRepository = new EmpresaRepository($pdo);
        $empresaRepository->salvar($empresa);
        
        header("Location: cadastrar-usuario.php");

    }
?> 

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cadastrar Empresa</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Empresa</h1>
        <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form method="post">

            <label for="nome">Nome Empresa</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome da empresa" required>
            
            <label for="razaosocial">Razâo Social</label>
            <input type="text" id="razaosocial" name="razaosocial" placeholder="Digite a razão social da empresa" required>

            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" placeholder="Digite o CNPJ da empresa" required>

            
            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar Empresa"/>
        </form>
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>