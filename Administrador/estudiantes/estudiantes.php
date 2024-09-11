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
include_once 'bd_estudiante/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, doc, nombre, apellido, edad, genero, telefono, correo FROM propietario";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Cecal</title>

    <link rel="stylesheet" href="../../estilos/plugins/sweet_alert2/sweetalert2.min.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../../estilos1/bootstrap/css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../../estilos1/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../../estilos1/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
    <!--font awesome con CDN-->  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" href="estudiantes.css">

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

            <a href="../estudiantes/estudiantes.php" class="selected">
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

            <a href="../matricular/matricular.php">
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

    <main>
        <div>
            <center><h1>Estudiantes</h1></center>
        </div>
    <div class="container1">
        <div class="row">
                <a href="estudiantesregistro.php">
                    <button id="btnNuevo" type="button" class="btn btn-success">Nuevo</button>
                </a>
            </div>
                <a href="../matricular/matricular.php">
                    <button id="btnMatricular" type="button" class="btn btn-warning">Matricular</button>
                </a>
            </div>
        </div>
    </div>

    
    <div style="height:50px"></div>
     
  
     <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaEstudiantes" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Cédula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Edad</th>
                                    <th>Genero</th>
                                    <th>Télefono</th>
                                    <th>Correo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['doc'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['apellido'] ?></td>
                                <td><?php echo $dat['edad'] ?></td>
                                <td><?php echo $dat['genero'] ?></td>
                                <td><?php echo $dat['telefono'] ?></td>
                                <td><?php echo $dat['correo'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>


    <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formEstudiantes">
            <div class="modal-body">
                <div class="form-group">
                <label for="doc" class="col-form-label">Cédula:</label>
                <input type="text" class="form-control" id="doc">
                </div>
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="apellido" class="col-form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellido">
                <div class="form-group">
                <label for="genero" class="col-form-label">Genero:</label>
                <input type="text" class="form-control" id="genero">
                </div>
                <div class="form-group">
                <label for="edad" class="col-form-label">Edad:</label>
                <input type="number" class="form-control" id="edad">
                </div>
                <div class="form-group">
                <label for="telefono" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control" id="telefono">
                </div>
                <div class="form-group">
                <label for="correo" class="col-form-label">Correo:</label>
                <input type="email" class="form-control" id="correo">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
    </main>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../../estilos1/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../estilos1/popper/popper.min.js"></script>
    <script src="../../estilos1/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../../estilos1/datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="../../estilos1/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="../../estilos1/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="../../estilos1/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="../../estilos1/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../../estilos1/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <script src="../../estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>

    <script src="estudiantes.js"></script>

</body>
</html>