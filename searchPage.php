<?php
session_start();

if (!isset($_SESSION['i'])) {
    header('Location: login.php');
    exit();
}

// Set the 'role' key in the session based on $_SESSION['i']
if ($_SESSION['i'] == 1) {
    $_SESSION['role'] = 'Admin'; // Set the role for admin
} elseif ($_SESSION['i'] == 0) {
    $_SESSION['role'] = 'User'; // Set the role for user
}

$navigation = '';

if ($_SESSION['i'] == 1) {
    $navigation = include_once('naviAdmin.html');
} elseif ($_SESSION['i'] == 0) {
    $navigation = include_once('naviUser.html');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
</head>
<body>
    <h1>Search Page</h1>
    <p>Welcome to the search page, <?php echo $_SESSION['role']; ?>!</p>
    
    <!-- Navigation bar -->
    <nav>
        <?php echo $navigation; ?>
    </nav>

    <!-- Other content for the search page -->
</body>
</html>
