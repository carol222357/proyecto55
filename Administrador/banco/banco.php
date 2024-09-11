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
include_once 'bd_banco/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, Banco, Codigo, Cedula, Telefono, Beneficiario FROM bancos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Control de Pagos</title>
    
    <link rel="stylesheet" href="../../estilos/plugins/sweet_alert2/sweetalert2.min.css">
    <link rel="stylesheet" href="../../estilos/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../estilos/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../estilos/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="banco_1.css">

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

            <a href="../banco/banco.php" class="selected">
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

    <body>
    <div>
        <center><h1>Bancos</h1></center>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="bancoregistro.php">
                    <button id="btnNuevo" type="button" class="btn btn-success" >Nuevo</button>
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaBancos" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Banco</th>
                                    <th>Código</th>
                                    <th>Cédula o Rif</th>
                                    <th>Télefono</th>
                                    <th>Beneficiario</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['Banco'] ?></td>
                                <td><?php echo $dat['Codigo'] ?></td>
                                <td><?php echo $dat['Cedula'] ?></td>
                                <td><?php echo $dat['Telefono'] ?></td>
                                <td><?php echo $dat['Beneficiario'] ?></td>
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
        <form id="formBancos">
            <div class="modal-body">
                <div class="form-group">
                <label for="Banco" class="col-form-label">Banco:</label>
                <input type="text" class="form-control" id="Banco">
                </div>
                <div class="form-group">
                <label for="Codigo" class="col-form-label">Código:</label>
                <input type="number" class="form-control" id="Codigo">
                </div>
                <div class="form-group">
                <label for="Cedula" class="col-form-label">Cédula o Rif:</label>
                <input type="number" class="form-control" id="Cedula">
                <div class="form-group">
                <label for="Telefono" class="col-form-label">Telefono:</label>
                <input type="number" class="form-control" id="Telefono">
                </div>
                <div class="form-group">
                <label for="Beneficiario" class="col-form-label">Beneficiario:</label>
                <input type="text" class="form-control" id="Beneficiario">
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

    <script src="../../estilos1/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="../../estilos/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../estilos/popper/popper.min.js"></script>
    <script src="../../estilos/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../estilos/datatables/datatables.min.js"></script>

    <script src="banco.js"></script>

</body>

</html>