<?php
$host = 'localhost';
$dbname = 'contacts';
$username = 'root';
$password = '8AdnLvnMxn8!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $message = $data['message'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';

    $sql = "INSERT INTO contact (name, email, message, ip, created_at) VALUES (:name, :email, :message. :ip, NOW())";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message, 'ip' => $ip]);
        echo "Merci, votre message a bien été envoyé.";
    } catch (PDOException $pe) {
        die("Could not send message: " . $pe->getMessage());
    }
}

?>