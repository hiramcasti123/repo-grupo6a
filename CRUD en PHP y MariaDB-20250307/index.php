<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con PHP y MariaDB</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>CRUD con PHP y MariaDB</h1>
        <form action="crear.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="number" name="edad" placeholder="Edad" required>
            <input type="text" name="licenciatura" placeholder="Licenciatura" required>
            <button type="submit">Crear</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Licenciatura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM estudiantes");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['edad']}</td>
                            <td>{$row['licenciatura']}</td>
                            <td>
                                <a href='editar.php?id={$row['id']}'>Editar</a>
                                <a href='eliminar.php?id={$row['id']}'>Eliminar</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
