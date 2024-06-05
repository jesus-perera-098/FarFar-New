<?php
include('../config/config.php');

// Verificar si se está enviando el formulario por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpiar los datos del formulario
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $clave = mysqli_real_escape_string($con, $_POST['clave']);
    $nombre_completo = mysqli_real_escape_string($con, $_POST['nombre_completo']);

    // Verificar si se ha cargado un archivo de imagen
    if (isset($_FILES['imagenPerfil']) && $_FILES['imagenPerfil']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['imagenPerfil']['name'];
        $file_loc = $_FILES['imagenPerfil']['tmp_name'];
        $fileExtension = strtolower(pathinfo($img, PATHINFO_EXTENSION));

        // Generar un nombre único para la imagen
        $newname = md5(uniqid(rand(), true));
        $imgperfil = $newname . '.' . $fileExtension;

        // Verificar si existe el directorio para guardar las imágenes
        $directorio = "../imagenesperfil";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Mover el archivo de imagen al directorio destino
        $target_path = $directorio . '/' . $imgperfil;
        if (move_uploaded_file($file_loc, $target_path)) {
            // Obtener la fecha y hora actual
            $fechaRegistro = date("Y-m-d H:i:s");
            $estatus = "Activo";

            // Insertar los datos del usuario en la base de datos
            $sql_insert = "INSERT INTO usuarios (usuario, clave, nombre_completo, imagen, fecha_registro, estatus)
                           VALUES ('$usuario', '$clave', '$nombre_completo', '$imgperfil', '$fechaRegistro', '$estatus')";
            $result_insert = mysqli_query($con, $sql_insert);
            if ($result_insert) {
                header("Location: ../home.php");
                exit;
            } else {
                echo "Ha ocurrido un error al registrar el usuario.";
            }
        } else {
            echo "Ha ocurrido un error al subir la imagen.";
        }
    } else {
        echo "Debe seleccionar una imagen.";
    }
} else {
    echo "Acceso denegado.";
}
?>

