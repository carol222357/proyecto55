<?php
$conexion = mysqli_connect("localhost", "root", "", "cecal");

if (isset($_POST['registrar'])) {
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['docente']) >= 1 && strlen($_POST['capacidad'] >= 1 && strlen($_POST['fecha_inicio']) >= 1 && strlen($_POST['fecha_cierre']) >= 1 && strlen($_POST['costo']) >= 1 )) {
        $nombre = trim($_POST['nombre']);
        $docente = trim($_POST['docente']);
        $capacidad = trim($_POST['capacidad']);
        $fecha_inicio = trim($_POST['fecha_inicio']);
        $fecha_cierre = trim($_POST['fecha_cierre']);
        $costo = trim($_POST['costo']);

        
        $imagen_dir = "imagenes/"; // Especifica la carpeta donde se guardara la imagen
        $imagen_file = $imagen_dir . basename($_FILES["imagen"]["name"]);
        $uploadok= 1;
        $imageFileType = strtolower(pathinfo($imagen_file,PATHINFO_EXTENSION));

        // Verifica si el archivo es una imagen real

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            if($check !== false){
                echo "El archivo es una imagen - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "El archivo no es una imagen.";
                $uploadOk = 0;
            }
        }
        
        // Verifica si el archivo ya existe

        if (file_exists($imagen_file)) {
            echo "Lo siento, el archivo ya existe.";
            $suploadOk = 0;
        }
        
        // Verifica el tamaño del archivo

        if ($_FILES["imagen"]["size"] > 500000) {
            echo "Lo siento, tu archivo es demasiado grande.";
            $uploadok = 0;
        }
        
        // Permite solo ciertos formatos de archivo
        
        if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
            $uploadok = 0;
        }

        // Verifica si $uploadok es 0 por algun error
        
        if ($uploadok == 0) {
            echo "Lo siento, tu archivo no fue subido.";
        
        // Si todo está bien, intenta subir el archivo
        } else{
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen_file)){
                echo "El archivo ". htmlspecialchars( basename( $_FILES["imagen"]["name"])). "ha sido subido exitosamente.";
            } else {
                echo "Lo siento, hubo un error subiendo tu archivo.";
            }
        }

        $consulta = "INSERT INTO cursos (nombre, docente, capacidad, fecha_inicio, fecha_cierre, costo, imagen)
        VALUES ('$nombre','$docente','$capacidad','$fecha_inicio','$fecha_cierre','$costo','$imagen_file')";
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
        header('Location: ../cursos.php');
    }
};