<?php

include '../init.php';

if (isset($_POST['submitbtn'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM userinfo WHERE username='$username' AND password='$password'";

    $result = mysqli_query($connection, $query);

    if (mysqli_fetch_assoc($result)) {
        $_SESSION['user'] = $username;
        header('Location: ../sortSearch/sortSearch.php');

    } else {
        echo "<p class='error'>User not recognized</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form method="post" action="">
        <h2>LOGIN</h2>
        <label for="">Username</label><br>
        <input type="text" name="username" value="<?php if (isset($_POST['username'])) {echo ($username);} ?>"><br>
        <label for="">Password</label><br>
        <input type="password" name="password" value=""><br>
        <div class="submit"><input type="submit" name="submitbtn" value="LOGIN"></div>
        <p class="already">Not registered? <a href="../register/register.php">Register</a></p>
    </form>
</body>

</html>