<?php
session_start();

// Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../../index.php");
    exit;
} elseif ($_SESSION["s_idRol"] != 1) {
    header("Location: ../../../Secretaria/panel/index.php");
    exit;
}

// Update the session time
$_SESSION['time'] = time();
?>

<?php
$link =mysqli_connect("localhost", "root", "");
if($link){
  mysqli_select_db($link, "cecal");
  mysqli_query($link, "SET NAMES 'utf8'");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Control de Pagos</title>
    
    <link rel="stylesheet" href="../../estilos1/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/plugins/sweet_alert2/sweetalert2.min.css">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../../estilos1/bootstrap/css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../../estilos1/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../../estilos1/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           

    <link rel="stylesheet" href="matricular.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <img src="../iconos/bars-solid.svg" class="botones" id="btn_open"></img>
        </div>
        <div class="usuario">
            <img src="../iconos/user-solid.svg" class="botones"></img>
            <h2 class="secion"><span>
                    <?php echo $_SESSION["s_usuario"]; ?>
                </span></h2>
            <a href="../conexion/logout.php" role="button">
                <img src="../iconos/right-to-bracket-solid.svg" class="botones1"></img>
            </a>
        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <img src="../iconos/house-solid.svg" class="botones"></img>
            <h4>CECAL</h4>
        </div>

        <div class="options__menu">

            <a href="../panel/index.php">
                <div class="option">
                    <img src="../iconos/gauge-high-solid.svg" class="botones" title="Panel de Control"></img>
                    <h4>Panel de Control</h4>
                </div>
            </a>

            <a href="../banco/banco.php">
                <div class="option">
                    <img src="../iconos/landmark-solid.svg" class="botones" title="Bancos"></img>
                    <h4>Bancos</h4>
                </div>
            </a>

            <a href="../estudiantes/estudiantes.php">
                <div class="option">
                    <img src="../iconos/circle-user-solid.svg" class="botones" title="Estudiantes"></img>
                    <h4>Estudiantes</h4>
                </div>
            </a>

            <a href="../cursos/cursos.php">
                <div class="option">
                    <img src="../iconos/folder-open-solid.svg" class="botones" title="Cursos"></img>
                    <h4>Cursos</h4>
                </div>
            </a>

            <a href="../pagos/pagos.php">
                <div class="option">
                    <img src="../iconos/money-bill-solid.svg" class="botones" title="Pagos"></img>
                    <h4>Pagos</h4>
                </div>
            </a>

            <a href="../reportes/reportes.php">
                <div class="option">
                    <img src="../iconos/file-regular.svg" class="botones" title="Reportes"></img>
                    <h4>Reportes</h4>
                </div>
            </a>

            <a href="matricular.php" class="selected">
                <div class="option">
                    <img src="../iconos/address-card-regular.svg" class="botones" title="Matricular"></img>
                    <h4>Matricular</h4>
                </div>
            </a>

            <details>
                <summary>
                    <div class="option_1">
                        <img src="../iconos/gears-solid.svg" class="botones" title="Administrador"></img>
                        <h4>----OPCIONES</h4>
                    </div>
                </summary>
                <a href="../administrador/administrador.php">
                    <div class="option">
                        <img src="../iconos/gear-solid.svg" class="botones" title="Administrar"></img>
                        <h4>Administrar</h4>
                    </div>
                </a>
            </details>

            <div class="option">
                <a href="../conexion/logout.php" role="button">
                    <img src="../iconos/right-to-bracket-solid.svg" class="botones1"></img>
                </a>
                <h4>Cerrar Sección</h4>
            </div>


        </div>

    </div>
<div class="container1">
        <div class="row">
                <a href="../estudiantes/estudiantesregistro.php">
                    <button id="btnNuevo" type="button" class="btn btn-success">Nuevo Estudiante</button>
                </a>
            </div>
                <a href="../pagos/pagos.php">
                    <button id="btnMatricular" type="button" class="btn btn-warning">Pagar Matricula</button>
                </a>
            </div>
        </div>
</div>
<div class="container">

<div class="cargando row">       
  <div class="d-flex justify-content-center">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
  </div>
</div>


  <div class="formulario row">
  <!-- INICIA LA COLUMNA -->
    <div class="col-md-8 offset-md-4">
      <center><h1>Matricular</h1></center>
      <form id="formLogin"  method="post">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="doc">Cédula:</label>
                <div class="input-group">
                  <input type="text" name="doc" class="form-control" id="doc" placeholder="Buscar"  onblur="buscar_datos();">
                  <div class="input-group-append">
                    <button type="button" value="ENVIAR" class="btn btn-primary" name="btn_enviar">Buscar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="nombre">Nombres</label>
              <input type="text" name="nombre" class="form-control" id="nombre" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="dir">Apellidos</label>
              <input type="text" name="dir" class="form-control" id="dir" readonly>
            </div>
            <div class="col-md-6">
              <label for="tel">Edad</label>
              <input type="text" name="tel" class="form-control" id="tel" readonly>
            </div>
          </div>
          <br>
          <center><h3>Detalles de Matriculación</h3></center>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <label for="curso" class="form-label">Cursos:</label>
              <select name="curso" class="form-control" id="curso" required>
                <option value="">Seleccionar...</option>
                <?php
                  $v = mysqli_query($link, "SELECT * FROM cursos ");
                  while($curso = mysqli_fetch_row($v)){
                ?>
                  <option><?php echo $curso[1] ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="costo">Costo:</label>
              <input type="text" name="costo" class="form-control" id="costo">
            </div>
          </div>
        </div>
        <br>
        <center>
          <!-- Cambia el tipo de botón a submit y asigna un ID -->
          <button type="submit" class="btn btn-success" id="submitButton" name="registrar">Guardar</button>
          <button type="reset" class="btn btn-danger">Cancelar</button>
        </center>
      </form>
</div>
</body>
</html>
<script src="../../estilos1/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../estilos1/popper/popper.min.js"></script>
    <script src="../../estilos1/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../../estilos1/datatables/datatables.min.js"></script>
    <script src="../../estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>

    <script src="matricular.js"></script>


<script type="text/javascript">
  $(document).ready(function(){
        $('.cargando').hide();
      });  

  function buscar_datos()
  {
    doc = $("#doc").val();
    
    
    var parametros = 
    {
      "buscar": "1",
      "doc" : doc
    };
    $.ajax(
    {
      data:  parametros,
      dataType: 'json',
      url:   'codigos_php.php',
      type:  'post',
      beforeSend: function() 
      {
        $('.formulario').hide();
        $('.cargando').show();
        
      }, 
      error: function()
      {alert("Error");},
      complete: function() 
      {
        $('.formulario').show();
        $('.cargando').hide();
       
      },
      success:  function (valores) 
      {
        if(valores.existe=="1") //Aqui usamos la variable que NO use en el vídeo
        {
          $("#nombre").val(valores.nombre);
          $("#dir").val(valores.direccion);
          $("#tel").val(valores.telefono);
        }
        else
        {
          Swal.fire({
                        type: 'error',
                        title: 'Estudiante no existe crealo',
                    });
        }

      }
    }) 
  }

  function limpiar()
  {
    $("#doc").val("");
    $("#nombre").val("");
    $("#dir").val("");
    $("#tel").val("");
  }
</script>