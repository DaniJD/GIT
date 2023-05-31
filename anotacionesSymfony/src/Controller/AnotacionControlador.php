<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Anotacion;

class AnotacionControlador extends AbstractController
{
    public function index(Request $request): Response
    {
        $anotaciones = [];
        $directorioAlmacenamiento = $this->getParameter('kernel.project_dir') . '/notas';

        if ($request->isMethod('POST')) {
            $anotacion = new Anotacion();
            $anotacion->setTitulo($request->request->get('title'));
            $anotacion->setContenido($request->request->get('content'));

            $nombreArchivo = $directorioAlmacenamiento . '/' . $anotacion->getTitulo() . '.txt';
            file_put_contents($nombreArchivo, $anotacion->getContenido());

            return $this->redirectToRoute('anotacion_index');
        } else {
            $archivos = scandir($directorioAlmacenamiento);
            foreach ($archivos as $archivo) {
                if (is_file($directorioAlmacenamiento . '/' . $archivo)) {
                    $titulo = pathinfo($archivo, PATHINFO_FILENAME);
                    $contenido = file_get_contents($directorioAlmacenamiento . '/' . $archivo);
                    $anotacion = new Anotacion();
                    $anotacion->setTitulo($titulo);
                    $anotacion->setContenido($contenido);
                    $anotaciones[] = $anotacion;
                }
            }
        }

        return $this->render('anotacion/index.html.twig', [
            'anotaciones' => $anotaciones,
        ]);
    }
}