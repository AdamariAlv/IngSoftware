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
            <a href="#">Cerrar Sesión</a>
            <span id="datetime"></span>
        </div>
    </header>

    <main>
        <div class="container">
        <h2 class="section-heading">Gestor de Usuarios</h2>
        <form action="procesar_guardar.php" method="POST" class="form-container">
            <div class="form-item">
                <label for="nombre-completo" class="form-label">Nombre Completo *</label>
                <input type="text" id="nombre-completo" name="nombre_completo" class="form-input" required>
            </div>
            <div class="form-item">
                <label for="numero-empleado" class="form-label">Cargo del Empleado *</label>
                <input type="text" id="numero-empleado" name="cargo_empleado" class="form-input" required>
            </div>
            <div class="form-item">
                <label for="num-nss" class="form-label">Número de Empleado *</label>
                <input type="text" id="num-nss" name="num_empleado" class="form-input" required>
            </div>
            <div class="form-item">
                <label for="cargo" class="form-label">Teléfono *</label>
                <input type="text" id="cargo" name="telefono" class="form-input" required>
            </div>
            <div class="form-item">
                <label for="telefono" class="form-label">Número de NSS*</label>
                <input type="text" id="telefono" name="nss" class="form-input" required>
            </div>
            <div class="form-item">
                <label for="correo" class="form-label">Correo Electrónico válido</label>
                <input type="text" id="correo" name="correo_electronico" class="form-input">
            </div>
            <div class="form-item">
                <label for="password" class="form-label">Contraseña *</label>
                <input type="password" id="password" name="contrasena" class="form-input" required>
                <p class="form-description">* Mínimo 8 caracteres, una mayúscula, una minúscula, un número, un carácter especial (*@/#)</p>
            </div>
            <div class="form-item">
                <label for="verificar-password" class="form-label">Verificar Contraseña *</label>
                <input type="password" id="password" name="contrasena" class="form-input" required
                 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@*#/]).{8,}" 
                 title="La contraseña debe tener al menos 8 caracteres, incluyendo al menos un número, una mayúscula, una minúscula y un carácter especial (@, *, # o /)">

            </div>
            <div class="form-buttons">
                <button type="button" class="small-form-button">Nuevo</button>
                <button type="submit" class="small-form-button">Guardar</button>
                <button type="button" class="small-form-button">Modificar</button>
                <button type="button" class="small-form-button">Eliminar</button>
            </div>
        </form>
          <h2 class="section-heading">Gestor de Usuarios</h2>
            <form action="index.php" method="POST" class="form-container">
                <div class="form-item">
                    <label for="num-nss" class="form-label">Número de Empleado *</label>
                    <input type="text" id="num-nss" name="num_empleado" class="form-input" required>
                </div>
                <div class="form-buttons">
                    <button type="submit" name="eliminar_usuario" class="small-form-button">Eliminar</button>
                </div>
            </form>
          
        <h2 class="section-heading">Búsqueda</h2>
        <div class="search-container">
            <label for="search-num-empleado">Num. Empleado:</label>
            <input type="text" id="search-num-empleado" placeholder="Ingrese el número de empleado">
            <button id="btn-buscar">Buscar</button>
            <label id="total-resultados">Total: 0 resultado(s)</label>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th><strong>Nombre completo</strong></th>
                    <th><strong>Número de empleado</strong></th>
                    <th><strong>Número NSS</strong></th>
                    <th><strong>Cargo del empleado</strong></th>
                    <th><strong>Teléfono</strong></th>
                    <th><strong>Correo electrónico</strong></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td colspan="6">No hay resultados para mostrar</td>
                </tr>
            </tbody>
        </table>

    </div>
    </main>
    
    <script src="script.js" defer></script>
</body>
</html>
