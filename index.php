<?php
session_start(); // Start the session

// Include the functions file - ensure the path is correct
include('functions.php'); // Make sure this is the correct path to the functions.php file

$errors = []; // Initialize an empty array for error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate login and handle errors
    if (validate_login($email, $password, $errors)) {
        // Successful login, redirect to dashboard.php
        $_SESSION['user_email'] = $email;
        redirect_to('dashboard.php');
    } else {
        // Display errors if login is not successful
        display_errors($errors); // Call display_errors() to show errors
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
        :root {
            /* Default position values */
            --error-message-top: 20px;
            --error-message-left: 50%;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c2c7;
            color: #842029;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            box-sizing: border-box;
            position: absolute;
            top: 200px;
            left: var(--error-message-left);
            transform: translateX(-50%);
            margin: 10px 0;
        }

        .error-message strong {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .error-message ul {
            padding-left: 20px;
            margin: 0;
        }

        .error-message li {
            list-style-type: disc;
        }

        /* Close button styles */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #842029;
        }

        .login-container {
            width: 400px;
            margin-top: 20px;
            padding: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        
        .login-container h3 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px 5px 0 0;
            color: black;
        }
        
        .form-group {
            margin: 15px 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        
        button {
            width: calc(100% - 40px);
            margin: 0 20px 20px 20px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="login-container">
    <h3>Login</h3>

    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
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
