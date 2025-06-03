<?php include 'config.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM estudiantes WHERE id = ?");
$stmt->execute([$id]);
$estudiante = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Estudiante</h1>
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
            <input type="text" name="nombre" value="<?php echo $estudiante['nombre']; ?>" required>
            <input type="number" name="edad" value="<?php echo $estudiante['edad']; ?>" required>
            <input type="text" name="licenciatura" value="<?php echo $estudiante['licenciatura']; ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
