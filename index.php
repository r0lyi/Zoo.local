<?php

$request = $_SERVER['REQUEST_URI'];
$controller = '/controllers/';
$apiRoutes = '/Routes/Api.php';

// Verifica si la ruta comienza con "/api/"
if (strpos($request, '/api/') === 0) {
    require __DIR__ . $apiRoutes;
    exit; // Detiene la ejecución después de cargar las rutas de la API
}

// Lógica de enrutamiento para la web
switch ($request) {
    case '':
    case '/':   
    case '/home':
        require __DIR__ . $controller . 'ControllerHome.php';
        break;
    case '/species_list':
        require __DIR__ . $controller . 'ControllerList.php';
        break;
    case '/register':
        require __DIR__ . $controller . 'ControllerRegister.php';
        break;
    case '/login':
        require __DIR__ . $controller . 'ControllerLogin.php';
        break;
    case '/perfil':
        require __DIR__ . $controller . 'ControllerPerfil.php';
        break;
    case '/adopcion':
        require __DIR__ . $controller . 'ControllerAdopcion.php';
        break;
    case '/admin':
        require __DIR__ . $controller . 'ControllerAdmin.php';
        break;
    case '/forum':
        require __DIR__ . $controller . 'ControllerForo.php';
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
?>
