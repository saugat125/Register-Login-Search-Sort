<?php
include '../connection.php';

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submitbtn'])) {
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $age = $_POST['age'];

    if (empty($username) || empty($email) || empty($password)) {
        echo "<p class='error'>Please fill in all the fields.</p>";
    } else if ((isset($_POST['age']) && $_POST['age'] == '0')) {
        echo "<p class='error'>Select an age group</p>";
    } else if (!isset($_POST['confirm'])) {
        echo "<p class='error'>Agree to the terms and conditions</p>";
    } else if (strlen($username) < 6) {
        echo "<p class='error'>Username must be atleast 6 characters long</p>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='error'>Invalid Email Address</p>";
    } else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\d)/', $password)) {
        echo "<p class='error'>Password must contain at least one uppercase letter, lowercase letter and a number</p>";
    } else {

        $password = md5($password);

        $query = "INSERT INTO userinfo (Username, Email, Password, AgeGroup) VALUES('$username','$email','$password','$age')";

        if (mysqli_query($connection, $query)) {
            header('location: ../login/login.php');
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>


<form method="post" action="" >
    <h2>Register</h2>
    <label for="">Username</label>
    <input type="text" name="username" value="<?php  if(isset($_POST['username'])){echo ($username);}  ?>"><br>
    <label for="">Email</label>
    <input type="text" name="email" value="<?php if (isset($_POST['email'])) {echo ($email);} ?>"><br>
    <label for="">Password</label>
    <input type="password" name="password" value="">
    <label for="">Age Group </label>
    <select name="age">
        <option value="0">Select Age</option>
        <option value="Below 18" <?php if(isset($_POST['age']) && $_POST['age']=="Below 18"){echo 'selected';}  ?>>Below 18</option>
        <option value="18 - 30" <?php if (isset($_POST['age']) && $_POST['age'] == "18 - 30") { echo 'selected';} ?>>18 - 30</option>
        <option value="30 - 60" <?php if (isset($_POST['age']) && $_POST['age'] == "30 - 60") {echo 'selected';} ?>>30 - 60</option>
        <option value="Above 60" <?php if (isset($_POST['age']) && $_POST['age'] == "Above 60") {echo 'selected';} ?>>Above 60</option>
    </select>
    <input type="checkbox" name="confirm" value="agree">
    <label for="">I agree to terms and conditions </label><br />
    <div class="submit"><input type="submit" name="submitbtn" value="SUBMIT"></div>

    <p class="already">Already registered? <a href="../login/login.php">Login</a></p>
</form>
    <a href="../../watIndex.php"></a>   
    <p class="home"><a href="../../watIndex.php">HOME</a></p>
</body>
</html>