<?php
// Dummy accounts for authentication
$dummyAccounts = [
    ["email" => "user1@example.com", "password" => "password123"],
    ["email" => "user2@example.com", "password" => "password456"],
    ["email" => "user3@example.com", "password" => "password789"],
    ["email" => "user4@example.com", "password" => "password000"],
    ["email" => "user5@example.com", "password" => "password111"],
];

// Function to validate login
function validate_login($email, $password, &$errors) {
    global $dummyAccounts;

    // Trim the input to remove leading/trailing spaces
    $email = trim($email);
    $password = trim($password);

    // Validate email and password
    if (empty($email) && empty($password)) {
        $errors[] = "Email is required.";
        $errors[] = "Password is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($password)) {
        $errors[] = "Invalid email.";
        $errors[] = "Password is required.";
    } else {
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        }
    }

    // Check if email and password match any dummy account
    if (empty($errors)) {
        $isValidUser = false;
        foreach ($dummyAccounts as $account) {
            if ($account['email'] === $email && $account['password'] === $password) {
                $isValidUser = true;
                break;
            }
        }

        if (!$isValidUser) {
            $errors[] = "Invalid email or password.";
        }
    }

    return empty($errors);
}

// Function to display error messages
function display_errors($errors) {
    echo "<div class='error-message' id='errorMessage'>
            <span class='close-btn' onclick='closeErrorMessage()'>&times;</span>
            <strong>System Errors</strong>
            <ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
}

?>
