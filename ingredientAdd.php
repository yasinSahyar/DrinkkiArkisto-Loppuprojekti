<?php
include_once('connaction.php');
$ingredient = "";
$resultMessage = "";

if (isset($_POST['add'])) {
    // Check if the form was submitted
    $ingredient = $_POST['ingredient'];

    // Check if the text field is not empty
    if (!empty($ingredient)) {

        // Check if the ingredient already exists in the database
        $checkQuery = "SELECT * FROM Ingredients WHERE name = '$ingredient'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows == 0) {
            // Add the ingredient to the database
            $insertQuery = "INSERT INTO Ingredients (name) VALUES ('$ingredient')";
            
            if ($conn->query($insertQuery) === TRUE) {
                $resultMessage = "Ingredient '$ingredient' added successfully!";
            } else {
                $resultMessage = "Error adding ingredient: " . $conn->error;
            }
        } else {
            $resultMessage = "Ingredient '$ingredient' already exists.";
        }
    } else {
        $resultMessage = "Ingredient name cannot be empty.";
    }
}

// Retrieve all ingredients from the database
$ingredientsQuery = "SELECT name FROM Ingredients";
$ingredientsResult = $conn->query($ingredientsQuery);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Ingredient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="input">
    <div class="form-container">
    <h1>Add Ingredient</h1>
    <form action="ingredientAdd.php" method="post">
        <label for="ingredient">Ingredient Name:</label>
        <input type="text" name="ingredient"  required placeholder="ingredient name">
        <input type="submit" name="add" value="Add">
    </form>
    
    <!-- Display the result here -->
    <div id="result"><?php echo $resultMessage; ?></div>

    </div>

    <div class="database-container">

    <!-- Display all ingredients from the database -->
    <h2>Ingredients :</h2>
    <?php
    if ($ingredientsResult->num_rows > 0) {
        echo "<ul>";
        while ($row = $ingredientsResult->fetch_assoc()) {
            echo  "Ingredient :" . $row["name"]."<br>" ;
        }
        echo "</ul>";
    } else {
        echo "No ingredients in the database.";
    }

    // Close the database connection
    $conn->close();
    ?>
    </div>
</body>
</html>
