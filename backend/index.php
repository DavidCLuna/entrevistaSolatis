<?php

require_once __DIR__.'/app/db/Database.php';
require_once __DIR__.'/app/controller/CancionController.php';

// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Crear instancias necesarias 
$db = Database::getInstance();
$cancionDAO = new CancionDAO($db);
$cancionController = new CancionController($cancionDAO);

// Obtener la acción de la solicitud
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Manejar las rutas
switch ($action) {
    case 'index':
        $cancionController->index();
        break;
    case 'show':
        $id = $_GET['id'];
        $cancionController->show($id);
        break;
    case 'create':
        $cancionController->create();
        break;
    case 'store':
        // Manejar la solicitud POST para almacenar la canción
        // Recoger los datos del cuerpo de la solicitud
        $requestData = json_decode(file_get_contents("php://input"), true);

        // Validar que se hayan recibido los datos necesarios
        if (isset($requestData['titulo']) && isset($requestData['artista'])) {
            // Crear un array asociativo con los datos de la canción
            $cancionData = [
                'titulo' => $requestData['titulo'],
                'artista' => $requestData['artista']
            ];

            // Llamar al método store del controlador
            $cancionController->store($cancionData);

        } else {
            // Datos incompletos, enviar una respuesta de error
            //http_response_code(400);
            echo json_encode(['msg' => 'Datos incompletos', 'status' => 400]);
        }
        break;
    case 'edit':
        $id = $_GET['id'];
        $cancionController->edit($id);
        break;
    case 'update':
        //recibir datos mediante put
        $id = $_GET['id'];
        $requestData = json_decode(file_get_contents("php://input"), true);

        if (isset($requestData['titulo']) && isset($requestData['artista'])) {

            $cancionData = [
                'titulo' => $requestData['titulo'],
                'artista' => $requestData['artista']
            ];

            $cancionController->update($id,$cancionData);

        }else{
            echo json_encode(['msg' => 'Datos incompletos', 'status' => 400]);
        }

        break;
    case 'destroy':
        $id = $_GET['id'];
        $cancionController->destroy($id);
        break;
    default:
        http_response_code(404);
        echo json_encode(['msg' => 'Ruta no encontrada','status'=>404]);
        break;
}
?>
