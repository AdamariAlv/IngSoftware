<?php

require('database.php');
$db = $conn; // Asigna tu variable de conexión

// Mensajes de error predeterminados
$login = $emailErr = $passErr = '';

// Extrae los datos del formulario POST
extract($_POST);

if (isset($_POST['submit'])) {
    // Validación de campos
    if (empty($CorreoElectronico)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($CorreoElectronico, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($Contraseña)) {
        $passErr = "Password is required";
    }

    // Si no hay errores de validación, procede
    if (empty($emailErr) && empty($passErr)) {
        // Llama a la función de inicio de sesión
        $login = login($CorreoElectronico, $Contraseña);
    }
}

// Función para iniciar sesión
function login($CorreoElectronico, $Contraseña)
{
    global $db;

    // Verifica si el usuario existe en la base de datos y su cargo es "administrador"
    $sql = "SELECT CorreoElectronico, Contraseña, Cargo_Empleado FROM usuarios WHERE CorreoElectronico=?";
    $query = $db->prepare($sql);
    $query->bind_param('s', $CorreoElectronico);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['Contraseña'];
        $Cargo_Empleado = $row['Cargo_Empleado'];

        // Verifica si la contraseña almacenada coincide con la contraseña proporcionada
        if ($Contraseña === $stored_password) {
            // Verifica si el usuario es un administrador
            if ($Cargo_Empleado == "administrador") {
                // Contraseña válida y usuario es administrador, inicia sesión
                session_start();
                $_SESSION['CorreoElectronico'] = $CorreoElectronico;
                header("location: dashboard_admin.php"); // Redirige a la página del panel de administrador
                exit;
            } else {
                // Contraseña válida pero usuario no es administrador, redirige a la página de empleado
                session_start();
                $_SESSION['CorreoElectronico'] = $CorreoElectronico;
                header("location: dashboard_employee.php"); // Redirige a la página del panel de empleado
                exit;
            }
        } else {
            // Contraseña incorrecta
            return "Your password is wrong";
        }
    } else {
        // Usuario no encontrado
        return "User not found";
    }
}

?>
