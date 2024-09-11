<?php
session_start();

require 'conexion1.php';

$nombre = $conn->real_escape_string($_POST['nombre']);
$docente = $conn->real_escape_string($_POST['docente']);
$capacidad = $conn->real_escape_string($_POST['capacidad']);
$fecha_inicio = $conn->real_escape_string($_POST['fecha_inicio']);
$fecha_cierre = $conn->real_escape_string($_POST['fecha_cierre']);
$costo = $conn->real_escape_string($_POST['costo']);

$sql = "INSERT INTO pelicula (nombre, docente, capacidad, fecha_inicio, fecha_cierre, costo)
VALUES ('$nombre', '$docente', '$capacidad', '$fecha_inicio', '$fecha_cierre', '$costo' NOW())";
if ($conn->query($sql)) {
    $id = $conn->insert_id;

    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";

    if ($_FILES['poster']['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");
        if (in_array($_FILES['poster']['type'], $permitidos)) {

            $dir = "posters";

            $info_img = pathinfo($_FILES['poster']['name']);
            $info_img['extension'];

            $poster = $dir . '/' . $id . '.jpg';

            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            if (!move_uploaded_file($_FILES['poster']['tmp_name'], $poster)) {
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error al guardar imagen";
            }
        } else {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] .= "<br>Formato de imágen no permitido";
        }
    }
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al guarda imágen";
}

header('Location: ../cursos.php');
?>