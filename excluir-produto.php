<?php


  //Importa arquivo src/conexao-db.php
  require "src/conexao-bd.php";
  require "src/model/Produto.php";
  require "src/repository/ProdutoRepository.php";

$produtoRepositorio = new ProdutoRepository($pdo);
$produtoRepositorio->deletar($_POST["id"]);

header("Location: admin.php");


?>