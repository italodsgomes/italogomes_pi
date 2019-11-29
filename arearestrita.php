<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
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
    <link rel="stylesheet" href="CSS/style.css">
    <link href="CSS/dashboard.css" rel="stylesheet">
    <title>Área Restrita</title>
    
</head>

<body>
    <div>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <h2 class="text-white"> Painel de Controle</h2>
            <ul class="navbar-nav px-3">
                <li>
                    <a class="nav-link" href="admin.php">Sair</a>
                </li>
            </ul>
        </nav>
    </div>

    <nav class=" col-md-2 d-none d-md-block bg-light sidebar">
        <ul>
            <li class="active nav-item">
                <a class="nav-link" id="pcadastrados" href="#pcadastrados" aria-selected=" true">
                    <span>Produtos cadastrados</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="cadastrarp" href="#cadastrarp">
                    <span>Cadastrar produto</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="usuarios" href="#usuarios">
                    <span>Usuários</a>
            </li>
        </ul>
    </nav>

<!-- BODY MENUS -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 bg-light">

        <div class="conteudoArearestrita active" id="pcadastrados-id">
 <!-- EXIBIR PRODUTOS CADASTRADOS -->
            <h3>Produtos Cadastrados</h3>
            <div class='card-group'>
                <?php
                $consulta = $pdo->query("SELECT * FROM produtos;");

                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class='p-3 col-lg-4 col-md-12'>
                    <div class='p-3 card'>

                    <div><img src='data:image/png;base64, <?= $linha['imagem'] ?>' width='100%'></div>
                    <div class='data-nome'> <b> Nome: </b> <span><?= $linha['nome'] ?></span> </div>
                    <div class='data-codigo'> <b> Código: </b> <span><?= $linha['codigo'] ?></span> </div>
                    <div class='data-marca'> <b> Marca: </b> <span> <?= $linha['marca'] ?> </span> </div>
                    <div class='data-preco'> <b> Preço: </b>R$ <span> <?= $linha['preco'] ?> </span> </div>
                    <div class='data-pais'> <b> País: </b> <span> <?= $linha['pais'] ?> </span> </div>
                    <div class='data-estilo'> <b> Estilo: </b> <span> <?= $linha['estilo'] ?> </span> </div>
                    <div class='data-descricao'> <b> Descrição: </b> <span> <?= $linha['descricao'] ?> </span> </div>
                    <div class='data-estoque'> <b> Quantidade em estoque: </b> <span> <?= $linha['estoque'] ?> </span> </div>
                    <div class='data-id_produto' style='display:none;'> <span> <?= $linha['id_produto'] ?> </span> </div>

                    <?php
                    $status = $linha['produto_ativo'];
                    if ($status < 2) {
                        echo "<div class='data-produto_ativo'> <b> Status: </b> <span> Ativo </span> </div>";
                    } else {
                        echo "<div class='data-produto_ativo'> <b> Status: </b> <span> Inativo </span> </div>";
                    }

                    ?>

 <!--EDITAR-->
                    <div>
                    <button class='col-5 btn btn-primary btn-editar mr-3' data-toggle='modal' data-target='.bd-modal-xl'>Editar</button>
                    <a class="col-5 btn btn-danger btn-excluir text-white mr-3" href="excluirproduto.php?id_produto=<?= $linha['id_produto'] ?>" role="button">Excluir</a>
                    </div>
                    </div>
                    </div>
                <?php 
            } ?>
            </div>
        </div>

<!-- CADASTRAR PRODUTOS -->
            <form class=""  method="POST" action="cadastrarproduto.php" enctype="multipart/form-data" id="cadastrarp-id" onsubmit="return enviaCadastro();" >
                <h3 class="text-center">Cadastrar de Produtos </h3>
                <div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label for="códigop">CÓDIGO</label>
                            <input type="text" required name="codigo" class="form-control" id="códigop" placeholder="">
                        </div>

                        <div class="col">
                            <label for="marcap">MARCA</label>
                            <input type="text" required name="marca" class="form-control" id="marcap" placeholder="">
                        </div>


                        <div class="col">
                            <label for="preçop">PREÇO</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text col-2">R$</span>
                                <input type="number" required name="preco" class="form-control" step="0.01" id="preçop" placeholder="">
                            </div>
                        </div>

                    </div>

                        <div class="form-group form-row">
                            <div class="col">
                                <label for="nomep">NOME</label>
                                <input type="text" required name="nome" class="form-control" id="nomep" placeholder="">
                            </div>

                            <div class="col">
                                <label for="paísp">PAÍS</label>
                                <input type="text" required name="pais" class="form-control" id="paísp" placeholder="">
                            </div>

                            <div class="col">
                                <label for="estilop">ESTILO</label>
                                <input type="text" required name="estilo" class="form-control" id="estilop" placeholder="">
                            </div>
                        </div>
                    <div>
                        <label for="descriçãop">DESCRIÇÃO</label>
                        <textarea type="text" required name="descricao" class="form-control" id="descriçãop" rows="3"
                            placeholder=""></textarea>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label for="estoquep">ESTOQUE</label>
                            <input type="number" required name="estoque" class="form-control" id="estoquep" placeholder="">
                        </div>
                        <div class="col">
                            <label for="statusp">PRODUTO ATIVO</label>
                            <select class="custom-select" required name="produto_ativo" id="statusp">
                                <option value="1">Sim</option>
                                <option value="2">Não</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="imgp">IMAGEM</label>
                            <input type="file" required name="imagem" class="form-control" id="imgp">
                        </div>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success form-control" value="Cadastrar " id="cadastrar">
                    </div>
                </div>
            </form>
