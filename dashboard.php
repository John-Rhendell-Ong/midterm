<?php
session_start(); // Start the session to manage user data

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_email'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit(); // Make sure no further code is executed after the redirect
}

$userEmail = $_SESSION['user_email']; // Get the logged-in user's email
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* CSS Variables for easy adjustments */
        :root {
            --container-width: 90vw;
            --container-padding: 2vh;
            --card-width: 35%;
            --card-padding: 3vh;
            --card-gap: 3vw;
            --header-margin: 3vh;
            --font-family: Arial, sans-serif;
            --bg-color: #f9f9f9;
            --card-bg-color: #fff;
            --text-color: #333;
            --subtext-color: #666;
            --primary-color: #007bff;
            --primary-hover: #0056b3;
            --danger-color: #ff4d4d;
            --danger-hover: #d63636;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-family);
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--bg-color);
        }

        .container {
            width: var(--container-width);
            padding: var(--container-padding);
            text-align: center;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--header-margin);
            margin-left: 20px;
        }

        header h1 {
            font-size: 2.5em;
            color: black;
        }

        .logout-button {
            padding: 15px 20px;
            background-color: var(--danger-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 15px;
        }

        .logout-button:hover {
            background-color: var(--danger-hover);
        }

        .card-container {
            display: flex;
            gap: var(--card-gap);
            justify-content: center;
            flex-wrap: wrap; /* Allows cards to wrap on smaller screens */
        }

        /* Global card styling (applies to both cards) */
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: var(--card-padding);
            width: 800px;  /* You can adjust the width here */
            height: 250px; /* You can adjust the height here */
            text-align: center;
            background-color: var(--card-bg-color);
        }

        /* Styling for Add a Subject card */
        .card.add-subject h2 {
            background-color: whitesmoke; /* Light yellow background */
            padding: 30px;
            border-radius: 5px;
            margin-left: -28.1px;
            margin-right: -28.1px;
            margin-top: -29px;
        }

        /* Styling for Register a Student card */
        .card.register h2 {
            background-color: whitesmoke; /* Light yellow background */
            padding: 30px;
            border-radius: 5px;
            margin-left: -28px;
            margin-right: -28.1px;
            margin-top: -29px;
        }

        .card h2 {
            font-size: 1.5em;
            color: var(--text-color);
            margin-bottom: 1em;
        }

        .card p {
            font-size: 1em;
            color: var(--subtext-color);
            margin-bottom: 1.5em;
        }

        /* Specific button styles */
        .add-subject-button {
            padding: 15px 300px; /* Adjust size for "Add Subject" button */
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-subject-button:hover {
            background-color: var(--primary-hover);
        }

        .register-button {
            padding: 15px 300px; /* Adjust size for "Register" button */
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Welcome to the System: <?php echo htmlspecialchars($userEmail); ?></h1>
            <!-- Logout Form -->
            <form method="POST" action="logout.php">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </header>
        
        <div class="card-container">
            <!-- Add a Subject Card -->
            <div class="card add-subject">
                <h2>Add a Subject</h2>
                <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                <button class="add-subject-button">Add Subject</button>
            </div>

            <!-- Register a Student Card -->
            <div class="card register">
                <h2>Register a Student</h2>
                <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                <button class="register-button">Register</button>
            </div>
        </div>
    </div>

</body>
</html>
