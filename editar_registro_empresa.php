<?php
// Verificar si se recibió el ID del registro a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto_db";
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta SQL para obtener los datos del registro a editar
    $sql = "SELECT * FROM empresas WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Si se encontró el registro, mostrar el formulario de edición
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro de Campaña</title>
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

        .guardar, .cancelar {
            padding: 6px 10px;
            margin-right: 5px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }

        .cancelar {
            background-color: red;
        }
        </style>
</head>
<body>
    <div class="registro-container">
        <h2>Editar Registro de Empresa</h2>
        <form id="formulario-edicion" action="procesar_edicion_empresas.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="nombre_empresa" placeholder="Nombre de la Empresa" value="<?php echo $row['nombre_empresa']; ?>" required>
            <input type="text" name="sitio_Web" placeholder="sitio_web" value="<?php echo $row['sitio_web']; ?>" required>
            <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required>
            <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required>
            <textarea name="info_contacto" rows="4" placeholder="info_contacto"><?php echo $row['info_contacto']; ?></textarea>
            <br><br>
            <input class='guardar' type="submit" value="Guardar Cambios" >
            <button class='cancelar' type="button" onclick="window.location.href='Empresa.php'">Cancelar</button>
        </form>
    </div>
</body>
</html>

<?php
    } else {
        // Si no se encontró el registro, mostrar un mensaje de error
        echo "Registro no encontrado";
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el ID del registro, mostrar un mensaje de error
    echo "ID de registro no proporcionado";
}
?>
