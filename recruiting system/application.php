<?php
session_start();

include 'database.php'; 

if (!isset($_SESSION['user'])) {
    header("Location: login.php"); 
    exit;
}

// Fetch job ID from the job description table
$sql_job_id = "SELECT id FROM jobdescription";
$result_job_id = mysqli_query($conn, $sql_job_id);

if (!$result_job_id) {
    echo "Error fetching job ID: " . mysqli_error($conn);
    exit;
}

$row_job_id = mysqli_fetch_assoc($result_job_id);
$jobId = $row_job_id['id'];

// Query to fetch application details for the specified job ID
$sql = "SELECT *
        FROM applications
        WHERE job_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $jobId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: black; /* Set the background color of the body to black */
    color: white; /* Set the text color to white */
}

.application-container {
    margin-top: 20px;
}

.application-card {
    background-color: #333; /* Set the background color of the application containers to gray */
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.application-card h2 {
    margin-top: 0;
    color: #007bff; /* Set the color of h2 elements to blue */
}

.application-card p {
    margin-bottom: 10px;
    color: white; /* Set the color of paragraphs to white */
}

    </style>
</head>
<body>

<h1>Application Details for Job ID: <?php echo $jobId; ?></h1>

<div class="application-container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="application-card">';
            echo '<h2 style="background: linear-gradient(102.57deg, #d0121e, #e41175); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">' . $row['job_id'] . '</h2>';
 // Assuming you want to display job_id
            echo '<p>Name: ' . $row['firstname'] . ' ' . $row['lastname'] . '</p>';
            echo '<p>Email: ' . $row['email'] . '</p>';
            echo '<p>Phone: ' . $row['phoneno'] . '</p>';
            echo '<p>Experience: ' . $row['experience'] . '</p>';
            echo '<p>Skills: ' . $row['skills'] . '</p>';
            echo '<p>Resume: <a href="uploads/' . $row['resume'] . '" download style="background: linear-gradient(102.57deg, #d0121e, #e41175); color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Download ' . $row['resume'] . '</a></p>';


            // Add more details as needed
            echo '</div>';
        }
    } else {
        echo "No applications found for this job.";
    }
    ?>
</div>

</body>
</html>
