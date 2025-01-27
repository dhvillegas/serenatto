<?php
session_start(); // Iniciar a sessão
$message = "";

//Importa arquivo src/conexao-db.php
require "src/conexao-bd.php";
require "src/model/Usuario.php";
require "src/repository/UsuarioRepository.php";


if (isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];


  $usuarioRepository = new UsuarioRepository($pdo);
  $returnLogin = $usuarioRepository->checalogin($email, $password);

  var_dump(isset($returnLogin));
  var_dump($returnLogin);

    if ($returnLogin == true) {
      //$dados = $usuarioRepository->buscar($returnLogin->user_id());

      //var_dump($dados);

      $_SESSION['user_id'] = $returnLogin->getId();
      $_SESSION['user_email'] = $returnLogin->getEmail();
      $_SESSION['user_name'] = $returnLogin->getNome();
      $_SESSION['user_admin'] = $returnLogin->getAdmin();
      $_SESSION['client_id'] = $returnLogin->getEmpresa();
      
      header("Location: index.php");

    } else {
      $message = "Usuário e Senha incorretos.";
    }

    
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
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Login</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Login Serenatto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form">
  <form method="post">
    <?= $message ?>
    <label for="email">E-mail Usuário</label>
    <input type="text" id="email" name="email" placeholder="Digite o e-mail do usuário" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Digite o password de login" required>

    <input type="submit" name="login" class="botao-cadastrar" value="Entrar"/>
  </form>

  </section>
</main>
</body>
</html>