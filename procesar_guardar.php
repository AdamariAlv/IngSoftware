<?php
session_start();

if(empty($_SESSION['CorreoElectronico'])) {
    header("location: login-script.php");
    exit;
}

$host = 'localhost'; 
$dbname = 'Usuarios';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Usuarios (Nombre_Completo, Cargo_Empleado, NumEmpleado, Telefono, Nss, CorreoElectronico, Contraseña)
            VALUES (:Nombre_Completo, :Cargo_Empleado, :NumEmpleado, :Telefono, :Nss, :CorreoElectronico, :Contraseña)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':Nombre_Completo', $_POST['Nombre_Completo']);
    $stmt->bindParam(':Cargo_Empleado', $_POST['Cargo_Empleado']);
    $stmt->bindParam(':NumEmpleado', $_POST['NumEmpleado']);
    $stmt->bindParam(':Telefono', $_POST['Telefono']);
    $stmt->bindParam(':Nss', $_POST['Nss']);
    $stmt->bindParam(':CorreoElectronico', $_POST['CorreoElectronico']);
    $stmt->bindParam(':Contraseña', $password_hashed);

    $password_hashed = password_hash($_POST['Contraseña'], PASSWORD_DEFAULT);

    $stmt->execute();

    
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
