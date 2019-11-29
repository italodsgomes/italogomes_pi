<?php

class conectar
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

}

?>