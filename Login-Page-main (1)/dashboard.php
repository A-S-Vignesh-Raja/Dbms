<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($con, $email);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        header("Location: index.php?error=duplicate");
        exit;
    } else {
        // Insert the user into the database
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        if (mysqli_query($con, $sql)) {
            header("Location: signin.html");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>
