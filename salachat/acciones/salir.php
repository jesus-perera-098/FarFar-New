<?php
include('../config/config.php');

session_start();
$IdUserSession = $_REQUEST['id_usuario'];

// Eliminando las cookies de sesión
setcookie(session_name(), '', time() - 42000, '/');
unset($_COOKIE[session_name()]);

// Eliminando las variables de sesión
unset($_SESSION['id_usuario']);
unset($_SESSION['usuario']);
unset($_SESSION['clave']);
unset($_SESSION['nombre_completo']);
unset($_SESSION['imagen']);
session_unset();

// Destruyendo la sesión
session_destroy();

// Ajustando la zona horaria y obteniendo la fecha y hora actuales
date_default_timezone_set("America/Bogota");
$hora = date('h:i a', time() - 3600 * date('I'));
$fecha = date("d/m/Y");
$UltimaSession = $fecha . " " . $hora;

// Actualizando el estado de conexión del usuario
$stateconexion = "Inactiva";
$updateStateConexion = "UPDATE usuarios SET estatus=?, fecha_session=? WHERE id_usuario=?";
$stmt = $con->prepare($updateStateConexion);
$stmt->bind_param("ssi", $stateconexion, $UltimaSession, $IdUserSession);
$stateUpdate = $stmt->execute();

if ($stateUpdate) {
    echo '<meta http-equiv="refresh" content="0;url=../index.php">';
} else {
    echo "Error actualizando el estado del usuario.";
}

?>

