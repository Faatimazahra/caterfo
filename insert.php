<?php
require_once __DIR__ . '/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Perform SQL injection prevention here if necessary
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Check if the user already exists
    $check_query = "SELECT * FROM login WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo '<div class="alert alert-danger" role="alert">User already exists with this email.</div>';
    } else {
        // Insert the new user into the database
        $insert_query = "INSERT INTO login (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo '<div class="alert alert-success" role="alert">User registered successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error registering user. Please try again later.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Register</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) - For dropdowns and other advanced features -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
