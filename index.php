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
    <img src="src/layered-waves-haikei.svg" alt="Pink and Orange Waves">

        <form>
            <h1>Log In</h1>
            <label for="username">
                <input type="text" id="username" placeholder="username" name="username">
                <span>Username</span>
            </label>
            <div class="fail user">asdasd</div>
            <label for="password">
                <input type="password" id="password" placeholder="Password" name="password">
                <span>Password</span>
            </label>
            <div class="fail pass">asdasd</div>
            <button type="button">LOGIN</button>
        </form>


    <script src="js/formvalidation.js"></script>

</body>

</html>