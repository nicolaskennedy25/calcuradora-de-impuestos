 <?php
$host = "localhost";
$user = "root";
$pass = ""; // Por defecto en XAMPP está vacío
$db   = "impuestos_db";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Para que soporte caracteres especiales
mysqli_set_charset($conexion, "utf8mb4");
?>
