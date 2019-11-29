<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
require_once 'CLASSES/conectar.php';
$u = new conectar();

$id_produto = $_GET['id_produto'];

try { 
  $stmt = $pdo->prepare('DELETE FROM produtos WHERE id_produto = :id_produto');
  $stmt->bindParam(':id_produto', $id_produto); 
  $stmt->execute();
     
  echo $stmt->rowCount(); 
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

header("location: arearestrita.php#pcadastrados");

?>