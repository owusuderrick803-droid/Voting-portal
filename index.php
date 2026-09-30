<?php
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

    // Check if ID already exists
    $check = "SELECT * FROM students WHERE index_number = '$index_number'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        $message = "This ID is already registered.";
    } else {
        // Insert the new student ID
        $sql = "INSERT INTO students (index_number) VALUES ('$index_number')";
        if (mysqli_query($conn, $sql)) {
            $message = "Student ID registered successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPSA voting site</title>
    <link rel="stylesheet" href="voters.css">
    <link rel="icon" type="image/x-icon" href="upsa-favi.png">
</head>
<body>

    <form method="POST" action="index.php">
        <img class="form-logo" src="upsa-favi.png" alt="UPSA logo">

        <?php if (isset($message)) { echo "<p style='color:green;'>$message</p>"; } ?>

        <label for="index_number">Enter your Student ID:</label>
        <input type="text" id="index_number" name="index_number" maxlength="8" placeholder="Enter Index Number">
        <button type="submit">Submit</button>
    </form>

    <footer>UPSA Voting Site &copy; 2023</footer>

</body>
</html>