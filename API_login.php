<?php
include 'conection.php';
header('Access-Control-Allow-Origin: http://localhost:8081');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-Type: application/json; charset=utf-8');
$data = file_get_contents("php://input");
$data = json_decode($data);
if (isset($data)) {
    $email = $data->email;
    $password = $data->password;

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, return success message

        echo json_encode(["message" => "Login successful." ]);
    } else {
        // User not found, return error message
        echo json_encode(["message" => "Invalid email or password."]);
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo json_encode(["message" => "No data received."]);
    
}
?>