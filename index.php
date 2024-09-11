<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Control de Pagos</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">

    <link rel="stylesheet" href="estilos/plugins/sweet_alert2/sweetalert2.min.css">

    <script src="https://kit.fontawesome.com/52493110e2.js" crossorigin="anonymous"></script>
</head>

<body>

    <section>
        <div class="contenedor">
            <div class="formulario">
                <form id="formLogin" class="form" action="conexion/conexion.php" method="post">
                    <h2>Iniciar Sesión</h2>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="usuario" required>
                        <label for="usuario">Usuario</label>
                    </div>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" required required minlength="8">
                        <label for="password">Contraseña</label>
                    </div>

                    <div>
                        <button>Acceder</button>
                    </div>

            </div>
            </form>
        </div>
        </div>
    </section>

    <script src="estilos/jquery/jquery-3.3.1.min.js"></script>
    <script src="estilos/popper/popper.min.js"></script>
    <script src="estilos/bootstrap/js/bootstrap.min.js"></script>

    <script src="estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script>
</body>

</html>