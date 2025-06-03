<?php include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO estudiantes (nombre, edad, licenciatura) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nombre'], $_POST['edad'], $_POST['licenciatura']]);
    header("Location: index.php");
}
?>
