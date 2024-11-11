<?php

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Dummy user data for authentication
function getUserData() {
    return [
        ["email" => "user1@example.com", "password" => "password123"],
        ["email" => "user2@example.com", "password" => "password456"],
        ["email" => "user3@example.com", "password" => "password789"],
        ["email" => "user4@example.com", "password" => "password000"],
        ["email" => "user5@example.com", "password" => "password111"]
    ];
}

// Function to check if the credentials are valid
function validateLoginCredentials($email, $password) {
    $errors = [];
    $users = getUserData();

    // Validate email address
    if (empty($email)) {
        $errors[] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required!";
    }

    // Validate if the credentials match any user in the database
    if (empty($errors)) {
        $isAuthenticated = false;
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $isAuthenticated = true;
                break;
            }
        }

        if (!$isAuthenticated) {
            $errors[] = "Incorrect email or password!";
        }
    }

    return $errors;
}

// Function to check if the user session is active
function checkUserSessionIsActive() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Start session if not already started
    }

    // Check if the session variable for user email is set (i.e., the user is logged in)
    if (isset($_SESSION['userEmail'])) {
        // Redirect to dashboard if session is active
        header("Location: dashboard.php");
        exit();
    }
}

// Function to display error messages
function displayErrors($errors) {
    if (empty($errors)) {
        return ''; // No errors to display
    }

    $output = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Errors:</strong><br>';
    foreach ($errors as $error) {
        $output .= $error . '<br>';
    }
    $output .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    
    return $output;
}

?>
