<?php include 'config.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM estudiantes WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
?>
