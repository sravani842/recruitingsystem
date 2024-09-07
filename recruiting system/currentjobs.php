<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted Jobs</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }

        .job-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .job-card {
            background-color: #333;
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);

            /* Add linear gradient border */
            border: 5px solid transparent; /* Set border width and make it transparent */
            border-image: linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0); /* Define the linear gradient */
            border-image-slice: 1; /* Ensure entire border is covered by gradient */
        }

        h1 {
            text-align: center;
        }

        .apply-job-btn {
            background: linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .apply-job-btn:hover {
            background:linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0);
        }
    </style>
</head>
<body>
    <h1>Current Job Openings</h1>

    <?php
    session_start();
    include 'database.php';

    if (!isset($_SESSION['user'])) {
        header("Location: login1.php");
        exit;
    }

    $sql = "SELECT * FROM jobdescription";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Query failed, handle the error
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="job-container">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="job-card" id="job_' . $row['id'] . '">';
            echo '<h2>' . $row['jobtitle'] . '</h2>';
            echo '<h4>Company: ' . $row['companyname'] . '</h4>';
            echo '<p>Salary: ' . $row['salary'] . '</p>';
            echo '<p>Experience: ' . $row['experience'] . '</p>';
            echo '<p>Description: ' . $row['description'] . '</p>';
            // Form with hidden input for job_id
            echo '<form action="apply_job.php" method="post">';
            echo '<input type="hidden" name="job_id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="apply-job-btn">Apply Job</button>';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No posted jobs found.";
    }
    ?>

    <!-- Add your JavaScript here if needed -->
</body>
</html>
