<?php
// Database connection details 
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

// Check if the form for accepting or rejecting recipes has been submitted
if (isset($_POST['accept']) || isset($_POST['reject'])) {
    // Handle form submission here
    // You can access the ID of the recipe to accept or reject using $_POST['recipe_id']

    if (isset($_POST['accept'])) {
        // Code to accept the recipe (set 'hyvaksytty' to 1)
    } elseif (isset($_POST['reject'])) {
        // Code to reject the recipe (delete it from the database)
    }

    // Redirect back to the same page or any other appropriate page
    header("Location: hyvaksy.php");
    exit();
}

// Retrieve all recipes with 'hyvaksytty' set to 0 from the database
$selectQuery = "SELECT * FROM drinks WHERE hyvaksytty = 0";
$result = $conn->query($selectQuery);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accept or Reject Recipes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .accept-button, .reject-button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
        }

        .accept-button {
            background-color: #4CAF50;
            color: white;
        }

        .reject-button {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Accept or Reject Recipes</h1>

    <!-- Display a table of recipes to accept or reject -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>";
                    echo "<form action='hyvaksy.php' method='post'>";
                    echo "<input type='hidden' name='recipe_id' value='" . $row['drink_id'] . "'>";
                    echo "<button type='submit' name='accept' class='accept-button'>Accept</button>";
                    echo "<button type='submit' name='reject' class='reject-button'>Reject</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No recipes to display.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
