<?php
session_start();

if (!isset($_SESSION["index_number"])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION["index_number"];

// Destroy session after voting is complete
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - UPSA Voting</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('your-background-url.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            animation: pageFadeIn 0.8s ease-out both;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 50px 60px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            animation: cardRise 0.8s 0.15s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .checkmark {
            font-size: 80px;
            color: green;
            margin-bottom: 20px;
            animation: checkmarkPop 0.7s 0.65s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        .card h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .student-id {
            font-size: 16px;
            color: #999;
            margin-bottom: 30px;
        }

        .divider {
            border: none;
            border-top: 2px solid #eee;
            margin: 25px 0;
        }

        .message {
            font-size: 16px;
            color: #555;
            font-style: italic;
            margin-bottom: 30px;
        }

        .upsa-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            color: white;
            margin-top: 30px;
            font-size: 13px;
            animation: pageFadeIn 0.8s 0.35s ease-out both;
        }

        @keyframes pageFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes cardRise {
            from {
                opacity: 0;
                transform: translateY(28px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes checkmarkPop {
            from {
                opacity: 0;
                transform: scale(0.35) rotate(-18deg);
            }
            to {
                opacity: 1;
                transform: scale(1) rotate(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <img class="upsa-logo" src="WhatsApp Image 2025-03-27 at 18.26.18_4812eb2d.jpg" alt="UPSA Logo">
        
        <div class="checkmark">&#10003;</div>
        
        <h1>Thank You for Voting!</h1>
        
        <p>Your vote has been successfully submitted.</p>
        
        <p class="student-id">Student ID: <strong><?php echo $student_id; ?></strong></p>
        
        <hr class="divider">
        
        <p class="message">
            Your vote has been recorded and will be counted. 
            Thank you for participating in the UPSA Student Elections.
        </p>

        <p>You may now close this page.</p>
    </div>

    <footer>UPSA Voting Site &copy; 2023</footer>

</body>
</html>