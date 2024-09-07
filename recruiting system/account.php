<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

$user_id = $_SESSION["user"];

$sql = "SELECT * FROM recruitdetails WHERE id = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- <style>

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #1e2022;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #52616b;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #ddd;
    }

    .hr-details {
        margin-bottom: 20px;
        color: #ddd;
    }

    .hr-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .hr-details th, .hr-details td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .hr-details th {
        background:linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0); 
    }

</style> -->
<style>
        body {
            background-color: black; /* Set background color to black */
            color: white; /* Set text color to white */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #343a40; /* Set account details form background color to grey */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .list-group-item {
            background-color: #343a40; /* Set list group item background color to match container */
            border: none;
            background:linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0);
            width: 750px;

        }

        .list-group-item strong {
            color: whitesmoke; 
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">User Account Details</h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Company:</strong> <?php echo $row['companyname']; ?></li>
                    <li class="list-group-item"><strong>Employee Name:</strong> <?php echo $row['emp_name']; ?></li>
                    <li class="list-group-item"><strong>Employee ID:</strong> <?php echo $row['emp_id']; ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo $row['email']; ?></li>
                    <li class="list-group-item"><strong>Department:</strong> <?php echo $row['dept']; ?></li>
                    <li class="list-group-item"><strong>Phone:</strong> <?php echo $row['phone']; ?></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
