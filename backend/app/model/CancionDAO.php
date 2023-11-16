<?php
class CancionDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCanciones() {
        $query = "SELECT * FROM canciones";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCancionById($id) {
        $query = "SELECT * FROM canciones WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertCancion($cancion) {
        $query = "INSERT INTO canciones (titulo, artista) VALUES (:titulo, :artista)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':titulo', $cancion->getTitulo());
        $stmt->bindParam(':artista', $cancion->getArtista());
        $stmt->execute();
    }

    public function updateCancion($cancion) {
        $query = "UPDATE canciones SET titulo = :titulo, artista = :artista WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $cancion->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $cancion->getTitulo());
        $stmt->bindParam(':artista', $cancion->getArtista());
        return $stmt->execute();
    }

    public function deleteCancion($id) {
        $query = "DELETE FROM canciones WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
