<!DOCTYPE html>
<html lang="en">
<head>
<?php
include("conn.php");
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="sign.css">
<title>signup</title>
<script>
function validateForm() {
    var password = document.forms["signupForm"]["pass"].value;
    var confirmPassword = document.forms["signupForm"]["cpass"].value;

    if (password !== confirmPassword) {
        alert("Entered passwords do not match.");
        return false; // Prevent form submission
    }
    return true; // Allow form submission if passwords match
}
</script>
</head>
<body>
<div class="forms">
    <h2 id="h2">SIGN UP</h2>
    <form action="signup.php" method="post" name="signupForm" onsubmit="return validateForm()">
        <input type="text"  name="user" placeholder="username" autocomplete="off" class="inputs"><br>
        <input type="email" name="email" autocomplete="off" class="inputs" placeholder="gmail"><br>
        <input type="text" name="mob" class="inputs" autocomplete="off" placeholder="mobile"><br>
        <input type="password" name="pass" autocomplete="off" class="inputs" placeholder="password"><br>
        <input type="password" name="cpass" autocomplete="off" class="inputs" placeholder="confirm password"><br>
        <input type="submit" value="signup" class="submit-btn" id="signup">
        <a href="login.php"> <input type="button" value="Login"  class="submit-btn"> </a>
    </form>
</div>
</body>
</html>
