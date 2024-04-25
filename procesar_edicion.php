<?php
// Verificar si se recibió el ID del registro a editar
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombre_empresa = $_POST['nombre_empresa'];
    $direccion = $_POST['direccion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];
    $descripcion = $_POST['descripcion'];
    
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
    
    // Consulta SQL para actualizar los datos del registro
    $sql = "UPDATE campanas SET nombre_empresa='$nombre_empresa', direccion='$direccion', fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', descripcion='$descripcion' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        // Si la actualización fue exitosa, redirigir a la página principal
        header("Location: campaña.php");
        exit();
    } else {
        // Si ocurrió un error al actualizar los datos, mostrar un mensaje de error
        echo "Error al actualizar el registro: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el ID del registro, mostrar un mensaje de error
    echo "ID de registro no proporcionado";
}
?>
