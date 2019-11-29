<?php
require_once 'CLASSES/usuarios.php';
$u = new Usuario();

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
    <title>Cadastro</title>
</head>

<body class="bg-light">

    <form method="POST">
        <div class="form-group">
            <h1 class="text-center">CADASTRO</h1>
            <p class="text-center">Complete seu cadastro para ter acesso a área restrita.</p>
            <input type="text" name="nome" class="rounded-pill" placeholder="Nome">
            <input type="email" name="email" class="rounded-pill" placeholder="E-mail">
            <input type="password" name="senha" class="rounded-pill" placeholder="Senha" maxlength="15">
            <input type="password" name="confirmsenha" class="rounded-pill" placeholder="Confirmar Senha" maxlength="15">
            <input type="submit" class="btn btn-dark rounded-pill" value="Cadastrar ">
            <a href="admin.php" id="alinhameno-link">← Voltar</a>
        </div>

        <?php
//verificar se clicou no botao
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmsenha = $_POST['confirmsenha'];
    //verificar se as informacoes estao completas
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmsenha)) {

    $u->conectar();

        if ($u->msgErro == "") //sem erros
        {
            if ($senha == $confirmsenha) {
                if ($u->cadastrar($nome, $email, $senha)) {
                    echo "Cadastrado com sucesso! Faça seu login para entrar.";
                } else {
                    echo "E-mail já cadastrado!";
                }
            } else {
                echo "As senhas não coincidem";
            }

        } else {
            echo "Erro: " . $u->msgErro;
        }
    } else {
        echo "Preencher todos os campos!";
    }
}
?>

    </form>

    </body>

</html>