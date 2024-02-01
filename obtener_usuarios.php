<?php
// Conexión a la base de datos (ajusta las credenciales según tu configuración)
$servername = "localhost";

$username = "aregonet_gps";
$password = "021D*n13l_";
$dbname = "aregonet_gps";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta SQL para obtener los usuarios y sus últimas posiciones
$sql = "SELECT u.login, p.latitude, p.longitude
        FROM users u
        INNER JOIN positions p ON u.id = p.user_id
        INNER JOIN (
            SELECT user_id, MAX(id) AS max_id
            FROM positions
            GROUP BY user_id
        ) latest_positions
        ON p.user_id = latest_positions.user_id AND p.id = latest_positions.max_id";

$result = $conn->query($sql);

// Crear un array para almacenar los datos de usuario
$usersData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userData = array(
            "user" => $row["login"],
            "latitude" => $row["latitude"],
            "longitude" => $row["longitude"]
            
        );
        array_push($usersData, $userData);
    }
}

// Generar datos en formato JSON
$jsonData = json_encode($usersData);

// Cerrar la conexión a la base de datos
$conn->close();

// Configurar las cabeceras para permitir solicitudes CORS (ajusta según tu configuración)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Imprimir los datos JSON
echo $jsonData;
?>
