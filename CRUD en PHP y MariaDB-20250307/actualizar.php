<?php include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE estudiantes SET nombre = ?, edad = ?, licenciatura = ? WHERE id = ?");
    $stmt->execute([$_POST['nombre'], $_POST['edad'], $_POST['licenciatura'], $_POST['id']]);
    header("Location: index.php");
}
?>
