<!DOCTYPE html>
<html>
<head>
    <title>Ver Anotación</title>
</head>
<body>
    <h1>Ver Anotación</h1>

    <?php
    if (isset($_GET['titulo'])) {
        $titulo = $_GET['titulo'];
        $directorio = 'storage/';
        $nombreArchivo = $directorio . $titulo . '.txt';

        if (file_exists($nombreArchivo)) {
            $contenido = file_get_contents($nombreArchivo);
            echo '<h2>' . $titulo . '</h2>';
            echo '<p>' . nl2br($contenido) . '</p>';
        } else
		{ echo ' <p> Anotación no encontrada. </p> '; }
		} else 
		{ echo ' <p> No se ha especificado una anotación. </p> '; } 
	?>
	
		<p><a href="index.php">Volver</a></p>
	</body> 
	</html>