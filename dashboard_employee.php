<?php
session_start();
$CorreoElectronico= $_SESSION['CorreoElectronico'];
if(empty($CorreoElectronico))
{
  header("location:login-form.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Viáticos - Inicio</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo1.png" alt="Logo Gobierno de Torreón">
        </div>
        <div class="user-info">
            <span>Bienvenid@ Usuario</span>
            <div class="notification">
                <img src="images/notification-icon.png" alt="Notificaciones">
                <span class="notification-badge"></span>
                <div class="notification-dropdown">
                    <div class="notification-item">
                        <strong>Nuevas solicitudes</strong>
                        <p>Tu solicitud está siendo procesada.</p>
                        <span class="notification-time">Hace 1 hora</span>
                    </div>
                </div>
            </div>
            <a href="logout.php">Cerrar Sesión</a>
            <span id="datetime"></span>
        </div>
    </header>

    <main>
        <h2 class="section-heading">Portal de Viáticos</h2>
        <div class="option-panel">
            <div class="option" onclick="location.href='nueva-solicitud.html';">
                <img src="images/nueva-solicitud-icon.png" alt="Nueva Solicitud">
                <span>Nueva Solicitud</span>
            </div>
            <div class="option" onclick="location.href='solicitudes-pendientes.html';">
                <img src="images/solicitudes-pendientes-icon.png" alt="Ver Solicitudes Pendientes">
                <span>Ver Solicitudes Pendientes</span>
            </div>
            <div class="option" onclick="location.href='todas-las-solicitudes.html';">
                <img src="images/todas-las-solicitudes-icon.png" alt="Todas las Solicitudes">
                <span>Todas las Solicitudes</span>
            </div>
        </div>
    </main>
    
    <script src="script.js" defer></script>
</body>
</html>
