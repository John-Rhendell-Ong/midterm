<?php
session_start(); // Start the session for session handling

$errors = []; // Initialize an empty array for error messages

// Define dummy accounts
$dummyAccounts = [
    ["email" => "user1@example.com", "password" => "password123"],
    ["email" => "user2@example.com", "password" => "password456"],
    ["email" => "user3@example.com", "password" => "password789"],
    ["email" => "user4@example.com", "password" => "password000"],
    ["email" => "user5@example.com", "password" => "password111"],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $isValidUser = false;

    // Check if email and password are provided
    if (empty($email) && empty($password)) {
        $errors[] = "Email is required.";
        $errors[] = "Password is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($password)) {
        $errors[] = "Invalid email.";
        $errors[] = "Password is required.";
    } else {
        // Validate email
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // Validate password
        if (empty($password)) {
            $errors[] = "Password is required.";
        }
    }

    // If no specific errors, check against dummy accounts
    if (empty($errors)) {
        foreach ($dummyAccounts as $account) {
            if ($account['email'] === $email && $account['password'] === $password) {
                $_SESSION['user_email'] = $email; // Store email in session after successful login
                header("Location: dashboard.php"); // Redirect to dashboard
                exit;
            }
        }

        // If no match is found for either email or password, add a single error message
        if (!$isValidUser) {
            $errors[] = "Invalid email or password.";
        }
    }

    // Display errors if there are any
    if (!empty($errors)) {
        echo "<div class='error-message' id='errorMessage'>
                <span class='close-btn' onclick='closeErrorMessage()'>&times;</span>
                <strong>System Errors</strong>
                <ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="login-container">
    <h3>Login</h3>

    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>
</div>

<script>
    function closeErrorMessage() {
        document.getElementById('errorMessage').style.display = 'none';
    }
</script>

</body>
</html>
