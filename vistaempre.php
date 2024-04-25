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

// Consulta SQL para obtener todas las empresas
$sql = "SELECT nombre_empresa, sitio_web, direccion, telefono, info_contacto FROM empresas";
$result = $conn->query($sql);

// Verificar si se encontraron empresas
if ($result->num_rows > 0) {
    // Crear la tabla HTML
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Empresas</title>
        <link rel="stylesheet" href="estilos.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 100px;
                padding: 50px;
            }
            .empresa-table {
                width: 100%;
                border-collapse: collapse;
            }
            .empresa-table th, .empresa-table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            .empresa-table th {
                background-color: #6eaadb;
            }
            .login-container button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <h2>Listado de Empresas</h2>
        <button type="button" class="cancelar" onclick="window.location.href=\'index.html\'">Salir</button>
        <table class="empresa-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Sitio Web</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Información de Contacto</th>
                </tr>
            </thead>
            <tbody>';

    // Mostrar cada empresa como una fila en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["nombre_empresa"]."</td>
                <td>".$row["sitio_web"]."</td>
                <td>".$row["direccion"]."</td>
                <td>".$row["telefono"]."</td>
                <td>".$row["info_contacto"]."</td>
            </tr>";
    }

    echo '</tbody>
        </table>
    </body>
    </html>';
} else {
    echo "No se encontraron empresas.";
}

// Cerrar conexión
$conn->close();
?>
