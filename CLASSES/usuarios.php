<?php

class Usuario
{
    private $pdo; 
    public $msgErro = "";//sem erros

    public function conectar()
    {
        $nome = "ecommerce_pi";
        $host = "127.0.0.1:3307";
        $usuario = "root";
        $senha = "";

        global $pdo;
        try {
            $pdo = new PDO ("mysql:host=".$host.";dbname=".$nome,$usuario,$senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e){
            $this->msgErro = $e->getMessage();
        }
        
    }

    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;
        //verificar se já existe e-mal cadastrado
        $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e ");
        $stmt->bindValue(":e",$email);
        if(!$stmt->execute()){
            echo $stmt->error;
            die;
        }
        if($stmt->rowCount() > 0){
            return false; // Já está cadastrado
        }
        //Caso não, cadastrar
        else{
            $insert = "INSERT INTO usuarios (nome,email,senha) VALUES(:n, :e, :s)";
            $stmt = $pdo->prepare($insert);
            $stmt->bindValue(":n",$nome);
            $stmt->bindValue(":e",$email);
            $stmt->bindValue(":s", md5($senha));
            if(!$stmt->execute()){
                echo $stmt->error;
                die;
            }
            return true;
        } 
        
    }
    
    public function logar($email, $senha)
    {
        global $pdo;
        //verificar se email e senha estão cadastrados,se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email =:e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if( $sql->rowCount() > 0){
            //entrar no sistema/sessao
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //login efetuado com sucesso
        }
        else{
            return false;//nao foi possivel logar
        }

    }
}
    ?>