<?php 
include_once('../../connection/conn.php');



$id = $_POST['id'] ?? null;
if(!$id) {
    header('location: index.php');
    exit;
}

$statment = $pdo->prepare('DELETE FROM users WHERE user_id = :id');
$statment->bindvalue(':id', $id);
$statment->execute();

header('location: index.php');

?>