<?php
session_start();

$host = "localhost";
$dbname = "voting_system";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $index_number = $_POST["index_number"];

    $sql = "SELECT * FROM students WHERE index_number = '$index_number'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["index_number"] = $index_number;
        header("Location: president.php");
        exit();
    } else {
        $error = "ID not found. Please register first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPSA Student Login</title>
    <link rel="stylesheet" href="voters.css">
    <link rel="icon" type="image/x-icon" href="upsa-favi.png">

</head>
<body>

    <form method="POST" action="login.php">
        <img class="form-logo" src="upsa-favi.png" alt="UPSA logo">

        <h2>Student Login</h2>

        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <label for="index_number">Enter your Student ID:</label>
        <input type="text" id="index_number" name="index_number" maxlength="8" placeholder="Enter Index Number" required>
        <button type="submit">Login</button>
    </form>

    <footer>UPSA Voting Site &copy; 2023</footer>

</body>
</html>