<?php
// Iniciar sesión
session_start();

// Destruir sesión
session_destroy();

// Eliminar cookie de sesión
setcookie(session_name(), '', time() - 3600);

// Redirigir al usuario a la página de inicio
header('Location: ../../index.php');
exit;
?>