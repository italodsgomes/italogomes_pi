<?php
session_start();
if (!isset($_SESSION['id_usuario'])){
    header("location: index.php");
    exit;
}
require_once 'CLASSES/conectar.php';
$u = new conectar();

    if (isset($_POST['codigo'])) {
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
   

        if (!empty($codigo) && !empty($marca) && !empty($preco) && !empty($nome) && !empty($pais) && !empty($estilo) && !empty($descricao) && !empty($estoque) && !empty($produto_ativo) && !empty($imagem)) {
            //nome da imagem
            $file_tmp =$_FILES['imagem']['tmp_name'];
            //cria a imagem
            $data = file_get_contents( $file_tmp );
            $imagem64 = base64_encode($data);
            
            //sem erros
            if ($u->msgErro == "") { 
                $insert = "INSERT INTO produtos (codigo, marca, preco, nome, pais, estilo, descricao, estoque, produto_ativo, imagem) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($insert);
                $stmt->bindValue(1,$codigo);
                $stmt->bindValue(2,$marca);
                $stmt->bindValue(3,$preco);
                $stmt->bindValue(4,$nome);
                $stmt->bindValue(5,$pais);
                $stmt->bindValue(6,$estilo);
                $stmt->bindValue(7,$descricao);
                $stmt->bindValue(8,$estoque);
                $stmt->bindValue(9,$produto_ativo);
                $stmt->bindValue(10,$imagem64);
                
                echo "Produto cadastrado com sucesso!"; 
                Header("Location: arearestrita.php#pcadastrados");

                if(!$stmt->execute()){
                    echo $stmt->error;
                    die;
                }
                    return true;  
            }
            
            }
            
    }
       
        ?>