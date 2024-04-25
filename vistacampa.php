<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Campañas</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 100px;
            padding: 50px;
        }
        .campania-table {
            width: 100%;
            border-collapse: collapse;
        }
        .campania-table th, .campania-table td {
            border: 1px solid #ccc;

            padding: 8px;
            text-align: left;
        }
        .campania-table th {
            background-color: #6eaadb;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Listado de Campañas</h2>
    <table class="campania-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Final</th>
                <th>Empresa</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
// Conexión a la base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "proyecto_db";

// Crear conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Query para obtener las campañas
$sql = "SELECT nombre_empresa, fecha_inicio, fecha_final, nombre_empresa, descripcion FROM campanas";
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Si hay resultados, mostrarlos en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre_empresa"] . "</td>";
        echo "<td>" . $row["fecha_inicio"] . "</td>";
        echo "<td>" . $row["fecha_final"] . "</td>";
        echo "<td>" . $row["nombre_empresa"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "</tr>";
    }
} else {
    // Si no hay resultados, mostrar un mensaje
    echo "<tr><td colspan='5'>No se encontraron campañas.</td></tr>";
}

// Cerrar conexión
$conn->close();
?>

        </tbody>
    </table>
    <button onclick="window.location.href='index.html'">Regresar al Inicio</button>
</body>
</html>
