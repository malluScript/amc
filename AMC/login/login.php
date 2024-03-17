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
</head>
<body>
    <div class="forms">
        <h2 id="h2">LOGIN</h2>
    <form action="loginac.php" method="post">
        <input type="text"  name="user" placeholder="username" autocomplete="off" class="inputs"><br>
        <input type="password" id="password" name="pass" autocomplete="off" class="inputs"placeholder="password" ><br>
        <input type="checkbox" id="showPassword"> Show Password <br>
        <input type="submit" value="signIn"  class="submit-btn">
       <a href="sign.php"> <input type="button" value="signUp"  class="submit-btn"> </a>
    </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        showPasswordCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordInput.type = 'text'; // Show the password
            } else {
                passwordInput.type = 'password'; // Hide the password
            }
        });
    </script>
    
</body>
</html>
