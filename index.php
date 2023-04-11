<?php

session_start();
$users = file('src/users.txt',FILE_IGNORE_NEW_LINES);


$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'POST') {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    header('Location: index.php', true, 303);
    exit;

}


/*$file_handle = fopen('src/users.txt', 'r');
function get_all_lines($file_handle) { 
    while (!feof($file_handle)) {
        yield fgets($file_handle);
    }
}

$valid_user = false;
foreach (get_all_lines($file_handle) as $line) {

    if($_POST['password'] == $line && $valid_user == true)
    {
        $_SESSION['username'] = $_POST['username'];
        header('location: dashboard.php');
    }
    if($_POST['username'] != $line)
    {
        continue;
    }
    $valid_user = true;
}
fclose($file_handle);*/
?>


<?php

define('FILE_ENCRYPTION_BLOCKS', 10000);

/**
 * @param  string $source  Path of the unencrypted file
 * @param  $dest  Path of the encrypted file to created
 * @param  $key  Encryption key
 */
function encryptFile($source, $dest, $key)
{
    $cipher = 'aes-256-cbc';
    $ivLenght = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLenght);

    $fpSource = fopen($source, 'rb');
    $fpDest = fopen($dest, 'w');

    fwrite($fpDest, $iv);

    while (! feof($fpSource)) {
        $plaintext = fread($fpSource, $ivLenght * FILE_ENCRYPTION_BLOCKS);
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $iv = substr($ciphertext, 0, $ivLenght);

        fwrite($fpDest, $ciphertext);
    }

    fclose($fpSource);
    fclose($fpDest);
}

/**
 * @param  $source  Path of the encrypted file
 * @param  $dest  Path of the decrypted file
 * @param  $key  Encryption key
 */
function decryptFile($source, $dest, $key)
{
    $cipher = 'aes-256-cbc';
    $ivLenght = openssl_cipher_iv_length($cipher);

    $fpSource = fopen($source, 'rb');
    $fpDest = fopen($dest, 'w');

    $iv = fread($fpSource, $ivLenght);

    while (! feof($fpSource)) {
        $ciphertext = fread($fpSource, $ivLenght * (FILE_ENCRYPTION_BLOCKS + 1));
        $plaintext = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $iv = substr($plaintext, 0, $ivLenght);

        fwrite($fpDest, $plaintext);
    }

    fclose($fpSource);
    fclose($fpDest);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/loginpage.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="src/favicon.svg">
    <title>Login</title>
</head>

<body>
    <img class ="bg-img" src="src/layered-waves-haikei.svg" alt="Blue and Purple Waves">
    <div class="container">
        <div class="divLogoImage">
        <img class="logo fade-in" src="src/favicon.svg" alt="asd">
        </div>
    <form name="loginForm" onsubmit="return validation()" method="post">
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
                <em name="emptyPass" class="fail">Password cant be empty!</em>
            </div>
        <?php
            for($i=0;$i<count($users);$i+=2)
            {
                if(strcmp($_SESSION['username'],$users[$i]) == 0 &&  strcmp($_SESSION['password'],$users[$i+1]) == 0)
                {
                    $_SESSION['logged'] = true;
                    header('location: dashboard.php'); 
                }
            }
            
            if(isset($_SESSION['username']))
            {
                echo '<div class="faildiv"><div class="warningIcon"></div><em class="fail">Username or Password Incorrect!</em></div>';
            }
            
        ?>
        <button type="submit">LOGIN</button>
    </form>

    <script src="js/formvalidation.js"></script>
    <script>      
        var fadeInImage = document.querySelector(".fade-in");
        fadeInImage.classList.add("loaded");
    </script>
</body>

</html>