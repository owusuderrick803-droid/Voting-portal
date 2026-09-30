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

if (!isset($_SESSION["index_number"])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION["index_number"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate_id = $_POST["candidate"];
    $sql = "INSERT INTO financial_secretary_votes (student_id, candidate_id) VALUES ('$student_id', '$candidate_id')";
    if (mysqli_query($conn, $sql)) {
        header("Location: electoral_commissioner.php");
        exit();
    }
}

$sql = "SELECT * FROM financial_secretary_candidates";
$result = mysqli_query($conn, $sql);
$candidates = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="upsa-favi.png">
    <title>Vote - Financial Secretary</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://upsa.edu.gh/wp-content/uploads/2021/06/campus-13.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 30px 30px 100px;
        }
        .page-title { text-align: center; color: darkblue; font-size: 36px; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; }
        .position-title { text-align: center; color: #FFD700; font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .subtitle { text-align: center; color: #ddd; margin-bottom: 10px; font-size: 15px; }
        .progress { text-align: center; color: #aaa; margin-bottom: 30px; font-size: 13px; }
        .instruction { text-align: center; color: #FFD700; font-size: 15px; margin-bottom: 25px; font-style: italic; }
        .candidates-row { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-bottom: 30px; }
        .candidate-card { background-color: rgba(255,255,255,0.95); border-radius: 12px; padding: 15px; text-align: center; width: 240px; box-shadow: 0 8px 24px rgba(0,0,0,0.25); transition: transform 0.2s, border 0.2s; border: 2px solid transparent; }
        .candidate-card:hover { transform: scale(1.01); border-color: #007bff; }
        .candidate-card img { width: 180px; height: 180px; object-fit: cover; border-radius: 10px; background-color: #eee; display: block; margin: 0 auto; }
        .candidate-card h3 { margin-top: 12px; font-size: 18px; color: #333; }
        .radio-label { display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13px; font-weight: bold; cursor: pointer; color: #007bff; padding: 8px 10px; border-radius: 8px; background-color: #f0f7ff; margin-top: 10px; }
        .radio-label input[type="radio"] { transform: scale(1.2); cursor: pointer; accent-color: #007bff; }
        .next-btn { display: block; margin: 0 auto; padding: 15px 60px; background-color: #007bff; color: white; border: none; border-radius: 10px; font-size: 20px; cursor: pointer; transition: background-color 0.3s; }
        .next-btn:hover { background-color: #0a396bb9; }
        footer {
            position: fixed;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 100vw;
            box-sizing: border-box;
            padding: 15px 0;
            background-color: rgba(0, 0, 0, 0.75);
            color: #ddd;
            text-align: center;
            font-size: 13px;
            border-top: 1px solid rgba(255, 255, 255, 0.25);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }
    </style>
</head>
<body>
    <h1 class="page-title">UPSA Student Voting</h1>
    <p class="position-title">Financial Secretary</p>
    <p class="instruction">Select only ONE candidate then click Next</p>

    <form method="POST" action="financial_secretary.php">
        <div class="candidates-row">
            <?php foreach ($candidates as $candidate): ?>
            <div class="candidate-card">
                <img src="finsec_images/<?php echo $candidate['photo']; ?>" alt="<?php echo $candidate['candidate_name']; ?>">
                <h3><?php echo $candidate['candidate_name']; ?></h3>
                <label class="radio-label">
                    <input type="radio" name="candidate" value="<?php echo $candidate['candidate_id']; ?>" required>
                    Vote for this candidate
                </label>
            </div>
            <?php endforeach; ?>

            <div class="candidate-card">
                <img src="images/candidate2.jpg" alt="Jane Doe">
                <h3>Jane Doe</h3>
                <label class="radio-label">
                    <input type="radio" name="candidate" value="999" required>
                    Vote for this candidate
                </label>
            </div>
        </div>
        <button type="submit" class="next-btn">Next &rarr;</button>
    </form>

    <footer>UPSA Voting Site &copy; 2023</footer>
</body>
</html>