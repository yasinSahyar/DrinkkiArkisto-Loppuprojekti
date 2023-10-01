<?php
// Database connection parameters (modify these with your database details)
$servername = "localhost";
$db_username = "root";     // Your database username
$db_password = "";         // Your database password
$dbname = "drinkityasin";  // Your database name

// Function to register a new user
function registerUser($conn, $username, $password, $email) {
    // Check if the username is not found in the database
    $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUsernameQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert the user into the database with role 'user'
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertUserQuery = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 'user')";
        $stmt = $conn->prepare($insertUserQuery);
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Error registering user: " . $conn->error;
        }
    } else {
        return "Username '$username' already exists.";
    }
}

// Check if the registration form has been submitted
if (isset($_POST['register'])) {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Create a database connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Call the registerUser function
    $registrationResult = registerUser($conn, $username, $password, $email);

    // Check if registration was successful and then redirect
    if (strpos($registrationResult, "successful") !== false) {
        // Redirect to the naviUser.html page
        header("Location: naviUser.html");
        exit(); // Terminate script execution after redirection
    }

    echo $registrationResult;

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        .container {
            max-width: 500px;
            margin: auto;
        }

        .input-container {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            margin-bottom: 15px;
        }

        .icon {
            padding: 10px;
            background: dodgerblue;
            color: white;
            min-width: 50px;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            outline: none;
        }

        .input-field:focus {
            border: 2px solid dodgerblue;
        }

        /* Set a style for the submit button */
        .btn {
            background-color: dodgerblue;
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .btn:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="register.php" method="post">
        <h2>Register Form</h2>
        <div class="input-container">
            <i class="fa fa-user icon"></i>
            <input class="input-field" type="text" placeholder="Username" name="username">
        </div>

        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input class="input-field" type="text" placeholder="Email" name="email">
        </div>

        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Password" name="password">
        </div>

        <button type="submit" class="btn" name="register">Register</button>
    </form>
</div>

</body>
</html>
