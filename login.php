<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "portaldb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT * FROM usertbl WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password. Please try again.";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>