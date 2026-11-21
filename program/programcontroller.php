<?php
include '../model/db.php';

class ProgramController {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all programs for a given institute
    public function getProgramsByInstitute($institute_id) {
        $institute_id = intval($institute_id);
        $sql = "SELECT * FROM programs WHERE institute_id=$institute_id";
        $result = $this->conn->query($sql);

        $programs = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $programs[] = $row;
            }
        }
        return $programs;
    }

    // Fetch a single program by id
    public function getProgramById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM programs WHERE id=$id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    // Add a new program
    public function addProgram($data) {
        $name = $this->conn->real_escape_string($data['name']);
        $description = $this->conn->real_escape_string($data['description']);
        $fees = floatval($data['fees']);
        $duration = intval($data['duration']);
        $qualification = $this->conn->real_escape_string($data['qualification_required']);
        $institute_id = intval($data['institute_id']);

        $sql = "INSERT INTO programs (name, description, fees, duration, qualification_required, institute_id) 
                VALUES ('$name','$description','$fees','$duration','$qualification','$institute_id')";
        return $this->conn->query($sql);
    }

    // Update program
    public function updateProgram($id, $data) {
        $id = intval($id);
        $name = $this->conn->real_escape_string($data['name']);
        $description = $this->conn->real_escape_string($data['description']);
        $fees = floatval($data['fees']);
        $duration = intval($data['duration']);
        $qualification = $this->conn->real_escape_string($data['qualification_required']);

        $sql = "UPDATE programs SET 
                name='$name',
                description='$description',
                fees='$fees',
                duration='$duration',
                qualification_required='$qualification'
                WHERE id=$id";
        return $this->conn->query($sql);
    }

    // Delete program
    public function deleteProgram($id) {
        $id = intval($id);
        $sql = "DELETE FROM programs WHERE id=$id";
        return $this->conn->query($sql);
    }
}

// Usage example
$programController = new ProgramController($conn);

// Fetch programs for public view
if (isset($_GET['institute_id'])) {
    $programs = $programController->getProgramsByInstitute($_GET['institute_id']);
}
?>
