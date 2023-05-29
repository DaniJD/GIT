<!DOCTYPE html>
<html>
<head>
    <title>Aplicación de Anotaciones</title>
</head>
<body>
    <h1>Aplicación de Anotaciones</h1>

    <h2>Nueva Anotación</h2>
    <form action="guardar_anotacion.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>

        <label for="contenido">Contenido:</label><br>
        <textarea id="contenido" name="contenido" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Guardar">
    </form>

    <h2>Anotaciones Guardadas</h2>
    <ul>
        <?php
        $directorio = 'storage/';
        $archivos = scandir($directorio);
        foreach ($archivos as $archivo) {
            if ($archivo != '.' && $archivo != '..') {
                $titulo = pathinfo($archivo, PATHINFO_FILENAME);
                echo '<li><a href="ver_anotacion.php?titulo=' . urlencode($titulo) . '">' . $titulo . '</a></li>';
            }
        }
        ?>
    </ul>
</body>
</html>
