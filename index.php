<?php
session_start();
$CorreoElectronico= $_SESSION['CorreoElectronico'];
if(empty($CorreoElectronico))
{
  header("location:login-form.php");
}

if(isset($_POST['eliminar_usuario'])) {

    $num_empleado = $_POST['num_empleado'];
    
    $conexion = new mysqli("localhost", "usuario", "contraseña", "nombre_base_de_datos");
    
    if($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $sql = "DELETE FROM nombre_tabla_usuarios WHERE num_empleado = '$num_empleado'";
    
    if($conexion->query($sql) === TRUE) {
        echo "El usuario ha sido eliminado correctamente.";
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
    
    $conexion->close();
}
?>