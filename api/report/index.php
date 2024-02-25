<?php

   


require '../../config/database.php';
require_once '../../src/controller/reportController.php';

require_once '../respuestasAPI.php';

$methodHTTP = $_SERVER['REQUEST_METHOD'];
switch ($methodHTTP) {

    case 'POST':
        $reportObj = new stdClass();
        $reportObj->planta_id = $_POST['planta_id'];
        $reportObj->linea_id = $_POST['linea_id'];
        $reportObj->estacion_id = $_POST['estacion_id'];
        $reportObj->comentario = $_POST['comentario'];

        if (isset($_FILES['imagen'])) {

            $imagen = new stdClass();

            // Asignar los valores de los atributos desde $_FILES
            $imagen->nombreArchivo = $_FILES['imagen']['name'];
            $imagen->tipoArchivo = $_FILES['imagen']['type'];
            $imagen->tamanoArchivo = $_FILES['imagen']['size'];
            $imagen->archivoTemporal = $_FILES['imagen']['tmp_name'];

            $report = new ReportController($pdo);

            $validacion = $report->validarImagenReport($imagen);
            

            if($validacion !== true){
                echo RespuestasAPI::error($validacion);
                exit();
            }
            try {
                //code...
                $path = $report->almacenarImagenReport($imagen);
            } catch (Exception $e) {
                //throw $th;
                echo RespuestasAPI::error($e->getMessage(),'500');
                exit();
            }
           
            $reportObj->path_imagen = $path;
            $data = json_decode(json_encode($reportObj), true);

            
            $report->registrar($data);


            echo RespuestasAPI::exitosa(null,'Reporte registrado con exito');
            exit();
        }else {
            echo RespuestasAPI::error('Imagen no cargada');
        }
        
        break;
    case 'GET':
        try {
            $report = new ReportController($pdo);
            $result = $report->obtenerTodos();
            echo RespuestasAPI::exitosa($result);
        } catch (Exception $e) {
            echo RespuestasAPI::error($e->getMessage(),'500');
        }
        break;
}
