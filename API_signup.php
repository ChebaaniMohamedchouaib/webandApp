<?php

include 'conection.php';
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-Type: application/json; charset=utf-8');
$data = file_get_contents("php://input");
$data = json_decode($data);
if (isset($data)){
    $sql = "INSERT INTO user (`user_name`, `email`, `password` ,`age` ,`weigth`) VALUES ('$data->name', '$data->email', '$data->password' ,'$data->age' ,'$data->weight')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $data = json_encode(["message" => "User registered successfully."]);
    } else {
        $data = json_encode([ "message" => "Error registering user: "]);
    }
    echo $data;
}
else {
    echo json_encode(["message" => "No data received."]);
}
$conn->close();
?>