<?php
session_start(); // Inicia la sesión si no está iniciada
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminstrador</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .search-form {
            text-align: center; 
            margin-top: 90px; 
        }
        .search-form input[type="text"],
        .search-form button {
            width: 200px;
            height: 30px;
            font-size: 16px;
        }
    
        .user-info {
            text-align: center;
            margin-top: 50px; /* Ajusta el margen superior según sea necesario */
            font-size: 24px; /* Tamaño de letra más grande */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="btn-menu">
                <label for="btn-menu">☰</label>
            </div>
            <div class="logo">
                <h1>TechnologyEco</h1>
            </div>
            <div class="user-info">
    <?php
    // Verifica si hay un mensaje de bienvenida en la sesión
    if (isset($_SESSION['welcome_message'])) {
        // Muestra el mensaje de bienvenida
        echo "<p>" . $_SESSION['welcome_message'] . "</p>";
        // Elimina el mensaje de bienvenida de la sesión para que no se muestre nuevamente
        unset($_SESSION['welcome_message']);
    }
    ?>
</div>

        </div>
    </header>

    <!-- Menú de navegación -->
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="admin.php">TechnologyEco</a>
                <br><br><br><br>
                <a href="#"><i class="fas fa-box"></i> Contenedores</a>
                <a href="campaña.php"><i class="fas fa-flag"></i> Campañas</a>
                <a href="empresa.php"><i class="fas fa-building"></i> Empresas</a>
                <a href="#"><i class="fas fa-comments"></i> Chat en línea</a>
                <a href="index.html"><i class="fas fa-door-closed "></i> Cerrar Sesión</a>
            </nav>
            <label for="btn-menu">✖️</label>
        </div>
    </div>

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
