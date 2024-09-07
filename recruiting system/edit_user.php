<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

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

// If form is submitted, update user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $resume = $_POST['resume'];

    // Update user details in database
    $sql = "UPDATE userdetails SET firstname=?, lastname=?, email=?, phoneno=?, country=?, city=?, pincode=?, experience=?, skills=?, resume=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssisssi", $firstname, $lastname, $email, $phoneno, $country, $city, $pincode, $experience, $skills, $resume, $user_id);
    $success = mysqli_stmt_execute($stmt);
   

    // Check if update was successful
    if ($success) {
        $message = "User details updated successfully.";
    } else {
        $error = "Error updating user details: " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            background: linear-gradient(102.57deg,#d0121e,#e41175 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        label {
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: white;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background: linear-gradient(102.57deg,#d0121e,#e41175 100%);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background: linear-gradient(102.57deg,#e41175,#d0121e 100%);
        }
    </style>
</head>
<body>
    <h1>Edit User Details</h1>

    <?php if (isset($message)): ?>
        <div><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>"><br>

        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>

        <label for="phoneno">Phone Number:</label><br>
        <input type="text" id="phoneno" name="phoneno" value="<?php echo htmlspecialchars($user['phoneno']); ?>"><br>

        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user['country']); ?>"><br>

        <label for="city">City:</label><br>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>"><br>

        <label for="pincode">Pincode:</label><br>
        <input type="text" id="pincode" name="pincode" value="<?php echo htmlspecialchars($user['pincode']); ?>"><br>

        <label for="experience">Experience:</label><br>
        <input type="number" id="experience" name="experience" value="<?php echo htmlspecialchars($user['experience']); ?>"><br>

        <label for="skills">Skills:</label><br>
        <input type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($user['skills']); ?>"><br>

        <label for="resume">Resume:</label><br>
        <input type="text" id="resume" name="resume" value="<?php echo htmlspecialchars($user['resume']); ?>"><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
