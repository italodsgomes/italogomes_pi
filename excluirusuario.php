<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
require_once 'CLASSES/conectar.php';
$u = new conectar();

$id_usuario = $_GET['id_usuario'];

try { 
  $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id_usuario = :id_usuario');
  $stmt->bindParam(':id_usuario', $id_usuario); 
  $stmt->execute();
     
  echo $stmt->rowCount(); 
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

header("location: arearestrita.php#usuarios");

?>