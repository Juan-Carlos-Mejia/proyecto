<?php
session_start(); // Inicia la sesión si no está iniciada

// Verificar si se ha enviado el formulario de registro de empresa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado todos los campos necesarios
    if (isset($_POST['nombre_empresa']) && isset($_POST['direccion']) && isset($_POST['telefono'])) {
        // Capturar los valores del formulario
        $nombre_empresa = $_POST['nombre_empresa'];
        $sitio_web = isset($_POST['sitio_web']) ? $_POST['sitio_web'] : null;
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $info_contacto = isset($_POST['info_contacto']) ? $_POST['info_contacto'] : null;

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

        // Preparar la consulta SQL
        $sql = "INSERT INTO empresas (nombre_empresa, sitio_web, direccion, telefono, info_contacto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre_empresa, $sitio_web, $direccion, $telefono, $info_contacto);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Registro de empresa exitoso, almacenar mensaje en sesión
            $_SESSION['success_message'] = "Registro de empresa exitoso";
            // Cerrar conexión
            $conn->close();
            // Redirigir a una página de éxito
            header("Location: Empresa.php");
            exit();
        } else {
            // Error al registrar la empresa, almacenar mensaje en sesión
            $_SESSION['error_message'] = "Error al registrar la empresa: " . $stmt->error;
            // Cerrar conexión
            $conn->close();
            // Redirigir a una página de error
            header("Location: Empresa.php");
            exit();
        }
    } else {
        // Redirigir si no se enviaron todos los campos necesarios
        header("Location: Empresa.php");
        exit();
    }
} else {
    // Redirigir si no se ha enviado el formulario de registro de empresa
    header("Location: Empresa.php");
    exit();
}
?>
