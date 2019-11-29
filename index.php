
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
                        <form class="form-inline">
                            <input class="form-control mr-sm-2 px-4" type="search" placeholder="Buscar" aria-label="Search">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Buscar</button>
                         </form>
                </nav>
            </header>

            <div id="carouselbeer" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselbeer" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselbeer" data-slide-to="1"></li>
                        <li data-target="#carouselbeer" data-slide-to="2"></li>
                    </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/imagem_01.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images/imagem_02.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images/imagem_03.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    <a class="carousel-control-prev" href="#carouselbeer" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselbeer" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
            </div>
<!-- EXIBIR PRODUTOS CADASTRADOS -->
    <div class="vitrine-produtos" id="pcadastrados-id">

        <div class='card-group'>
                <?php

                $consulta = $pdo->query("SELECT * FROM produtos;");

                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    if ($linha['produto_ativo'] == 1) {
                        ?>
                <div class='p-3 col-lg-3 col-md-12'>
                    <div class='p-3 card brand'>
                        <a class="text-reset id_produto" href="./produto.php?id_produto=<?= $linha['id_produto'] ?>">
                            <div><img src='data:image/png;base64, <?= $linha['imagem'] ?>' width='100%'></div>
                            <div class='data-marca'> <span> <?= $linha['marca'] ?> </span> </div>
                            <div class='data-nome title'> <span><?= $linha['nome'] ?></span> </div>
                            <div class='data-preco'>R$ <span> <?= $linha['preco'] ?> </span> </div>
                            <div class='data-id_produto' style='display:none;'> <span> <?= $linha['id_produto'] ?> </span> </div>
                        </a>
                    <button class='btn btn-warning btn-comprar'>Comprar</button>

                    </div>
                </div>
                <?php 
            } ?>
                <?php 
            } ?>
        </div>
    </div>


        </body>
</html>
<script>
///$('.id_produto').click(function(){
   /// var nome = $(this).parents().children(".data-nome").children("span").html().trim();
</script>