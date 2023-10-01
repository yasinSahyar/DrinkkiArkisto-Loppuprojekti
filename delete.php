<?php
// Check if the form has been submitted
if (isset($_POST['deleteRecipe'])) {
    // Check if a recipe has been selected for deletion
    if (isset($_POST['recipeId'])) {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "drinkityasin";
        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        // Get the recipe ID to be deleted
        $recipeId = $_POST['recipeId'];

        // Delete the recipe from the database
        $deleteQuery = "DELETE FROM drinks WHERE drink_id = $recipeId";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "Recipe deleted successfully.";
        } else {
            echo "Error deleting recipe: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Select a recipe to delete.";
    }
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drinkityasin";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Retrieve all recipes from the database
$selectQuery = "SELECT drink_id, name FROM drinks";
$result = $conn->query($selectQuery);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Recipe</title>
    <link rel="stylesheet" type="text/css" href="search.css">
</head>
<body>

    <h1>Delete Recipe</h1>
    
    <!-- Display all recipes with delete buttons -->
    <form action="delete.php" method="post">
    <div class="form-container"> 
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recipeId = $row['drink_id'];
                $recipeName = $row['name'];
                echo "<p>$recipeName <button type='submit' name='recipeId' value='$recipeId'>Delete</button></p>";
            }
        } else {
            echo "No recipes available.";
        }
        ?>
        </div>

        <!-- Hidden field to send the recipe's ID for deletion -->
        <input type="hidden" name="deleteRecipe" value="true">
    </form>

</body>
</html>
