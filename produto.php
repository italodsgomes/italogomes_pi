<?php
require_once 'CLASSES/conectar.php';
$u = new conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS/style-home.css">
        <title>We love beer</title>
    </head>

        <body>
                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <a class="navbar-brand" href="index.php">
                            <img src="images/alcohol.png" width="30" height="30" alt="logo">
                        </a>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link" href="#">Sobre</a>
                                    <a class="nav-item nav-link" href="#">Marcas</a>
                                    <a class="nav-item nav-link" href="#">Acessórios</a>
                                    <a class="nav-item nav-link" href="#">Kits</a>
                                    <a class="nav-item nav-link" href="#">Promoções</a>
                                </div>
                            </div>
                    </nav>
                </header>

            <?php

            $id_produto = $_GET['id_produto'];

            //bindValue

            $consulta = $pdo->query("SELECT * FROM produtos WHERE id_produto = ".$id_produto);
            $linha = $consulta->fetch(PDO::FETCH_ASSOC);
            ?>
                    <div class='p-3 col-lg-4 col-md-12'>
                    <div class='p-3 card'>
                    <div><img src='data:image/png;base64, <?= $linha['imagem'] ?>' width='100%'></div>
                    <div class='data-nome'> <b> Nome: </b> <span><?= $linha['nome'] ?></span> </div>
                    <div class='data-marca'> <b> Marca: </b> <span> <?= $linha['marca'] ?> </span> </div>
                    <div class='data-preco'> <b> Preço: </b>R$ <span> <?= $linha['preco'] ?> </span> </div>
                    <div class='data-pais'> <b> País: </b> <span> <?= $linha['pais'] ?> </span> </div>
                    <div class='data-estilo'> <b> Estilo: </b> <span> <?= $linha['estilo'] ?> </span> </div>
                    <div class='data-descricao'> <b> Descrição: </b> <span> <?= $linha['descricao'] ?> </span> </div>
                    <div class='data-id_produto' style='display:none;'> <span> <?= $linha['id_produto'] ?> </span> </div>

        </body >
 </html>