<?php

    // import dependencies
    require 'vendor/autoload.php';

    // get the Mixpanel class instance, replace with your project token
    $mp = Mixpanel::getInstance("6b31e334c5f590b2cbd9775dd7c598fd", array(
        "debug"          => true,    // enable debug mode
        "use_ssl"        => false   //Tell the consumer whether or not to use ssl
        ));

    // track an event
    $mp->track("PageViewed", array("name" => "Cadastrar Usuario Page")); 

    //Importa arquivo src/conexao-db.php
    require "src/conexao-bd.php";
    require "src/model/Usuario.php";
    require "src/repository/UsuarioRepository.php";

    require "src/model/Empresa.php";
    require "src/repository/EmpresaRepository.php";

    $empresaRepository = new EmpresaRepository($pdo);
    $dadosEmpresa = $empresaRepository->buscarTodos();

    if (isset($_POST['cadastro'])){

        $usuario = new usuario(
            null,
            $_POST['username'],
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['nome'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['admin'],
            $_POST['empresa']

        );

        $usuarioRepository = new UsuarioRepository($pdo);
        //var_dump($usuario);
        //exit();

        $usuarioRepository->salvar($usuario);
        
        header("Location: admin.php");

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
    <title>Serenatto - Cadastrar Usuário</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Usuário</h1>
        <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form method="post">

            <label for="nome">Nome Usuário</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do usuário" required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Digite o username de login" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Digite o password de login" required>
            
            <label for="email">E-mail Usuário</label>
            <input type="text" id="email" name="email" placeholder="Digite o e-mail do usuário" required>

            <label for="phone">Phone Usuário</label>
            <input type="text" id="phone" name="phone" placeholder="Digite o telefone do usuário">
            
            <label for="admin">Admin</label>
            <input type="checkbox" id="admin" name="admin">
            
            <label for="empresa">Empresa</label>
            <select id="empresa" name="empresa" required>
                <option value="">Selecione a empresa</option>
                <?php foreach ($dadosEmpresa as $empresa):?> 
                    <option value="<?= $empresa->getId() ?>"><?= $empresa->getNome() ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar Usuário"/>
            <a class="botao-cadastrar" href="cadastrar-empresa.php">Cadastrar Empresa</a>
        </form>
    </section>
    
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>