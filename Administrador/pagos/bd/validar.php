<?php
session_start(); // Iniciar sesión

$conexion = mysqli_connect("localhost", "root", "", "cecal");

if (isset($_POST['registrar'])) {
    if (strlen($_POST['doc']) >= 1 && strlen($_POST['nombre']) >= 1 && strlen($_POST['dir']) >= 1 && strlen($_POST['tel']) >= 1&& strlen($_POST['curso']) >= 1&& strlen($_POST['costo']) >= 1) {
        $doc = trim($_POST['doc']);
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['dir']);
        $edad = trim($_POST['tel']);
        $curso = trim($_POST['curso']);
        $costo = trim($_POST['costo']);

        // Verificar si el token ya se ha enviado previamente
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {
            $respuesta = array('status' => 'error', 'message' => 'Formulario ya enviado');
            echo json_encode($respuesta);
            exit;
        }

        // Generar un nuevo token para la próxima solicitud
        $_SESSION['token'] = $_POST['token'];

        $consulta = "INSERT INTO matriculados (doc, nombre, apellido, edad, curso, costo)
        VALUES ('$doc','$nombre','$apellido','$edad','$curso','$costo')";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            $respuesta = array('status' => 'success', 'message' => 'Matriculación correcta');
        } else {
            $respuesta = array('status' => 'error', 'message' => 'Error al matricular');
        }

        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
};

?>