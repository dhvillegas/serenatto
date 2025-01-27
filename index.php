<?php
    session_start();
 
    // import dependencies
    require 'vendor/autoload.php';

    // get the Mixpanel class instance, replace with your project token
    $mp = Mixpanel::getInstance("6b31e334c5f590b2cbd9775dd7c598fd", array(
        "debug"          => true,    // enable debug mode
        "use_ssl"        => false   //Tell the consumer whether or not to use ssl
        ));

    // track an event
    $mp->track("PageViewed", array("name" => "Homepage", "distinct_id" => $_SESSION['user_id'])); 

    // create/update a profile for user id 12345
    /*
    $mp->people->set(12345, array(
        '$first_name'       => "John",
        '$last_name'        => "Doe",
        '$email'            => "john.doe@example.com",
        '$phone'            => "5555555555",
        "Favorite Color"    => "red"
    ));
    */



    //Importa arquivo src/conexao-db.php
    require "src/conexao-bd.php";
    require "src/model/Produto.php";
    require "src/repository/ProdutoRepository.php";
    //cria objeto query Produtos Café
    
    $produtoRepository = new ProdutoRepository($pdo);
    $dadosCafe = $produtoRepository->opcoesCafe();
    $dadosAlmoco = $produtoRepository->opcoesAlmoco();


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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>
<body>
    <main>
        <div>
            <?= isset($_SESSION['user_name']) == false ? "<a href=login.php>Efetuar Login</a>" : $_SESSION['user_name']?>
         </div>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php foreach ($dadosCafe as $cafe):?> 
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $cafe->getImagemPath() ?>">
                    </div>
                    <p><?= $cafe->getNome() ?></p>
                    <p><?= $cafe->getDescricao() ?></p>
                    <p><?= $cafe->getPrecoFormatado() ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php foreach ($dadosAlmoco as $almoco):?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $almoco->getImagemPath() ?>">
                    </div>
                    <p><?= $almoco->getNome() ?></p>
                    <p><?= $almoco->getDescricao() ?></p>
                    <p><?= $almoco->getPrecoFormatado()  ?></p>
                </div>
                <?php endforeach; ?>
            </div>

        </section>
    </main>
</body>
</html>