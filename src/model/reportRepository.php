<?php
// Interfaz del Repositorio
interface ReportRepositoryInterface {
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}

// Clase de Repositorio Concreto
class ReportRepository implements ReportRepositoryInterface {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll() {
        // Implementar lógica para obtener todos los usuarios
        // $sql = "SELECT * FROM REPORTE";
        $sql = "SELECT l.nombre AS nombre_linea, e.nombre AS nombre_estacion, p.nombre AS nombre_planta, r.comentario
        FROM reporte r
        INNER JOIN linea l ON r.linea_id = l.id
        INNER JOIN estacion e ON r.estacion_id = e.id
        INNER JOIN planta p ON r.planta_id = p.id";
        $statement = $this->db->query($sql);
        $resultados = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function findById($id) {
        // Implementar lógica para buscar un usuario por ID
    }

    public function create(array $data) {
        // Implementar lógica para insertar un nuevo usuario
        $sql = "INSERT INTO reporte (planta_id, linea_id, estacion_id, comentario, path_imagen) VALUES (:planta_id, :linea_id, :estacion_id, :comentario, :path_imagen)";
    $statement = $this->db->prepare($sql);
    $statement->execute([
        ':planta_id' => $data['planta_id'],
        ':linea_id' => $data['linea_id'],
        ':estacion_id' => $data['estacion_id'],
        ':comentario' => $data['comentario'],
        ':path_imagen' => $data['path_imagen']
    ]);
    }

    public function update($id, array $data) {
        // Implementar lógica para actualizar un usuario
    }

    public function delete($id) {
        // Implementar lógica para eliminar un usuario
    }
}

// // Uso del Repositorio
// $db = new mysqli('localhost', 'usuario', 'contraseña', 'nombre_basedatos');
// $userRepository = new UserRepository($db);

// // Ejemplo de uso
// $users = $userRepository->findAll();
// $user = $userRepository->findById(1);
// $userRepository->create(['name' => 'John Doe', 'email' => 'john@example.com']);
// $userRepository->update(1, ['name' => 'Jane Doe']);
// $userRepository->delete(2);
