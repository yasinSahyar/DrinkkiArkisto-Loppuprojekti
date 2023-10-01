<?php
$message = "";

// Check if the form for adding recipes has been submitted
if (isset($_POST['submit'])) {
    // Database connection details (replace with your own)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "drinkityasin";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get recipe details from the form
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $description = $conn->real_escape_string($_POST['description']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $serving_size = $conn->real_escape_string($_POST['serving_size']);
    $image_url = $conn->real_escape_string($_POST['image_url']);

    // Insert the recipe suggestion into the database with hyvaksytty set to 0
    $insertQuery = "INSERT INTO drinks (name, category, description, rating, serving_size, image_url, hyvaksytty)
                    VALUES ('$name', '$category', '$description', '$rating', '$serving_size', '$image_url', 0)";

    if ($conn->query($insertQuery) === TRUE) {
        $message = "Recipe suggestion submitted successfully!";
    } else {
        $message = "Error submitting recipe suggestion: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Suggest a Recipe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .form-container {
            margin: 30px;
            padding: 30px;
            border: 3px solid #ccc;
            border-radius: 20px;
            background-color: #c8e286;
        }

        h1 {
            text-align: locale_filter_matches;
        }

        .message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Suggest a Recipe</h1>

    <!-- Recipe Suggestion Form -->
    <div class="form-container">
        <form action="ehdotus.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <br>
            <label for="category">Category:</label>
            <input type="text" name="category" required>
            <br>
            <label for="description">Description:</label>
            <textarea name="description" rows="4" required></textarea>
            <br>
            <label for="rating">Rating:</label>
            <input type="number" name="rating" required>
            <br>
            <label for="serving_size">Serving Size:</label>
            <input type="text" name="serving_size" required>
            <br>
            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url">
            <br><br><br>
            <input type="submit" name="submit" value="Submit Recipe Suggestion">
        </form>
        <div class="message"><?php echo $message; ?></div>
    </div>
</body>
</html>
