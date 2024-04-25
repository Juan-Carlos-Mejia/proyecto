<?php
session_start(); // Inicia la sesión si no está iniciada
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
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
            margin-top: -150px;
            width: 400px;
        }
        .registro-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .registro-container input[type="text"],
        .registro-container input[type="url"],
        .registro-container input[type="tel"],
        .registro-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #000;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .registro-container button {
            width: 48%;
            padding: 10px;
            background-color: #88dc55;
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
    </style>
</head>
<body>


    <div class="registro-container">
        <h2>Registro de Empresa</h2>
        <form action="procesar_registro_empresa.php" method="post">
            <input type="text" name="nombre_empresa" placeholder="Nombre de la Empresa" required>
            <input type="url" name="sitio_web" placeholder="Sitio Web">
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="tel" name="telefono" placeholder="Teléfono" required>
            <textarea name="info_contacto" rows="4" placeholder="Información de Contacto"></textarea>
            <div>
                <button type="submit">Registrar</button>
                <button type="button" class="cancelar" onclick="window.location.href='admin.php'">Cancelar</button>
            </div>
        </form>
    </div>

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Campaña</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .tabla-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 0 auto 50px auto; /* Mueve la tabla hacia abajo 50px y la centra horizontalmente */
            overflow-x: auto;
            margin-top: -345px; /* Ajusta la posición de la tabla hacia arriba */
        }

        .tabla-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
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

        .btn-container {
            display: flex;
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
    <div class="tabla-container">
        <h2>Registros</h2>
        <table>
            <tr>
                <th>Nombre de la Empresa</th>
                <th>SitioWeb</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Contacto</th>
                <th>Acciones</th>
            </tr>
            <!-- Aquí se generarán las filas de la tabla con datos dinámicos -->
            <!-- Puedes usar PHP para obtener los datos de la base de datos y mostrarlos aquí -->
            <!-- Por simplicidad, voy a agregar un ejemplo de fila estática -->
            <tr>
                <td>Nombre Empresa</td>
                <td>Sitio web</td>
                <td>www.ejemplo.com</td>
                <td>37489332</td>
                <td>info de contacto</td>
                <td>
                    <!-- Botones de editar y eliminar -->
                    <div class="btn-container">
                        <form action="editar_registro.php" method="post">
                            <!-- Aquí puedes incluir campos ocultos con los datos del registro -->
                            <input type="hidden" name="empresa_id" value="1">
                            <button type="submit" class="editar-btn">Editar</button>
                        </form>
                        <form action="eliminar_registro.php" method="post">
                            <!-- Aquí puedes incluir campos ocultos con los datos del registro -->
                            <input type="hidden" name="empresa_id" value="1">
                            <button type="submit" class="eliminar-btn">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
    <script>
        // Esta función carga los mensajes de sesión PHP
        function cargarMensajes() {
            <?php
            if (isset($_SESSION['success_message'])) {
                echo "alert('" . $_SESSION['success_message'] . "');";
                unset($_SESSION['success_message']); // Elimina el mensaje de la sesión
            } elseif (isset($_SESSION['error_message'])) {
                echo "alert('" . $_SESSION['error_message'] . "');";
                unset($_SESSION['error_message']); // Elimina el mensaje de la sesión
            }
            ?>
        }

        // Llama a la función al cargar la página
        window.onload = cargarMensajes;
    </script>
</body>
</html>