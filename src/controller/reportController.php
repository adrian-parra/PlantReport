<?php
require_once '../../src/model/reportRepository.php';
require '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;


class ReportController
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function registrar(array $data)
    {
        $report = new ReportRepository($this->pdo);
        $report->create($data);
    }
    public function obtenerTodos()
    {
        $reports = new ReportRepository($this->pdo);
        $result = $reports->findAll();
        return $result;
    }

    public function almacenarImagenReport($imagen)
    {
        // Obtener el contenido del archivo
        $fileContent = file_get_contents($imagen->archivoTemporal);

        // Definir la ruta donde se quiere guardar la imagen
        $rutaGuardado = 'uploads';
        if (!file_exists($rutaGuardado)) {
            mkdir($rutaGuardado, 0777, true);
          }

        // Generar un UUID único
        $uuid = Uuid::uuid4();

        // Obtener la extensión del archivo original
        $extension = pathinfo($imagen->nombreArchivo, PATHINFO_EXTENSION);

        // Crear el nombre del archivo con el UUID y la extensión
        $nuevoNombreArchivo = $uuid->toString() . '.' . $extension;

        // Ruta completa donde se guardará la imagen
        $rutaCompleta = $rutaGuardado . '/' . $nuevoNombreArchivo;

        // Guardar el archivo con el nuevo nombre
        if (file_put_contents('../../'.$rutaCompleta, $fileContent)) {
            // Archivo guardado exitosamente
            // echo "El archivo se ha guardado correctamente con el nombre: $nuevoNombreArchivo";
        } else {
            // Manejar el error si la operación de escritura falla
            // echo "Error al guardar el archivo.";
        }

        return  $rutaCompleta;
    }

    public function validarImagenReport($imagen)
    {
        // Realiza la validación aquí
        // Por ejemplo, verifica si se han recibido los datos esperados, si el tipo de archivo es válido, etc.
        // Devuelve true si la validación pasa o un mensaje de error si falla
        // En este ejemplo, solo se realizó una validación básica del tipo de archivo y el tamaño máximo permitido
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($imagen->tipoArchivo, $tiposPermitidos)) {
            return "Error: El tipo de archivo no esta permitido. Deben ser archivos JPEG, PNG o JPG.";
        }

        $tamanoMaximo = 5 * 1024 * 1024; // 5 megabytes
        if ($imagen->tamanoArchivo > $tamanoMaximo) {
            return "Error: El tamaño del archivo excede el limite permitido (5MB).";
        }

        // Si la validación pasa, devuelve true
        return true;
    }
}
