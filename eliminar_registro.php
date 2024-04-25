<?php
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

// Verificar si se recibió el ID del registro a eliminar
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Consulta SQL para eliminar el registro
    $sql = "DELETE FROM campanas WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Si la eliminación fue exitosa, devuelve un mensaje de éxito
        echo "Registro eliminado exitosamente";
    } else {
        // Si ocurrió un error al eliminar el registro, devuelve el mensaje de error
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    // Si no se recibió el ID del registro, devuelve un mensaje de error
    echo "ID de registro no proporcionado";
}

// Cerrar conexión
$conn->close();
?>
