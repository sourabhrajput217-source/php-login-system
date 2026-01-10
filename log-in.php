<?php
session_start();

$loginalert = false;
$showerror  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'partial/userdb.php';

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $loginalert = true;

            $_SESSION['loggedin'] = true;
            $_SESSION['email']   = $email;
            header("location: welcome.php");
            exit;

        } else {
            $showerror = "Invalid password";
        }

    } else {
        $showerror = "Invalid email";
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>log-in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?PHP require 'partial/navbar.php'; ?>
<?php
if($loginalert){
echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>logged in sucsessfuly...</strong> You are logged in  successfuly..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}

if($showerror){
echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>your email and password do not match..</strong> '. $showerror .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}
?>

    <h1 class="text-center m-4">Log-in</h1><br>

    <div class="container d-flex justify-content-center align-items-center min-vh-64">
      <form method="POST" action="">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 ">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control"  name="password"  id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">log-in</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>