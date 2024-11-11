<?php 

// Include the functions file and ensure user access control
include 'functions.php';
ensureUserIsAuthenticated();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <form method="POST">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Display a welcome message with the user's email -->
                <h2>Welcome to the Dashboard, <?php echo $_SESSION['userEmail']; ?></h2>
                <a href="logout.php" class="btn btn-danger">Sign Out</a>
            </div>
        </form>     

        <!-- Main content area with action cards -->
        <div class="row">
            <!-- Card for adding a new subject -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create New Subject</h5>
                        <p class="card-text">Use this section to add a new subject to the system. Click below to begin the process.</p>
                        <a href="#" class="btn btn-primary">Add Subject</a>
                    </div>
                </div>
            </div>

            <!-- Card for registering a new student -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enroll New Student</h5>
                        <p class="card-text">This section allows you to enroll a new student in the system. Click below to start the registration process.</p>
                        <a href="#" class="btn btn-primary">Register Student</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
