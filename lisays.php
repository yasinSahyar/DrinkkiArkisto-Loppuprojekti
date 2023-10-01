<!DOCTYPE html>
<html>
<head>
    <title>Add Recipe</title>
    <link rel="stylesheet" type="text/css" href="lisays.css">
</head>
<body>
    <h1>Add Recipe</h1>
    <form action="lisays.php" method="post">
    <div class="form-container">
        <label for="name">Recipe Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category"><br><br>

        <label for="instructions">Instructions:</label><br>
        <textarea name="instructions" rows="4" cols="50" required></textarea><br><br>
    </div>
    <div class="approved-container">

        <label for="ingredient1">Ingredient 1:</label>
        <input type="text" name="ingredient1"><br><br>

        <label for="quantity1">Quantity 1:</label>
        <input type="text" name="quantity1"><br><br>

        <label for="ingredient2">Ingredient 2:</label>
        <input type="text" name="ingredient2"><br><br>

        <label for="quantity2">Quantity 2:</label>
        <input type="text" name="quantity2"><br><br>

        <label for="ingredient3">Ingredient 3:</label>
        <input type="text" name="ingredient3"><br><br>

        <label for="quantity3">Quantity 3:</label>
        <input type="text" name="quantity3"><br><br>
    </div><br>
    

        <input type="submit" name="submit" value="Add Recipe">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $recipeName = $_POST['name'];
        $category = $_POST['category'];
        $instructions = $_POST['instructions'];
        $ingredients = [];

        if (!empty($_POST['ingredient1']) && !empty($_POST['quantity1'])) {
            $ingredients[] = [
                'ingredient' => $_POST['ingredient1'],
                'quantity' => $_POST['quantity1']
            ];
        }

        if (!empty($_POST['ingredient2']) && !empty($_POST['quantity2'])) {
            $ingredients[] = [
                'ingredient' => $_POST['ingredient2'],
                'quantity' => $_POST['quantity2']
            ];
        }

        if (!empty($_POST['ingredient3']) && !empty($_POST['quantity3'])) {
            $ingredients[] = [
                'ingredient' => $_POST['ingredient3'],
                'quantity' => $_POST['quantity3']
            ];
        }

        if (!empty($recipeName)) {
            $conn = new mysqli("localhost", "root", "", "drinkityasin");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the recipe name already exists in the database
            $checkQuery = "SELECT * FROM drinks WHERE name = '$recipeName'";
            $result = $conn->query($checkQuery);

            if ($result->num_rows == 0) {
                // Insert the recipe details into the drinks table
                $insertQuery = "INSERT INTO drinks (name, category, description, rating, serving_size, image_url, hyvaksytty) 
                                VALUES ('$recipeName', '$category', '$instructions', 0, 0, '', 0)";
                if ($conn->query($insertQuery) === TRUE) {
                    // Get the auto-incremented drink_id
                    $drinkId = $conn->insert_id;

                    // Insert ingredients into the drinkingredients table
                    foreach ($ingredients as $ingredient) {
                        $ingredientName = $ingredient['ingredient'];
                        $quantity = $ingredient['quantity'];

                        $ingredientQuery = "INSERT INTO drinkingredients (drink_id, amount) VALUES ($drinkId, '$quantity')";
                        $conn->query($ingredientQuery);
                    }

                    echo "Recipe added successfully!";
                } else {
                    echo "Error adding recipe: " . $conn->error;
                }
            } else {
                echo "Recipe with the same name already exists.";
            }

            $conn->close();
        } else {
            echo "Recipe name cannot be empty.";
        }
    }
    ?>
</body>
</html>
