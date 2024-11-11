<?php
session_start(); // Start the session for session handling

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</h1>

    <!-- Add your dashboard content here -->

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
