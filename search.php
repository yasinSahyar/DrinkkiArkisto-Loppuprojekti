<!DOCTYPE html>
<html>
<head>
    <title>Search Recipes</title>
    <link rel="stylesheet" type="text/css" href="search.css">
</head>
<body>
    <h1>Search Recipes</h1>
    <form action="search.php" method="post">
    <div class="form-container">   
        <label>Search by:</label><br>
        <input type="radio" name="searchType" value="name" checked> Name<br>
        <input type="radio" name="searchType" value="ingredient"> Ingredient<br>
        <br>
        <label for="searchTerm">Search Term:</label>
        <input type="text" name="searchTerm" required>
     </div>
        <br><br>
        <input type="submit" name="submit" value="Search">
    </form>

    <?php
if (isset($_POST['submit'])) {
    // Get the search type and term from the form
    $searchType = $_POST['searchType'];
    $searchTerm = $_POST['searchTerm'];

    // Create a database connection
    $conn = new mysqli("localhost", "root", "", "drinkityasin");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define the query based on the selected radio button value
    if ($searchType === "name") {
        $query = "SELECT * FROM drinks WHERE name LIKE '%$searchTerm%'";
    } elseif ($searchType === "ingredient") {
        // Adjust the query to join the tables correctly and replace placeholders
        $query = "SELECT d.name AS drink_name, d.category, i.name AS ingredient_name, dr.amount, d.description 
                  FROM drinks d
                  LEFT JOIN drinkingredients dr ON d.drink_id = dr.drink_id
                  LEFT JOIN ingredients i ON dr.ingredient_id = i.ingredient_id
                  WHERE i.name LIKE '%$searchTerm%'";
    }

    // Execute the query
    $result = $conn->query($query);

    if ($result === false) {
        // Display query error
        echo "Query error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        echo "<h2>Search Results:</h2>";

        // Debugging: Print the SQL query for debugging purposes
        // echo "SQL Query: " . $query . "<br>";

        // Iterate through the results and format them
        while ($row = $result->fetch_assoc()) {
            echo "Name: " . (isset($row['drink_name']) ? $row['drink_name'] : "Not specified") . "<br>";
            echo "Type of drink: " . (isset($row['category']) ? $row['category'] : "Not specified") . "<br>";
            
            echo "Ingredients:<br>";
            echo "<ul>";
            
            // Check if ingredient_name and amount keys exist in the row
            if (isset($row['ingredient_name']) && isset($row['amount'])) {
                echo "<li>" . $row['ingredient_name'] . " " . $row['amount'] . "</li>";
            } else {
                echo "<li>No ingredients specified</li>";
            }
            
            echo "</ul>";

            echo "Recipe:<br>";
            echo (isset($row['description']) ? $row['description'] : "Not specified") . "<br><br>";
        }
    } else {
        echo "No results found.";
    }

    // Close the database connection
    $conn->close();
}
?>
