<?php  
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
require_once 'CLASSES/conectar.php';
$u = new conectar();

class produtos
{
    private $pdo; 
    public $msgErro = "";//sem erros

        
    public function cadastro ($email, $senha)
    {
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
            $u->conectar();
            if ($u->msgErro == "") //sem erros
            {
                if ($u->cadastro_de_produtos($codigo, $marca, $preco, $nome, $pais, $estilo, $descricao, $estoque, $produto_ativo, $imagem64)) {
                    echo "Produto cadastrado com sucesso!";
                } 
                Header("Location: arearestrita.php#pcadastrados");
            }
        }else{
            echo "<script>alert('Preencha todos os campos');</script>";
            echo "<a href='./arearestrita.php#cadastrarp'>Clique aqui para voltar</a>";
        }
    }

    }
}
 
?>
