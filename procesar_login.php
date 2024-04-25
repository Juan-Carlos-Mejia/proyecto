<?php
// Iniciar sesión si no está iniciada
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se enviaron los campos del formulario
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Obtener las credenciales del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

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

        // Consulta SQL para buscar el usuario por nombre de usuario y contraseña
        $sql = "SELECT * FROM usuarios_admin WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Inicio de sesión exitoso
            // Almacena el mensaje de bienvenida en la sesión
            $_SESSION['welcome_message'] = "¡Bienvenido, " . $username . "!";
            // Redirigir al usuario al sistema de administrador
            header("Location: admin.php");
            exit();
        } else {
            // Usuario o contraseña incorrectos
            header("Location: iniciosesion.html?error=1");
            exit();
        }
    } else {
        // Redirigir si los campos no se enviaron
        header("Location: iniciosesion.html");
        exit();
    }
}
?>
