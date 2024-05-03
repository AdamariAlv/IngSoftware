<?php
session_start();

if (empty($_SESSION['CorreoElectronico'])) {
    header("location: login-script.php");
    exit;
}

$host = 'localhost'; 
$dbname = 'gdu';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (
        empty($_POST['Nombre_Completo']) ||
        empty($_POST['Cargo_Empleado']) ||
        empty($_POST['NumEmpleado']) ||
        empty($_POST['Telefono']) ||
        empty($_POST['Nss']) ||
        empty($_POST['CorreoElectronico']) ||
        empty($_POST['Contraseña'])
    ) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    $password = $_POST['Contraseña'];
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[*@\/#])[A-Za-z\d*@\/#]{8,}$/', $password)) {
        throw new Exception("La contraseña debe tener al menos 8 caracteres, incluyendo al menos una mayúscula, una minúscula, un número y un carácter especial (*@/#).");
    }

    $sql = "INSERT INTO Usuarios (Nombre_Completo, Cargo_Empleado, NumEmpleado, Telefono, Nss, CorreoElectronico, Contraseña)
            VALUES (:Nombre_Completo, :Cargo_Empleado, :NumEmpleado, :Telefono, :Nss, :CorreoElectronico, :Contraseña)";
    $stmt = $conn->prepare($sql);

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bindParam(':Nombre_Completo', $_POST['Nombre_Completo']);
    $stmt->bindParam(':Cargo_Empleado', $_POST['Cargo_Empleado']);
    $stmt->bindParam(':NumEmpleado', $_POST['NumEmpleado']);
    $stmt->bindParam(':Telefono', $_POST['Telefono']);
    $stmt->bindParam(':Nss', $_POST['Nss']);
    $stmt->bindParam(':CorreoElectronico', $_POST['CorreoElectronico']);
    $stmt->bindParam(':Contraseña', $password_hashed);

    $stmt->execute();

    header("Location: registro_exitoso.php");
    exit();

} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
