<?php
session_start();

if (empty($_SESSION['CorreoElectronico']) && basename($_SERVER['PHP_SELF']) != 'procesar_guardar.php') {
    header("location: procesar_guardar.php");
    exit;
}

// Conexión a la base de datos
function connectToDatabase($host, $dbname, $user, $password) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error al conectar a la base de datos: " . $e->getMessage());
    }
}

function validateInput($data) {
    if (
        empty($data['Nombre_Completo']) ||
        empty($data['Cargo_Empleado']) ||
        empty($data['NumEmpleado']) ||
        empty($data['Telefono']) ||
        empty($data['Nss']) ||
        empty($data['CorreoElectronico']) ||
        empty($data['Contraseña']) ||
        empty($data['Confirmar_Contraseña']) ||
        $data['Contraseña'] !== $data['Confirmar_Contraseña']
    ) {
        throw new Exception("Todos los campos son obligatorios y las contraseñas deben coincidir.");
	
    }

    $password = $data['Contraseña'];
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[*@\/#])[A-Za-z\d*@\/#]{8,}$/', $password)) {
        throw new Exception("La contraseña debe tener al menos 8 caracteres, incluyendo al menos una mayúscula, una minúscula, un número y un carácter especial (*@/#).");
    }
}

function insertUser($conn, $data) {
    $sql = "INSERT INTO Usuarios (Nombre_Completo, Cargo_Empleado, NumEmpleado, Telefono, Nss, CorreoElectronico, Contraseña)
            VALUES (:Nombre_Completo, :Cargo_Empleado, :NumEmpleado, :Telefono, :Nss, :CorreoElectronico, :Contraseña)";
    $stmt = $conn->prepare($sql);
    $password_hashed = password_hash($data['Contraseña'], PASSWORD_DEFAULT);

    $stmt->bindParam(':Nombre_Completo', $data['Nombre_Completo']);
    $stmt->bindParam(':Cargo_Empleado', $data['Cargo_Empleado']);
    $stmt->bindParam(':NumEmpleado', $data['NumEmpleado']);
    $stmt->bindParam(':Telefono', $data['Telefono']);
    $stmt->bindParam(':Nss', $data['Nss']);
    $stmt->bindParam(':CorreoElectronico', $data['CorreoElectronico']);
    $stmt->bindParam(':Contraseña', $password_hashed);
    $stmt->execute();
}

$host = 'localhost'; 
$dbname = 'gdu';
$user = 'root';
$password = '';

try {
    $conn = connectToDatabase($host, $dbname, $user, $password);
    validateInput($_POST);
    insertUser($conn, $_POST);
    header("Location: registro_exitoso.php");
    exit;
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
