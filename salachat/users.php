<?php
session_start();
include('config/config.php');
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
  $idConectado = $_SESSION['id_usuario'];
  $NombreUsuarioSesion = $_SESSION['nombre_completo'];
  $imgPerfil = $_SESSION['imagen'];

  $QueryUsers = "SELECT id_usuario, imagen, clave, nombre_completo, fecha_session, estatus 
                 FROM usuarios 
                 WHERE id_usuario != ? 
                 ORDER BY usuario ASC";
  $stmt = $con->prepare($QueryUsers);
  $stmt->bind_param("i", $idConectado);
  $stmt->execute();
  $resultadoQuery = $stmt->get_result();
?>

<div class="status-bar"></div>
<div class="row heading">
  <div class="col-sm-8 col-xs-8 heading-avatar">
    <div class="heading-avatar-icon">
      <img src="<?php echo 'imagenesperfil/' . $imgPerfil; ?>">
      <strong style="padding: 0px 0px 0px 20px;">
        <?php echo htmlspecialchars($NombreUsuarioSesion); ?>
      </strong>
    </div>
  </div>

  <div class="col-sm-1 col-xs-1 heading-compose pull-right">
    <a href="acciones/salir.php?id=<?php echo $idConectado; ?>">
      <i class="zmdi zmdi-power" style="font-size: 25px;"></i>
    </a>
  </div>
  <div class="col-sm-1 col-xs-1 pull-right icohome">
    <a href="home.php">
      <i class="zmdi zmdi-refresh zmdi-hc-2x"></i>
    </a>
  </div>
</div>

<div class="row searchBox">
  <div class="col-sm-12 searchBox-inner">
    <div class="form-group has-feedback">
      <input id="searchText" type="search" class="form-control" name="searchText" placeholder="Buscar">
      <span class="glyphicon glyphicon-search form-control-feedback"></span>
    </div>
  </div>
</div>

<div class="row sideBar">
  <?php
  while ($FilaUsers = $resultadoQuery->fetch_assoc()) {
    $id_usuario = $FilaUsers['id_usuario'];

    $resultado = "SELECT * FROM msjs WHERE user_id = ? AND to_id = ? AND leido = 'NO'";
    $stmtMsjs = $con->prepare($resultado);
    $stmtMsjs->bind_param("ii", $id_usuario, $idConectado);
    $stmtMsjs->execute();
    $re = $stmtMsjs->get_result();
    $numero_filas = $re->num_rows;

    // Buscando los mensajes que están sin leer por dicho usuario en sesión.
    $no_leidos = '';
    if ($numero_filas > 0) {
      $res = "SELECT * FROM msjs WHERE user_id = ? AND leido = 'NO'";
      $stmtNoLeidos = $con->prepare($res);
      $stmtNoLeidos->bind_param("i", $id_usuario);
      $stmtNoLeidos->execute();
      $ree = $stmtNoLeidos->get_result();
      if ($cantMsjs = $ree->num_rows > 0) { ?>
        <div style="display:none;">
          <audio controls autoplay>
            <source src="effect.mp3" type="audio/mp3">
          </audio>
        </div>
      <?php }
    }
    $no_leidos = $numero_filas;
  ?>
    <div class="row sideBar-body" id="<?php echo $FilaUsers['id_usuario']; ?>">
      <div class="col-sm-3 col-xs-3 sideBar-avatar">
        <div class="avatar-icon">
          <img src="<?php echo 'imagenesperfil/' . htmlspecialchars($FilaUsers['imagen']); ?>" class="notification-container" style="border:3px solid <?php echo $FilaUsers['estatus'] != 'Inactiva' ? '#28a745' : '#696969'; ?> !important;">
        </div>
      </div>
      <div class="col-sm-9 col-xs-9 sideBar-main">
        <div class="row">
          <div class="col-sm-8 col-xs-8 sideBar-name">
            <span class="name-meta">
              <?php echo htmlspecialchars($FilaUsers['nombre_completo']); ?>
            </span>
          </div>
          <div class="col-sm-4 col-xs-4 pull-right sideBar-time" style="color:#93918f;">
            <span class="notification-counter">
              <?php echo $no_leidos; ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
  $(function() {
    $(".sideBar-body").on("click", function() {
      $(".sideBar-body").removeClass("seleccionado");
      $(this).addClass("seleccionado");

      var id = $(this).attr('id');
      var idConectado = "<?php echo $idConectado; ?>";
      var dataString = 'id=' + id + '&idConectado=' + idConectado;

      var ruta = "UserSeleccionado.php";
      $('#capausermsj').html('<img src="assets/img/cargando.gif" class="ImgCargando"/>');
      $.ajax({
        url: ruta,
        type: "POST",
        data: dataString,
        success: function(data) {
          $("#capausermsj").html(data);
          $("#conversation").animate({
            scrollTop: $(document).height()
          }, 1000);
        }
      });
      return false;
    });
  });

  $(function() {
    $(".heading-compose").click(function() {
      $(".side-two").css({
        "left": "0"
      });
    });

    $(".newMessage-back").click(function() {
      $(".side-two").css({
        "left": "-100%"
      });
    });
  });
</script>

<?php } else {
  echo '<script type="text/javascript">
    alert("Debe Iniciar Sesión");
    window.location.assign("index.php");
  </script>';
} ?>
