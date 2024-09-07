<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: black;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            overflow: hidden;

            /* Add linear gradient border */
            border: 5px solid transparent; /* Set border width and make it transparent */
            border-image: linear-gradient(102.57deg,#d0121e,#e41175 100%,#e41175 0); /* Define the linear gradient */
            border-image-slice: 1; /* Ensure entire border is covered by gradient */
        }

        .contact-details {
            background-color: #333;
            color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            margin: 20px 0;
            height: 400px;
            overflow-y: auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        .contact-details p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="contact-details">
            <h2>Contact Details</h2>
            <p><strong>Comapny Name:</strong> Recruit Hub</p>
            <p><strong>Email:</strong> recruithub@com</p>
            <p><strong>Phone:</strong> +098765432</p>
            <p><strong>Address:</strong> 123 Main Street, Kochi, India</p>
        </div>
    </div>
</body>
</html>
