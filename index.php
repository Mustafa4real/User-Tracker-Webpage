<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'info';

// Connection to the database
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insertion on the form submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = (int)$_POST['age'];
    if (!empty($name) && $age > 0) {
        $stmt = $conn->prepare("INSERT INTO user (name, age) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $age);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetching all users
$result = $conn->query("SELECT * FROM user ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>User Info Form</h2>
    <form method="POST" class="form-inline">
        Name: <input type="text" name="name" required>
        Age: <input type="number" name="age" required min="1">
        <input type="submit" name="submit" value="Submit">
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody id="userTable">
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr id="row-<?php echo $row['id']; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td class="status"><?php echo $row['status']; ?></td>
                    <td><button onclick="toggleStatus(<?php echo $row['id']; ?>)">Toggle</button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        function toggleStatus(userId) {
            fetch("toggle.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + userId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = document.getElementById("row-" + userId);
                    row.querySelector(".status").innerText = data.newStatus;
                }
            });
        }
    </script>
</body>
</html>
