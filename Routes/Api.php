<?php

header("Content-Type: application/json");
require_once __DIR__ . '/../src/Config/database.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/')); // Divide la URL en partes
$resource = $requestUri[1] ?? ''; // Obtiene la segunda parte de la URL después de 'api'
$id = $requestUri[2] ?? null; // ID opcional para métodos como GET, PUT y DELETE

$userController = new UserController();

if ($resource === 'api' && isset($requestUri[2]) && $requestUri[2] === 'users') {
    switch ($requestMethod) {
        case 'GET': // Obtener un usuario o lista de usuarios
            if ($id) {
                echo json_encode($userController->getUser($id));
            } else {
                echo json_encode($userController->getAllUsers());
            }
            break;
            
        case 'POST': // Crear un usuario
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($userController->createUser($data));
            break;

        case 'PUT': // Actualizar usuario
            if ($id) {
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($userController->updateUser($id, $data));
            } else {
                echo json_encode(["error" => "ID de usuario requerido"]);
            }
            break;

        case 'DELETE': // Eliminar usuario
            if ($id) {
                echo json_encode($userController->deleteUser($id));
            } else {
                echo json_encode(["error" => "ID de usuario requerido"]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
}

?>
