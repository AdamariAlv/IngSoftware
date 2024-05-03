<?php
session_start();
require(database.php) 
$db = $conn;
if (empty($_SESSION['CorreoElectronico'])) {
    header("location:login-script.php");
    exit();
}

$host = "localhost";
$username = "root";
$password = "";
$database = "gdu";

$conn = new mysqli($host, $username, $password, $database);

¡if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nombre_completo = $_POST['nombre_completo'] ?? '';
$cargo_empleado = $_POST['cargo_empleado'] ?? '';
$num_empleado = $_POST['num_empleado'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$nss = $_POST['nss'] ?? '';
$correo_electronico = $_POST['correo_electronico'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuarios (Nombre_Completo, NumEmpleado, Nss, Cargo_Empleado, Telefono, CorreoElectronico, Contraseña) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

$stmt->bind_param("sssssss", $nombre_completo, $num_empleado, $nss, $cargo_empleado, $telefono, $correo_electronico, $contrasena_hash);

if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

$conn->close();

header("Location: dashboard_admin.html");
exit();
?>

