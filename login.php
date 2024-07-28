<?php
// Start session
session_start();

require_once __DIR__ . '/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform SQL injection prevention here if necessary
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password (you should use a stronger hashing algorithm like bcrypt)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to check if the user exists with the provided credentials
    $sql = "SELECT * FROM login WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // User exists and credentials match, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect to gestion page
            header("Location: servicecater");
            exit();
        } else {
            // Incorrect password
            echo '<div class="alert alert-danger" >Invalid password. Please try again.</div>';
        }
    } else {
        // User doesn't exist
        echo '<div class="alert alert-danger" role="alert">User with this email does not exist.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn-secondary {
            background-color: #cfb874;
            border-color: #cfb874;
        }

        .btn-secondary:hover {
            background-color: #a78c4d;
            border-color: #a78c4d;
        }
    </style>
</head>
<body>
<div class="col-12">
    <a href="index.php" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.79-2.907L8.5 7.028V5.5a.5.5 0 0 0-.79-.407L5 7.028V5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0V8.972l2.71 1.935a.5.5 0 0 0 .79-.407V8.972l2.71 1.935A.5.5 0 0 0 12 10.5v-5a.5.5 0 0 0-.79-.407"/>
        </svg>
    </a>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Login</h2>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="login" class="btn btn-secondary">Login</button>
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
