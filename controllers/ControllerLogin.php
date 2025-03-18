<?php
session_start(); // Inicia la sesión

require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload para las dependencias
require_once __DIR__ . '/../controllers/ControllerJWT.php';  // Incluir el controlador JWT
require_once __DIR__ . '/../controllers/ControllerCookie.php'; // Incluir el controlador de cookies
require_once __DIR__ . '/../controllers/ControllerTwig.php'; // Controlador para las vistas (asumido)

// Lógica para manejar el inicio de sesión
function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        // Obtener el usuario desde la base de datos
        $usuario = Usuarios::obtenerPorCorreo($correo);

        // Verificar la contraseña y si existe el usuario
        if ($usuario && password_verify($contraseña, $usuario['contraseña_hash'])) {
            // Generar el JWT
           // Generar JWT cuando el usuario inicia sesión
        $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

        // Crear el payload con la información del usuario
        $payload = [
        'sub' => $usuario['id'],  // Puede ser el ID o el correo del usuario
        'exp' => time() + 3600  // Expira en 1 hora
    ];
            $jwt = generarJWT($header, $payload, 'mi_clave_secreta'); // Usar la clave secreta definida en el ControllerJWT

            // Guardar el JWT en la base de datos
            Usuarios::guardarToken($usuario['id'], $jwt);

            // Establecer la cookie de autenticación
            setAuthCookie($jwt, time() + 3600);  // Expiración en una hora

            // Redirigir a la página principal o a la página privada
            header('Location: /home');
            exit;
        } else {
            // Si hay un error, volvemos a mostrar el formulario de login con mensaje de error
            renderView('login.html.twig', ['error' => 'Correo o contraseña incorrectos.']);
        }
    } else {
        // Si el formulario no fue enviado, renderizamos el login
        renderView('login.html.twig');
    }
}

login(); // Ejecutar la función de login
