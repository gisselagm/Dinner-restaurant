<?php
// index.php
include 'db_config.php';
$message = "";

// Procesamos el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservar'])) {
    // Recoger y sanitizar los datos
    $fecha = $_POST['fecha'] ?? '';
    $comensales = $_POST['comensales'] ?? '';

    // Validación básica: se requiere la fecha y que el número de comensales sea numérico y mayor a 0
    if (empty($fecha) || empty($comensales) || !is_numeric($comensales) || (int)$comensales < 1) {
        $message = "Por favor, complete todos los campos correctamente.";
    } else {
        // Preparar la consulta para evitar inyección SQL
        $stmt = $conn->prepare("INSERT INTO reservas (fecha, comensales) VALUES (?, ?)");
        $stmt->bind_param("si", $fecha, $comensales);
        
        if ($stmt->execute()) {
            $message = "Reserva realizada exitosamente.";
        } else {
            $message = "Error al realizar la reserva. Inténtelo de nuevo.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Cenas - Restaurante</title>
    <style>
        /* Estilos CSS sencillos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type="date"],
        input[type="number"] {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"],
        .btn {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }
        input[type="submit"]:hover,
        .btn:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 15px;
            padding: 10px;
            background: #e7f3fe;
            border: 1px solid #b3d7ff;
            border-radius: 4px;
        }
        .view-reservations {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Reserva de Cenas</h1>
    
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <label for="fecha">Fecha de la Cena:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="comensales">Número de Comensales:</label>
        <input type="number" id="comensales" name="comensales" min="1" required>

        <input type="submit" name="reservar" value="Realizar Reserva">
    </form>
    
    <div class="view-reservations">
        <!-- Botón para ver las reservas -->
        <form action="reservas.php" method="get">
            <input type="submit" value="Ver Reservas" class="btn">
        </form>
    </div>
</div>
</body>
</html>
