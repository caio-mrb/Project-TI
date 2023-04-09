<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/loginpage.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <img class="bg" src="src/layered-waves-haikei.svg" alt="Pink and Orange Waves">
    <form name="loginForm" action="/Project-TI/dashboard.php" onsubmit="return validation()" method="post">
        <h1>Log In</h1>
        <label id="usernameLabel" for="username">
            <input type="text" id="username" placeholder="username" name="username">
            <span>Username</span>
        </label>
        <div id="warningUser" class="warningUser">
            <div class="warningIcon"></div>
            <em id="emptyUser" class="fail">Username can't be empty!</em>
        </div>

        <label id="passwordLabel" for="password">
            <input type="password" id="password" placeholder="Password" name="password">
            <span>Password</span>
        </label>
            <div id="warningPass" class="warningPass">
                <div class="warningIcon"></div>
                <em name="emptyPass" class="fail">Password can't be empty!</em>
            </div>

        <div name="wrongCredentials" class="faildiv"><div class="warningIcon"></div><em class="fail">Username or Password incorrect!</em></div>
        <button type="submit">LOGIN</button>
    </form>

    <script scr="js/formresubmission.js"></script>
    <script src="js/formvalidation.js"></script>

</body>

</html>