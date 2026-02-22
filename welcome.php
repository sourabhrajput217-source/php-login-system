<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: log-in.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php require 'partial/navbar.php'; ?>

<div class="container mt-5">
    <h1>Welcome <?php echo $_SESSION['email']; ?> 🎉</h1>
    <p>You are successfully logged in.</p>
</div>

</body>
</html>
