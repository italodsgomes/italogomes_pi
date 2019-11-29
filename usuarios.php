<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
require_once 'CLASSES/conectar.php';
$u = new conectar();

//$filtro = $_GET['filtro'];

//if(empty($filtro)){
   $consulta = $pdo->query("SELECT * FROM usuarios;");
//}else{
   // $consulta = $pdo->query("SELECT * FROM usuarios WHERE email like ?;");

//}


$rows = array();
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $linha;
}
echo json_encode($rows);
return;
?>
