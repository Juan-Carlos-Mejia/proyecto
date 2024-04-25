<?php
session_start(); // Inicia la sesión si no está iniciada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Verificar si se enviaron los campos del formulario para inserción o actualización
    if (isset($_POST['nombre_empresa']) && isset($_POST['direccion']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_final']) && isset($_POST['descripcion'])) {
        // Obtener los datos del formulario
        $nombre_empresa = $_POST['nombre_empresa'];
        $direccion = $_POST['direccion'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_final = $_POST['fecha_final'];
        $descripcion = $_POST['descripcion'];

        // Verificar si se está enviando el ID para editar
        if (isset($_POST['editar_id'])) {
            $editar_id = $_POST['editar_id'];

            // Preparar la consulta SQL para actualizar el registro
            $sql_actualizar = "UPDATE campanas SET nombre_empresa=?, direccion=?, fecha_inicio=?, fecha_final=?, descripcion=? WHERE id=?";
            $stmt_actualizar = $conn->prepare($sql_actualizar);
            $stmt_actualizar->bind_param("sssssi", $nombre_empresa, $direccion, $fecha_inicio, $fecha_final, $descripcion, $editar_id);
        } else {
            // Preparar la consulta SQL para insertar un nuevo registro
            $sql_insertar = "INSERT INTO campanas (nombre_empresa, direccion, fecha_inicio, fecha_final, descripcion) VALUES (?, ?, ?, ?, ?)";
            $stmt_insertar = $conn->prepare($sql_insertar);
            $stmt_insertar->bind_param("sssss", $nombre_empresa, $direccion, $fecha_inicio, $fecha_final, $descripcion);
        }
        // Procesar la imagen
if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $ruta_destino = 'carpeta_donde_guardar_imagenes/' . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
    
    // Guardar la ruta de la imagen en la base de datos
    $sql = "INSERT INTO campanas (nombre_empresa, direccion, fecha_inicio, fecha_final, descripcion, imagen)
            VALUES ('$nombre_empresa', '$direccion', '$fecha_inicio', '$fecha_final', '$descripcion', '$ruta_destino')";
} else {
    // Si no se subió ninguna imagen, omitir la columna imagen en la consulta SQL
    $sql = "INSERT INTO campanas (nombre_empresa, direccion, fecha_inicio, fecha_final, descripcion)
            VALUES ('$nombre_empresa', '$direccion', '$fecha_inicio', '$fecha_final', '$descripcion')";
}


        // Ejecutar la consulta
        if (isset($stmt_actualizar) && $stmt_actualizar->execute()) {
            $_SESSION['success_message'] = "Registro actualizado exitosamente.";
        } elseif (isset($stmt_insertar) && $stmt_insertar->execute()) {
            $_SESSION['success_message'] = "Registro insertado exitosamente.";
        } else {
            $_SESSION['error_message'] = "Error al procesar la solicitud: " . $conn->error;
        }
    } else {
        $_SESSION['error_message'] = "Faltan campos en el formulario.";
    }

    // Cerrar conexión
    $conn->close();
} else {
    $_SESSION['error_message'] = "Solicitud no válida.";
}

// Redirigir a la página de destino
header("Location: campaña.php");
exit();
?>
