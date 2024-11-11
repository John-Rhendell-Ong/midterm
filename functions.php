<?php
// Dummy accounts for authentication
$dummyAccounts = [
    ["email" => "user1@example.com", "password" => "password123"],
    ["email" => "user2@example.com", "password" => "password456"],
    ["email" => "user3@example.com", "password" => "password789"],
    ["email" => "user4@example.com", "password" => "password000"],
    ["email" => "user5@example.com", "password" => "password111"],
];

/**
 * Function to validate login credentials.
 *
 * @param string $email User email.
 * @param string $password User password.
 * @param array  &$errors Reference to the array holding error messages.
 *
 * @return bool True if login is valid, false if invalid.
 */
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
        // Validate email format
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

    // If no errors so far, check against the dummy accounts
    if (empty($errors)) {
        $isValidUser = false;
        foreach ($dummyAccounts as $account) {
            if ($account['email'] === $email && $account['password'] === $password) {
                $isValidUser = true;
                break;
            }
        }

        // If the credentials do not match, add error
        if (!$isValidUser) {
            $errors[] = "Invalid email or password.";
        }
    }

    // Return true if no errors were found, otherwise false
    return empty($errors);
}

/**
 * Function to display error messages in HTML.
 *
 * @param array $errors Array of error messages.
 */
function display_errors($errors) {
    // Display error messages in a styled box
    echo "<div class='error-message' id='errorMessage'>
            <span class='close-btn' onclick='closeErrorMessage()'>&times;</span>
            <strong>System Errors</strong>
            <ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
}

/**
 * Function to redirect the user to a new page.
 *
 * @param string $url The destination URL to redirect to.
 */
function redirect_to($url) {
    header("Location: $url");
    exit(); // Ensures no further code is executed after the redirect
}
?>
