<?php
session_start();
include 'database.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login1.php");
    exit;
}

// Fetch user details based on session user ID
$user_id = $_SESSION['user'];
$sql = "SELECT * FROM userdetails WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if user details are found
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Redirect if user details not found
    header("Location: login1.php");
    exit;
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
    <style>
        body{
            background-color: black;
            color:white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            background-color: #333;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        h1, h2 {
            background: linear-gradient(102.57deg,#d0121e,#e41175 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            color: #fff;
            text-decoration: none;
            background-color: #e41175;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            background-color: #d0121e;
        }
        </style>
    <!-- Add your CSS styles here -->
</head>
<body>
    <h1>Welcome <?php echo $user['firstname']; ?>!</h1>

    <h2>User Details:</h2>
    <ul>
        <?php if ($user): ?>
            <li>ID: <?php echo $user['id']; ?></li>
            <li>Name: <?php echo $user['firstname'] . ' ' . $user['lastname']; ?></li>
            <li>Email: <?php echo $user['email']; ?></li>
            <li>Phone: <?php echo $user['phoneno']; ?></li>
            <li>Country: <?php echo $user['country']; ?></li>
            <li>City: <?php echo $user['city']; ?></li>
            <li>Pincode: <?php echo $user['pincode']; ?></li>
            <li>Experience: <?php echo $user['experience']; ?></li>
            <li>Skills: <?php echo $user['skills']; ?></li>
            <li>Resume: <?php echo $user['resume']; ?></li>
        <?php else: ?>
            <li>No user details found.</li>
        <?php endif; ?>
    </ul>

    <a href="edit_user.php">Edit User Details</a>
</body>
</html>