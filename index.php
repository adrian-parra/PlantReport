<?php

// Enrutamiento simple basado en la URL
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Creamos el controlador y llamamos al método correspondiente
switch ($action) {
    case 'index':
        require 'src/view/reportView.php';
        break;
        case 'listado':
        require 'src/view/reportView.php';
        break;
    default:
        // Página no encontrada o acción no válida
        echo 'Error 404 - Página no encontrada';
        break;
} 
