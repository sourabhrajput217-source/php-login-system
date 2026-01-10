<?php
$showalert = false;
$showerror = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'partial/userdb.php';

    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);

    // check email exists
    $exitsql = "SELECT * FROM user WHERE email='$email'";
    $result  = mysqli_query($connection, $exitsql);
    $num     = mysqli_num_rows($result);

    if ($num > 0) {

        // ✅ ERROR
        $showerror = "Email already exists";

    } else {

        if ($password === $cpassword) {
          $hash= password_hash ($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (email, password, `date-time`)
                    VALUES ('$email', '$hash', current_timestamp())";

            if (mysqli_query($connection, $sql)) {
                $showalert = true; // SUCCESS
            }

        } else {
            $showerror = "Password do not match";
        }
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?PHP require 'partial/navbar.php'; ?>
<?php
if($showalert){
echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>sign-in sucsessfuly...</strong> You are sign-in successfuly..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}

if($showerror){
echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>your email and password do not match..</strong> '. $showerror .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}
?>

    <h1 class="text-center m-4">Sign-up-here</h1><br>

    <div class="container d-flex justify-content-center align-items-center min-vh-64">
      <form method="POST" action="">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email"  maxlength="22" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 ">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password"   maxlength="22" class="form-control"  name="password"  id="exampleInputPassword1">
  </div>

   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">conform-Password</label>
    <input type="text" class="form-control" name="cpassword" id="exampleInputPassword1">
    <div id="emailHelp" class="form-text">enter the same password.</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>