<!-- LISTAR USUARIOS -->
        <div class="conteudoArearestrita" id="pcadastrados-id">
            <div id="usuarios-id">
                <h1>Usuarios</h1>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        </tr>
                    </thead>
                    <tbody  id="listausuarios">
                    
                    </tbody>
                </table>

<script>
           window.onload = function () {
			var conteudo = new XMLHttpRequest();
			conteudo.onreadystatechange = function () {
				if (conteudo.readyState == 4 && conteudo.status == 200) {
					if (conteudo.responseText) {
                        let data = JSON.parse(conteudo.responseText)
                        console.log(data);
                        //document.getElementById("usuarios-lista").innerHTML = conteudo.responseText;
                        data.forEach(ListaUsuarios);
					}
				}
			}
			conteudo.open("POST", "usuarios.php");
			conteudo.send();
		}

        function ListaUsuarios(element, index, array) {
               
                var tbody = document.getElementById('listausuarios');
                var l1 = document.createElement("tr")
                var c1 = document.createElement("td")
                var c2 = document.createElement("td")
                var c3 = document.createElement("td")
                
                tbody.appendChild(l1);
                l1.appendChild(c1);
                l1.appendChild(c2);
                l1.appendChild(c3);

                c1.innerHTML = element.id_usuario;
                c2.innerHTML = element.nome;
                c3.innerHTML = element.email;
            
            console.log(element.id_usuario);
            console.log(element.nome);
            console.log(element.email);
        }

</script>

            </div>
            <canvas class="ajusteCanvas"><canvas>
        </div>
    </main>
<!--MODAL EDITAR-->
    <aside>
        <div id="modal-edit" class='modal fade bd-modal-xl' tabindex='-1' role='dialog' aria-labelledby='myExtraLargeModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <form class='container' method='POST' action='atualizarproduto.php' enctype='multipart/form-data' id='atualizarp-id'>
                        <h3 class='text-center'>Atualizar</h3>
                        <div>
                            <div class='form-group form-row'>
                                <div class='col'>
                                    <label for='codigop'>CÓDIGO</label>
                                    <input type='text' name='codigo' class='form-control' id='codigop' placeholder='' value=''>
                                </div>

                                <div class='col'>
                                    <label for='marcap'>MARCA</label>
                                    <input type='text' name='marca' class='form-control' id='marcap' placeholder='' >
                                </div>
                                <div class='col'>
                                    <label for='preçop'>PREÇO</label>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text col-2'>R$</span>
                                        <input type='number' name='preco' class='form-control' step='0.01' id='precop' placeholder=''>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group form-row'>
                                <div class='col'>
                                    <label for='nomep'>NOME</label>
                                    <input type='text' name='nome' class='form-control' id='nomep' placeholder=''>
                                </div>

                                <div class='col'>
                                    <label for='paísp'>PAÍS</label>
                                    <input type='text' name='pais' class='form-control' id='paisp' placeholder=''>
                                </div>

                                <div class='col'>
                                    <label for='estilop'>ESTILO</label>
                                    <input type='text' name='estilo' class='form-control' id='estilop' placeholder=''>
                                </div>
                            </div>
                            <div>
                                <label for='descricaop'>DESCRIÇÃO</label>
                                <textarea type='text' name='descricao' class='form-control' id='descricaop' rows='3'
                                    placeholder=''></textarea>
                            </div>
                            <div class='form-group form-row'>
                                <div class='col'>
                                    <label for='estoquep'>ESTOQUE</label>
                                    <input type='number' name='estoque' class='form-control' id='estoquep' placeholder=''>
                                </div>
                                <div class='col'>
                                    <label for='statusp'>PRODUTO ATIVO</label>
                                    <select class='custom-select' name='produto_ativo' id='produto_ativop'>
                                        <option value='1'>Sim</option>
                                        <option value='2'>Não</option>
                                    </select>
                                </div>

                                <div class='col'>
                                    <label for='imgp'>IMAGEM</label>
                                    <input type='file' name='imagem' class='form-control' id='imgp'>
                                </div>

                                <input type="hidden" name="id_produto" id="id_produtop">

                            </div>
                        <div>
                        <input type='submit' class='btn btn-primary form-control' value='Atualizar ' id='cadastrar'>
                    </form>
                </div>
            </div>
        </div>
    </aside>
