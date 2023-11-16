<?php

require_once __DIR__.'/../model/Cancion.php';
require_once __DIR__.'/../model/CancionDAO.php';

class CancionController {
    private $cancionDAO;

    public function __construct($cancionDAO) {
        $this->cancionDAO = $cancionDAO;
    }

    public function index() {
        // Retorna la lista de canciones en formato JSON con un código de estado 200 (OK)
        $canciones = $this->cancionDAO->getAllCanciones();
        //http_response_code(200);
        echo json_encode(["data"=>$canciones,"status"=>200]);
    }

    public function show($id) {
        // Retorna los detalles de una canción específica en formato JSON con un código de estado 200 (OK)
        $cancion = $this->cancionDAO->getCancionById($id);

        if ($cancion) {
            http_response_code(200);
            echo json_encode(["data"=>$cancion,"status"=>200]);
        } else {
            // Retorna un mensaje de error y un código de estado 404 (Not Found) si la canción no existe
            http_response_code(404);
            echo json_encode(['msg' => 'Cancion no encontrada','status'=>404]);
        }
    }

    public function store($data) {
        // Almacena una nueva canción en la base de datos y retorna la nueva canción en formato JSON con un código de estado 201 (Created)
        $cancion = new Cancion();
        $cancion->setTitulo($data['titulo']);
        $cancion->setArtista($data['artista']);

        $this->cancionDAO->insertCancion($cancion);

        //$newCancion = $this->cancionDAO->getCancionById($id);

        http_response_code(201);
        echo json_encode(["msg"=> "Cancion registrada con exito","status"=>201]);
    }

    public function update($id, $data) {
        // Actualiza una canción en la base de datos y retorna la canción actualizada en formato JSON con un código de estado 200 (OK)
        $cancion = new Cancion();
        $cancion->setId($id);
        $cancion->setTitulo($data['titulo']);
        $cancion->setArtista($data['artista']);

        if ($this->cancionDAO->updateCancion($cancion)) {
            echo json_encode(["msg"=>"Cancion actualizada con exito","status"=>200]);
        } else {
            // Retorna un mensaje de error y un código de estado 404 (Not Found) si la canción no existe
            echo json_encode(['msg' => 'Cancion no encontrada','status'=>404]);
        }
    }

    public function destroy($id) {
        // Elimina una canción de la base de datos y retorna un mensaje de éxito en formato JSON con un código de estado 204 (No Content)
        if ($this->cancionDAO->deleteCancion($id)) {
            echo json_encode(['msg' => 'Cancion eliminada con exito','status'=>204]);
        } else {
            // Retorna un mensaje de error y un código de estado 404 (Not Found) si la canción no existe
            echo json_encode(['msg' => 'Cancion no encontrada','status'=>404]);
        }
    }
}
?>
