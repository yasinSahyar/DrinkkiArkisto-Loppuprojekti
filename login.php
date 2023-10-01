<?php

session_start();


if (isset($_POST['login'])) {
    // 
    $username = "admin";
    $password = "yasinjan";

    // Tarkista, että syötetty käyttäjätunnus ja salasana täsmäävät
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        // Tallenna käyttäjän rooli istuntoon (voit lisätä muita rooleja tarvittaessa)
        $_SESSION['i'] = 1;

        // Ohjaa käyttäjä haluamallesi sivulle kirjautumisen jälkeen
        header('Location: searchPage.php');
        exit();
    } else {
        // Virheviesti, jos käyttäjätunnus tai salasana on väärin
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="search.css">
</head>
<body>
    <h1>Login</h1>
    <?php
    // Näytä virheviesti tarvittaessa
    if (isset($errorMessage)) {
        echo "<p>$errorMessage</p>";
    }
    ?>
    <form action="login.php" method="post">
    <div class="form-container">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
    </div>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
