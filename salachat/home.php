<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include('config/config.php');
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") 
  $usuario = $_SESSION['usuario'];
  $imgPerfil = $_SESSION['imagen'];
  $idConectado = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Menu inicio</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="../assets/images/SC.png" alt="logo" width="80" height="62">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <!-- Aquí puedes añadir más elementos de menú -->
                                </li>
                                <li class="w-101">
                                    <li>
                                        <a href="ejercicios.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Chat Global</span></a>
                                        <a href="chat/users.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Chat Local</span></a>
                                        <a href="operador.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Chat del Team</span></a>
                                    </li>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://cdn-icons-png.flaticon.com/512/2744/2744146.png" alt="user image" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['usuario']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li>
                                <a href="../salir.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Cerrar Sesión</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3" style="font-weight: 800; font-size: 40px">
                ¡Bienvenido, <?php echo $_SESSION['usuario']; ?>!
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

