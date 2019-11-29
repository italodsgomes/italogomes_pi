<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
require_once 'CLASSES/conectar.php';
$u = new conectar();

if (isset($_POST['id_produto'])) {
    $id_produto = $_POST['id_produto'];
    $codigo = $_POST['codigo'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];
    $nome = $_POST['nome'];
    $pais = $_POST['pais'];
    $estilo = $_POST['estilo'];
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];
    $produto_ativo = $_POST['produto_ativo'];
    $imagem = $_FILES['imagem'];

    $file_tmp = $_FILES['imagem']['tmp_name'];
    if ($file_tmp) {
        $data = file_get_contents($file_tmp);
        $imagem64 = base64_encode($data);
    } else {
        $imagem64 = '';
    }


    if ($u->msgErro == "") {
        $update = "UPDATE produtos SET
                    codigo = :codigo,
                    marca = :marca,
                    preco = :preco,
                    nome = :nome,
                    pais = :pais,
                    estilo = :estilo,
                    descricao = :descricao,
                    estoque = :estoque,
                    produto_ativo = :produto_ativo";
        if ($imagem['size'] > 0) $update .= ",imagem = :imagem";

        $update .= " WHERE
                    id_produto = :id_produto";

        $stmt = $pdo->prepare($update);
        $stmt->bindValue(':codigo', $codigo);
        $stmt->bindValue(':marca', $marca);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':pais', $pais);
        $stmt->bindValue(':estilo', $estilo);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':estoque', $estoque);
        $stmt->bindValue(':produto_ativo', $produto_ativo);
        if ($imagem['size'] > 0) $stmt->bindValue(':imagem', $imagem64);
        $stmt->bindValue(':id_produto', $id_produto);

        if (!$stmt->execute()) {
            echo $stmt->error;
            die;
        }

        header("location: arearestrita.php#pcadastrados");
    }
}

?>
  
