<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recruitment System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Style for navigation bar */
        body{
            background-color:black;
        }
        .container {
            font-family: apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,Liberation Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;

            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color:#343a40;
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(102.57deg,#d0121e,#e41175 100%);
            padding: 15px 20px;
            color: #f2f2f2;
        }

        .navbar-left, .navbar-right {
            display: flex;
            align-items: center;
        }
        .navbar a, .search-icon {
            margin-right: 30px;
            padding: 10px 20px;
            color: #ddd;
            text-decoration: none;
        }

        .navbar-left a:hover,.search-icon:hover {
            background-color: #ccc;
            border-radius: 5px;
            color: #d0121e;
        }

        /* Style for job list */
        .job-list {
            list-style-type: none;
            padding: 0;
        }

        .job-item {
            margin-bottom: 20px;
            text-align: left;
        }

        .job-title {
            font-weight: bold;
            font-size: 18px;
        }

        .job-description {
            margin-top: 5px;
        }

        .apply-btn {
            background: linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transform: all 0.5s;
        }

        .apply-btn:hover {
            box-shadow: 0 0 20px #e41175;
        }

        .container {
            text-align: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .user-profile img {
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }
        .popup-menu {
            display: none;
            position: absolute;
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
            top: 40px;
            right: 0;
            z-index: 1;
        }

        .menu-item:hover {
            color: #e41175;
            cursor: pointer;
        }

        .popup-menu a{
            text-decoration: none;
        }

        .search-container {
            display: none;
            position: relative;
            align-items: center;
        }
        .search-box {
            width: 250px; /* Increased width */
            padding: 10px;
            border: 2px solid black;
            border-radius: 5px;
            margin-left: -20px; /* Adjust as necessary */
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="a.php">Home</a>
            <a href="myapplication.php">My Application Form</a>
            <a href="currentjobs.php">Current Jobs</a>
            <a href="contact.php">Contact</a>
            <a href="appled for.php">Applied For</a>
            <div class="search-icon"><i class="fas fa-search"></i></div>
            <div class="search-container">
                <input type="text" class="search-box" placeholder="Search...">
            </div>
        </div>
        <div class="navbar-right">
            <div class="user-profile" id="userProfile">
                <img src="https://pluspng.com/img-png/png-user-icon-circled-user-icon-2240.png" alt="usericon">
                <div class="user-name">Profile</div>
                <div class="popup-menu" id="popupMenu">
                    <a href="account1.php"><div class="menu-item">View Profile</div></a>
                    <a href="logout1.php"><div class="menu-item" id="logout">Logout</div></a>
                </div>
            </div>
        </div>
    </div>
    <section id="currentjobs">
        <div class="container">
            <h2>Current Job Opportunities</h2>
            <ul class="job-list">
            <?php
            // Include database connection file
            include 'database.php';

            // Fetch job details from the database
            $sql = "SELECT * FROM jobdescription";
            $result = mysqli_query($conn, $sql);

            // Check if there are any jobs in the database
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="job-item">';
                    echo '<h2 class="job-title">' . $row['jobtitle'] . '</h2>';
                    echo '<h4>Company: ' . $row['companyname'] . '</h4>';
                    echo '<p>Salary: ' . $row['salary'] . '</p>';
                    echo '<p>Experience: ' . $row['experience'] . '</p>';
                    echo '<p class="job-description">Description: ' . $row['description'] . '</p>';
                    // Form with hidden input for job_id
                    echo '<form action="apply_job.php" method="post">';
                    echo '<input type="hidden" name="job_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" class="apply-btn">Apply Job</button>';
                    echo '</form>';
                    echo '</li>';
                }
            } else {
                echo '<li>No jobs found.</li>';
            }

            // Close database connection
            mysqli_close($conn);
            ?>
            </ul>
        </div>
    </section>

    <script>
        // Function to toggle visibility of popup-menu
        function toggleMenu() {
            var menu = document.getElementById("popupMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // Add event listener to user-profile for click event
        document.getElementById("userProfile").addEventListener("click", function(event) {
            toggleMenu();
            event.stopPropagation(); // Prevent default behavior of the click event
        });

        // Close the menu if the user clicks outside of it
        window.addEventListener("click", function(event) {
            var menu = document.getElementById("popupMenu");
            if (event.target != menu && event.target.parentNode != menu && event.target.parentNode.parentNode != menu) {
                menu.style.display = "none";
            }
        });
    </script>
</body>
</html>
