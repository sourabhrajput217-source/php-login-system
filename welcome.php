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


