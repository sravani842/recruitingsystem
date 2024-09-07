<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Applied Jobs</title>
<style>
    body {
        background-color: black;
        color: white;
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    .job-container {
        background-color: #333;
        padding: 20px;
        margin-bottom: 20px;
        border: 5px solid; /* Set initial border */
        border-image:linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0); /* Define linear gradient for border */
        border-image-slice: 1; /* Ensure entire border is covered by gradient */
    }
    .job-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .job-description {
        margin-bottom: 10px;
    }
    .job-detail {
        font-style: italic;
    }
    .check-status-button {
        margin-top: 10px;
    }
    .check-status-button a {
        text-decoration: none; /* Remove underline from the link */
        color: white; /* Set link color */
        background:linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0); /* Button background color */
        padding: 5px 10px; /* Padding for the button */
        border-radius: 5px; /* Rounded corners for the button */
        display: inline-block; /* Display button inline */
    }
</style>
</head>
<body>
<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user'])) {
    header("Location: login1.php");
    exit;
}

// Prepare the SQL query to retrieve job descriptions based on user's applied jobs
$sql = "SELECT jobdescription.*
        FROM applications
        JOIN jobdescription ON applications.job_id = jobdescription.id
        WHERE applications.user_id = ?";

// Prepare the SQL statement
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare statement failed: " . mysqli_error($conn));
}

// Bind parameters and execute the statement
$user_id = $_SESSION['user'];
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

// Get the result set
$result = mysqli_stmt_get_result($stmt);

// Check if there are any job descriptions
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        // Output job details within a container
        echo '<div class="job-container">';
        echo '<div class="job-title">' . $row["jobtitle"] . '</div>';
        echo '<div class="job-description">' . $row["description"] . '</div>';
        echo '<div class="job-detail">Salary: ' . $row["salary"] . '</div>';
        echo '<div class="job-detail">Experience: ' . $row["experience"] . '</div>';
        echo '<div class="check-status-button"><a href="status.php">Check Status</a></div>';
        echo '</div>';
    }
} else {
    echo "No job descriptions found for the user.";
}

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
</body>
</html>
