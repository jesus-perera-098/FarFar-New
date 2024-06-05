<?php
session_start();
include('../config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $clave = mysqli_real_escape_string($con, $_POST['clave']);

    // Consulta para verificar las credenciales del usuario
    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave' LIMIT 1";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Configurar las variables de sesión
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre_completo'] = $row['nombre_completo'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['imagen'] = $row['imagen'];

        // Redirigir a operador.php después de iniciar sesión exitosamente
        header("Location: ../home.php");
        exit();
    } else {
        // Redirigir de nuevo al formulario de inicio de sesión con un mensaje de error
        header("Location: ../index.php?error=1");
        exit();
    }
} else {
    // Si no se accede por POST, redirigir al formulario de inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>