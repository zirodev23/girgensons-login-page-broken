<?php

$conn = new mysqli('localhost', 'root', '', 'user_database');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$email = $GET['email'] ?? '';
$password = $GET['password'] ?? '';

if (isset($GET['register'])) {

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . ($conn->errno == 1072 ? "Email already registered." : $conn->error);
    }
} elseif (isset($GET['login'])) {

    $sql = "";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Invalid password.";
        } else {
            echo "Login successful!";
        }
    } else {
        echo "No user found with that email.";
    }
}

$conn->close();
?>