</body>
</html>

<script>

$('.btn-editar').click(function(){
    var nome = $(this).parents().children(".data-nome").children("span").html().trim();
    var codigo = $(this).parents().children(".data-codigo").children("span").html().trim()
    var marca = $(this).parents().children(".data-marca").children("span").html().trim()
    var preco = $(this).parents().children(".data-preco").children("span").html().trim()
    var pais = $(this).parents().children(".data-pais").children("span").html().trim()
    var estilo = $(this).parents().children(".data-estilo").children("span").html().trim()
    var descricao = $(this).parents().children(".data-descricao").children("span").html().trim()
    var estoque = $(this).parents().children(".data-estoque").children("span").html().trim()
    var produto_ativo = $(this).parents().children(".data-produto_ativo").children("span").html().trim()
    var id_produto = $(this).parents().children(".data-id_produto").children("span").html().trim()
    produto_ativo = (produto_ativo == "Inativo") ? 2 : 1;
    
    $('#modal-edit').find("#nomep").val(nome);
    $('#modal-edit').find("#codigop").val(codigo);
    $('#modal-edit').find("#marcap").val(marca);
    $('#modal-edit').find("#precop").val(preco);
    $('#modal-edit').find("#paisp").val(pais);
    $('#modal-edit').find("#estilop").val(estilo);
    $('#modal-edit').find("#descricaop").val(descricao);
    $('#modal-edit').find("#estoquep").val(estoque);
    $('#modal-edit').find("#produto_ativop").val(produto_ativo);
    $('#modal-edit').find("#id_produtop").val(id_produto);

});

$('.btn-excluir').on('click', function(event){
    event.preventDefault();
    var Link=$(this).attr('href');

    if (confirm("Deseja excluir esse produto?")){
        window.location.href=Link;

    }else{
        return false;
    }

});

var usuarios = document.getElementById("usuarios");
usuarios.onclick = function() {

    document.getElementById("usuarios").classList.add("active");
    document.getElementById("cadastrarp").classList.remove("active");
    document.getElementById("pcadastrados").classList.remove("active");

    var menu1 = document.getElementById("usuarios-id");
    menu1.style.display = "block";
    var menu2 = document.getElementById("cadastrarp-id");
    menu2.style.display = "none";
    var menu3 = document.getElementById("pcadastrados-id");
    menu3.style.display = "none";
}

var cadastrarp = document.getElementById("cadastrarp");
cadastrarp.onclick = function() {

    document.getElementById("usuarios").classList.remove("active");
    document.getElementById("cadastrarp").classList.add("active");
    document.getElementById("pcadastrados").classList.remove("active");

    var menu1 = document.getElementById("usuarios-id");
    menu1.style.display = "none";
    var menu2 = document.getElementById("cadastrarp-id");
    menu2.style.display = "block";
    var menu3 = document.getElementById("pcadastrados-id");
    menu3.style.display = "none";
}

var pcadastrados = document.getElementById("pcadastrados");
pcadastrados.onclick = function() {

    document.getElementById("usuarios").classList.remove("active");
    document.getElementById("cadastrarp").classList.remove("active");
    document.getElementById("pcadastrados").classList.add("active");

    var menu1 = document.getElementById("usuarios-id");
    menu1.style.display = "none";
    var menu2 = document.getElementById("cadastrarp-id");
    menu2.style.display = "none";
    var menu3 = document.getElementById("pcadastrados-id");
    menu3.style.display = "block";
}
var hash = window.location.hash.replace("#","");
console.log(hash);
switch(hash){
    case 'pcadastrados':
        pcadastrados.onclick();
        break;
    case 'cadastrarp':
        cadastrarp.onclick()
        break;
    case 'usuarios':
        usuarios.onclick();
        break;
    default:
        cadastrarp.onclick();
        break;
}

</script>