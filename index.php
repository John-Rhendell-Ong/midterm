<?php
session_start(); // Start the session to handle login state

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
                $isValidUser = true;
                break;
            }
        }

        // If no match is found for either email or password, add a single error message
        if (!$isValidUser) {
            $errors[] = "Invalid email or password.";
        }
    }

    // If there are errors, display them
    if (!empty($errors)) {
        echo "<div class='error-message' id='errorMessage'>
                <span class='close-btn' onclick='closeErrorMessage()'>&times;</span>
                <strong>System Errors</strong>
                <ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    } else {
        // Successful login: Store the user's email in the session
        $_SESSION['user_email'] = $email;
        
        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit(); // Make sure no further code is executed after the redirect
    }
}
?>
