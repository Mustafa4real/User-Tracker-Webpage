<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'info';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "DB connection failed."]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    $result = $conn->query("SELECT status FROM user WHERE id = $id");
    if ($result && $row = $result->fetch_assoc()) {
        $newStatus = $row['status'] == 1 ? 0 : 1;
        $conn->query("UPDATE user SET status = $newStatus WHERE id = $id");
        echo json_encode(["success" => true, "newStatus" => $newStatus]);
    } else {
        echo json_encode(["success" => false, "error" => "User not found."]);
    }
}
?>
