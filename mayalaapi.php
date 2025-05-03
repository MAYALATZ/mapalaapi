<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection simulation
class Database {
    private $students = [
        ['id' => 1, 'name' => 'John Doe', 'age' => 20, 'grade' => 'A', 'email' => 'john@example.com'],
        ['id' => 2, 'name' => 'Jane Smith', 'age' => 21, 'grade' => 'B', 'email' => 'jane@example.com'],
        ['id' => 3, 'name' => 'Mike Johnson', 'age' => 19, 'grade' => 'A', 'email' => 'mike@example.com'],
        ['id' => 4, 'name' => 'Sarah Williams', 'age' => 22, 'grade' => 'C', 'email' => 'sarah@example.com'],
        ['id' => 5, 'name' => 'Tom Brown', 'age' => 20, 'grade' => 'B', 'email' => 'tom@example.com']
    ];

    private $subjects = [
        ['id' => 1, 'name' => 'Mathematics', 'credits' => 4, 'professor' => 'Dr. Smith', 'room' => '101'],
        ['id' => 2, 'name' => 'Physics', 'credits' => 3, 'professor' => 'Dr. Johnson', 'room' => '202'],
        ['id' => 3, 'name' => 'Chemistry', 'credits' => 4, 'professor' => 'Dr. Williams', 'room' => '303'],
        ['id' => 4, 'name' => 'Biology', 'credits' => 3, 'professor' => 'Dr. Brown', 'room' => '404'],
        ['id' => 5, 'name' => 'Computer Science', 'credits' => 4, 'professor' => 'Dr. Davis', 'room' => '505']
    ];

    public function getStudents() {
        return $this->students;
    }

    public function getSubjects() {
        return $this->subjects;
    }
}

$database = new Database();
$request_method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path_parts = explode('/', trim($path, '/'));
$endpoint = $path_parts[count($path_parts) - 1];

switch($request_method) {
    case 'GET':
        if ($endpoint === 'students') {
            echo json_encode([
                'status' => 'success',
                'data' => $database->getStudents()
            ]);
        }
        elseif ($endpoint === 'subjects') {
            echo json_encode([
                'status' => 'success',
                'data' => $database->getSubjects()
            ]);
        }
        else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid endpoint'
            ]);
        }
        break;
    
    default:
        echo json_encode([
            'status' => 'error',
            'message' => 'Method not allowed'
        ]);
        break;
}
?>