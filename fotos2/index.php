<?php
session_start();

// Directorio donde se almacenarán las fotos
$directorioFotos = "fotos/";

// Comprobar si se ha enviado el formulario de autenticación
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Verificar si el directorio del usuario existe
    if (file_exists($directorioFotos . $username)) {
        // Establecer el nombre de usuario en la sesión
        $_SESSION['username'] = $username;
    } else {
        echo "Nombre de usuario inválido.";
    }
}

// Comprobar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Comprobar si se ha enviado el formulario de carga de fotos
    if (isset($_FILES['photo'])) {
        $archivoFoto = $_FILES['photo']['tmp_name'];
        $nombreFoto = $_FILES['photo']['name'];

        // Mover la foto al directorio correspondiente
        move_uploaded_file($archivoFoto, $directorioFotos . $username . "/" . $nombreFoto);
    }

    // Obtener todas las fotos del usuario
    $fotos = glob($directorioFotos . $username . "/*");

    // Mostrar la galería de miniaturas
    echo '<h1>Galería de fotos de ' . $username . '</h1>';
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<input type="file" name="photo" required>';
    echo '<input type="submit" value="Subir foto">';
    echo '</form>';

    foreach ($fotos as $foto) {
        echo '<a href="' . $foto . '"><img src="' . $foto . '" width="200" height="200"></a>';
    }
} else {
    // Mostrar formulario de autenticación
    echo '<form method="post">';
    echo '<label for="username">Nombre de usuario:</label>';
    echo '<input type="text" name="username" required>';
    echo '<input type="submit" value="Iniciar sesión">';
    echo '</form>';
}
?>
