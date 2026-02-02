<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $streetaddress = htmlspecialchars($_POST['streetaddress'] ?? '');
    $line = htmlspecialchars($_POST['line'] ?? '');
    $city = htmlspecialchars($_POST['city'] ?? '');
    $state = htmlspecialchars($_POST['state'] ?? '');
    $zip = htmlspecialchars($_POST['zip'] ?? '');
    $country = htmlspecialchars($_POST['country'] ?? '');

    if(empty($streetaddress) || empty($city) || empty($state) || empty($zip) || empty($country)) {
        echo "Please fill in all required fields.";
        exit;
    }

    $conn = new mysqli("localhost", "root", "", "booking");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO guests (streetaddress, line, city, state, zip, country) VALUES (?, ?, ?, ?, ?, ?)");
    if(!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $streetaddress, $line, $city, $state, $zip, $country);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful!</h2><p>Thank you for registering, your details have been saved.</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Form not submitted correctly.";
}
?>