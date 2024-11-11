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
        /* Add your styles here */
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Welcome to the System: <?php echo htmlspecialchars($userEmail); ?></h1>
            <!-- Logout Button -->
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
