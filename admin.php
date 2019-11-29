<?php
require_once 'CLASSES/usuarios.php';
$u = new Usuario;
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
    <title>Login</title>
</head>

<body class="bg-light">

    <form method="POST">
        <div class="form-group corpo-form">
            <h1 class="text-center">ENTRAR</h1>
            <input type="email" name="email" class="rounded-pill" placeholder="E-mail" value="italo.dsgomes@gmail.com">
            <input type="password" name="senha" class="rounded-pill" placeholder="Senha" value="123456">
            <input type="submit" class="btn btn-dark rounded-pill" value="Fazer Login">
            <a href="cadastrarusuario.php" id="alinhameno-link">Cadastre-se agora</a>
        </div>
        <?php
if (isset($_POST['email'])) {
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);
    //verificando se todos os campos nao estao vazios
    if (!empty($email) && !empty($senha)) {
    $u->conectar(/*"ecommerce_pi", "localhost:3306", "root", ""*/);
        if ($u->msgErro == "") // caso a mensagem esteja vazia, login ok
        {
            if ($u->logar($email, $senha)) {
                header("location: arearestrita.php"); //encaminhado para proxima area apos verificar usuario e senha
            } else {
                echo "Email e/ou senha incorretos!";
            }
        } else {
            echo "Erro: " . $u->msgErro;
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

?>


    </form>

</body>

</html>