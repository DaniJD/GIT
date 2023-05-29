<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $directorio = 'storage/';
    $nombreArchivo = $directorio . $titulo . '.txt';

    $archivo = fopen($nombreArchivo, 'w');
    fwrite($archivo, $contenido);
    fclose($archivo);
}

header('Location: index.php');
exit;
?>
