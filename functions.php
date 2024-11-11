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
function verifyLogin($email, $password) {
    $errorMessages = [];
    $users = getUserData();  // Fetch the dummy accounts

    // Validate email address
    if (empty($email)) {
        $errorMessages['email'] = 'Email is required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages['email'] = 'Invalid email format!';
    }

    // Validate password
    if (empty($password)) {
        $errorMessages['password'] = 'Password is required!';
    }

    // If no validation errors, proceed to check credentials
    if (empty($errorMessages)) {
        if (!authenticateUser($email, $password, $users)) {
            $errorMessages['credentials'] = 'Incorrect email or password!';
        }
    }

    return $errorMessages;
}

// Function to authenticate the user by checking the provided email and password
function authenticateUser($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true; // Authentication successful
        }
    }
    return false; // Authentication failed
}

// Function to ensure the session is active and the user is authenticated
function ensureUserIsAuthenticated() {
    // Check if the user is logged in
    if (empty($_SESSION['user_email'])) {
        // If not logged in, redirect to the login page
        header("Location: login.php");
        exit(); // Stop further execution
    }
}

// Function to display error messages
function showErrorMessages($messages) {
    if (empty($messages)) {
        return '';  // Return an empty string if there are no errors
    }

    $output = '
    <div class="alert alert-danger alert-dismissible fade show" style="max-width: 400px; position: absolute; top: 20px; left: 50%; transform: translateX(-50%);" role="alert">
        <strong>Errors:</strong> Please resolve the following issues:
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <hr>
        <ul>';

    foreach ($messages as $message) {
        $output .= '<li>' . htmlspecialchars($message) . '</li>';
    }
    $output .= '</ul></div>';

    return $output;
}

// Function to render a single error message (for individual use cases)
function renderSingleError($message) {
    if (empty($message)) {
        return '';  // Return nothing if no message exists
    }

    return '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($message) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

// Helper function to get the base URL of the site
function getSiteURL() {
    return 'http://localhost/your_project_name/';  // Change this to your actual base URL
}

?>
