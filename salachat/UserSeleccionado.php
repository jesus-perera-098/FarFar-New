<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chat - WhatApp!</title>
  <style type="text/css" media="screen">
    .zmdi-mail-reply:hover {
      color: #00796B !important;
      cursor: pointer;
    }

    .zmdi-comment-image:hover {
      color: #00796B !important;
      cursor: pointer;
    }

    /**style para el boton examinar***/
    .uploadFile {
      visibility: hidden;
    }

    #uploadIcon {
      cursor: pointer;
    }

    .camara {
      font-size: 45px;
      float: right !important;
      margin-left: 1000px;
      margin-top: -5px;
    }

    .camara:hover {
      color: #333;
    }

    .fa-microphone:hover {
      cursor: pointer;
      color: #333;
    }
  </style>
</head>

<body>

  <?php
  sleep(1);
  header("Content-Type: text/html;charset=utf-8");

  include('config/config.php');

  // Verificar si 'email_user' está definido en $_REQUEST
  $email_user = isset($_REQUEST['email_user']) ? $_REQUEST['email_user'] : '';

  $IdUser                 = $_REQUEST['id'];
  $idConectado            = $_REQUEST['idConectado'];

  //Actualizando los mensajes no leidos ya que estoy entrando en mis mensajes
  if (!empty($IdUser)) {
    $leyendoMsj = ("UPDATE msjs SET leido = 'SI' WHERE  user_id='$IdUser' AND to_id='$idConectado' ");
    $queryLeerMsjs = mysqli_query($con, $leyendoMsj);
  }

  $QueryUserSeleccionado = ("SELECT * FROM usuarios WHERE id_usuario='$IdUser' LIMIT 1 ");
  $QuerySeleccionado     = mysqli_query($con, $QueryUserSeleccionado);

  while ($rowUser = mysqli_fetch_array($QuerySeleccionado)) {
  ?>
    <div class="status-bar"> </div>
    <div class="row heading">
      <div class="col-sm-2 heading-avatar">
        <a href="./" style="color: #fff;">
          <div class="heading-avatar-icon">
            <i class="zmdi zmdi-arrow-left" style="font-size:20px"></i>
            <img src="<?php echo 'imagenesperfil/' . $rowUser['imagen']; ?>">
          </div>
        </a>
      </div>
      <div class="col-sm-3 heading-name">
        <a class="heading-name-meta">
          <?php echo $rowUser['nombre_completo']; ?>
        </a>
      </div>

    </div>

    <!-- El resto del código sigue igual -->
    <!-- ... -->
    <!-- ... -->

  <?php } ?>

  <script type="text/javascript">
    // El JavaScript también sigue igual
  </script>

</body>

</html>


