<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$docente = (isset($_POST['docente'])) ? $_POST['docente'] : '';
$capacidad = (isset($_POST['capacidad'])) ? $_POST['capacidad'] : '';
$fecha_inicio = (isset($_POST['fecha_inicio'])) ? $_POST['fecha_inicio'] : '';
$fecha_cierre= (isset($_POST['fecha_cierre'])) ? $_POST['fecha_cierre'] : '';
$costo= (isset($_POST['costo'])) ? $_POST['costo'] : '';
$imagen= (isset($_POST['imagen'])) ? $_POST['imagen'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 2: //modificación
        $consulta = "UPDATE cursos SET nombre='$nombre', docente='$docente', capacidad='$capacidad', fecha_inicio='$fecha_inicio', fecha_cierre='$fecha_cierre, 'costo='$costo', imagen='$imagen' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, docente, capacidad, fecha_inicio, fecha_cierre, costo, imagen FROM cursos WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "DELETE FROM cursos WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
