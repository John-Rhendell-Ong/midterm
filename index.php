<?php 

// Include the required functions file
include 'functions.php';

// Ensure the user session is active
checkUserSessionIsActive();

// Initialize variables
$userEmail = "";
$formErrors = [];

// Process form submission
if (isset($_POST['submitLogin'])) {
    // Clean input data to prevent XSS and other issues
    $userEmail = trim(stripslashes(htmlspecialchars($_POST['emailInput'])));
    $userPassword = $_POST['passwordInput'];
    
    // Validate user credentials
    $formErrors = validateLoginCredentials($userEmail, $userPassword);

    // If validation passes, initiate session and redirect
    if (empty($formErrors)) {
        session_start();
        $_SESSION['userEmail'] = $userEmail;
        header("Location: dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php 
    // Display form validation errors if any
    echo displayErrors($formErrors); 
?>

<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Login to Your Account</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="text" class="form-control" name="emailInput" id="email" placeholder="Enter email" value="<?php echo htmlspecialchars($userEmail); ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="passwordInput" id="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submitLogin">Log In</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
