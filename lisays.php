<?php
// Database connection parameters (modify these with your database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drinkityasin";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for form data
$name = "";
$category = "";
$instructions = "";
$ingredientQuantities = [];

// Define an array to store validation errors
$errors = [];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get user input
    $name = $_POST['name'];
    $category = $_POST['category'];
    $instructions = $_POST['instructions'];
    $approved = isset($_POST['approved']) ? 1 : 0; // 1 if approved, 0 if not
    
    // Validate the name field (not empty)
    if (empty($name)) {
        $errors[] = "Name field cannot be empty.";
    }
    
    // Check if the name already exists in the database
    $checkNameQuery = "SELECT * FROM drinkki WHERE name = '$name'";
    $result = $conn->query($checkNameQuery);
    if ($result->num_rows > 0) {
        $errors[] = "Recipe with this name already exists.";
    }
    
    // Validate at least one ingredient quantity
    for ($i = 1; $i <= 3; $i++) {
        $ingredientQuantity = $_POST['ingredient' . $i];
        if (!empty($ingredientQuantity)) {
            $ingredientQuantities[] = $ingredientQuantity;
        }
    }
    
    if (empty($ingredientQuantities)) {
        $errors[] = "At least one ingredient quantity must be provided.";
    }
    
    // If there are no validation errors, insert the recipe into the database
    if (empty($errors)) {
        // Insert recipe details into the drinkki table
        $insertRecipeQuery = "INSERT INTO drinks (name, category, description, hyvaksytty) VALUES ('$name', '$category', '$instructions', $approved)";
        if ($conn->query($insertRecipeQuery) === TRUE) {
            // Get the auto-incremented DrinkkiId
            $drinkId = $conn->insert_id;

            // Insert ingredient quantities into the ingredients table
            foreach ($ingredientQuantities as $quantity) {
                $insertIngredientQuery = "INSERT INTO drinkingredients (drink_id, amount) VALUES ($drinkId, '$quantity')";
                $conn->query($insertIngredientQuery);
            }

            echo "Recipe added successfully!";
        } else {
            echo "Error adding recipe: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipe Addition</title>
    <link rel="stylesheet" type="text/css" href="lisays.css">
</head>
<body>
    <h1>Add a Recipe</h1>
    
    <!-- Display validation errors, if any -->
    <?php if (!empty($errors)) : ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Recipe addition form -->
    <form method="POST" action="lisays.php">
    <div class="form-container">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="category">Type of Drink:</label>
        <input type="text" name="category" value="<?php echo $category; ?>"><br><br>

        <label for="instructions">Instructions:</label>
        <textarea name="instructions"><?php echo $instructions; ?></textarea><br><br>
     </div>

    <div class="approved-container">

        <label for="approved">Approved Drink:</label>
        <input type="checkbox" name="approved" value="1"><br><br>
    </div>

        <!-- Ingredient quantities (up to 3) -->
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <label for="ingredient<?php echo $i; ?>">Ingredient <?php echo $i; ?> quantity:</label>
            <input type="text" name="ingredient<?php echo $i; ?>"><br><br>
        <?php endfor; ?>

        <input type="submit" name="submit" value="Add Recipe">
    </form>

    <!-- Display recipe details -->
    <?php if (!empty($drinkkiId)) : ?>
        <h2>Recipe Details:</h2>
        <p>Name: <?php echo $name; ?></p>
        <p>Type of Drink: <?php echo $category; ?></p>
        <p>Instructions: <?php echo $instructions; ?></p>
        <p>Approved Drink: <?php echo ($approved == 1) ? 'Yes' : 'No'; ?></p>
    <?php endif; ?>
</body>
</html>
