<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Campaña</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            margin-right: 50px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .registro-container {
            background-color: #6eaadb;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-right: 40px; /* Espacio entre el formulario y la tabla */
        }
        .registro-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .registro-container input[type="text"],
        .registro-container input[type="date"],
        .registro-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #665e5e;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .registro-container button {
            width: 48%;
            padding: 10px;
            background-color: #88dc58;
            border: 1px solid #000;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
        .registro-container button.cancelar {
            background-color: #dc3545;
        }
        .registro-container button:hover {
            border: 1px solid #ccc;
        }

        .tabla-container {
            background-color: #fff;
            padding: 20px;
            margin-top: 300px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 80%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #6eaadb;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td:last-child {
            text-align: center;
        }

        .editar-btn, .eliminar-btn {
            padding: 6px 10px;
            margin-right: 5px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }

        .eliminar-btn {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <h2>Registro de Campaña</h2>
        <form id="formulario-registro" action="procesar_registro.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre_empresa" placeholder="Nombre de la Empresa" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <p>Inicio</p>
            <input type="date" name="fecha_inicio" placeholder="Fecha de Inicio" required>
            <p>finaliza</p>
            <input type="date" name="fecha_final" placeholder="Fecha Final" required>
            <textarea name="descripcion" rows="4" placeholder="Descripción"></textarea>
            <br><br>
            <input type="file" name="fotografias[]" multiple accept="image/*">
            <br><br>
            <div>
                <button type="submit">Agregar</button>
                <button type="button" class="cancelar" onclick="window.location.href='admin.php'">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="tabla-container">
        <h2>Listado de Campañas</h2>
        <table class="campania-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha Final</th>
                    <th>Empresa</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
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
            $sql = "SELECT id, nombre_empresa, fecha_inicio, fecha_final, descripcion, imagen FROM campanas";
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
                    echo "<td>";
                    echo "<button class='editar-btn' onclick='editarRegistro(" . $row['id'] . ")'>Editar</button>";
                    echo "<button class='eliminar-btn' onclick='eliminarRegistro(" . $row['id'] . ")'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // Si no hay resultados, mostrar un mensaje
                echo "<tr><td colspan='7'>No se encontraron campañas.</td></tr>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </tbody>
        </table>
    </div>
    <script>
    // Función para eliminar un registro
    function eliminarRegistro(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            // Realizar solicitud AJAX al servidor
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "eliminar_registro.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Recargar la página después de eliminar el registro
                    window.location.reload();
                }
            };
            xhr.send("id=" + id);
        }
    }
</script>
<script>
    // Función para abrir el formulario de edición
    function editarRegistro(id) {
        // Redirigir a una página de edición pasando el ID del registro como parámetro de la URL
        window.location.href = "editar_registro.php?id=" + id;
    }
</script>



</body>
</html>
