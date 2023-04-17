<?php
session_start();

if (!$_SESSION['logged']) {
    header("refresh:1;url=index.php");
    die("Acesso restrito.");
}

$value_temperature = file_get_contents("api/files/temperature/value.txt");
$time_temperature = file_get_contents("api/files/temperature/time.txt");
$name_temperature = file_get_contents("api/files/temperature/name.txt");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--<meta http-equiv="refresh" content="5">-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Dashboard</title>
    <link href="css/dbpage.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="src/favicon.svg">
    <title>Dashboard</title>
</head>

<body>
    <img class="bg" src="src/layered-waves-haikei.svg" alt="Blue and Purple Waves">
    <div class="desktopnav d-lg-flex">
        <ul class="ul-nav">
            <div>
                <li class="li-logo">
                    <a class="a-nav" href="dashboard.php">
                        <img class="navlogo" src="src/favicon.svg" alt="Company Logo">
                        <h1>Warehouse</h1>
                    </a>
                </li>
                <li class="list actualpage">
                    <a class="a-nav" href="dashboard.php">
                        <span><ion-icon class="icon" name="home-outline"></ion-icon></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li class="list">
                    <a class="a-nav" href="logout.php">
                        <span><ion-icon class="icon" name="exit-outline"></ion-icon></span>
                        <span class="title">Exit</span>
                    </a>
                </li>
            </div>

            <div>
                <li class="li-user">

                    <span><ion-icon class="icon" name="person-outline"></ion-icon></span>
                    <div class="dropup-center dropup">
                        <button class="btn btn-secondary dropdown-toggle dropupstyle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username'] ?>
                        </button>
                        <div class="dropdown-menu" data-bs-theme="dark" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <?php
                            if ($_SESSION['usertype'] == 1)
                                echo '<a class="dropdown-item" href="editusers.php">Edit Users</a>';
                            ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item logoutbtn" href="logout.php">Log Out</a>
                        </div>
                    </div>
                </li>
            </div>
        </ul>
    </div>

    <div class="mobilenav d-lg-none">
        <ul>
            <li>
                <a href="dashboard.php">
                    <div class="navlogo">
                        <img src="src/favicon.svg" alt="Company Logo">
                    </div>
                    <h1>Warehouse</h1>
                </a>
            </li>
            <li class="list actualpage">
                <a href="dashboard.php">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title">Home</span>
                </a>
            </li>
            <li class="list">
                <a href="logout.php">
                    <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                    <span class="title">Exit</span>
                </a>
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="title"><?php echo $_SESSION['username'] ?></span>
                </a>
            </li>
        </ul>
    </div>
    <!--<img class ="bg" src="src/layered-waves-haikei.svg" alt="Pink and Orange Waves">-->
    <?php
    $sensors = array();

    foreach (new DirectoryIterator('./api/files') as $fileInfo) {
        if ($fileInfo->isDot() || $fileInfo->isFile()) continue;
        $sensors[count($sensors)] = $fileInfo->getBasename();
        echo '<h1 style="color:blue;z-index:20"">' . $sensors[count($sensors) - 1] . '</h1>';
    }

    

    ?>

    <div class="container">
        <div class="card m-3" style="background-color: #212529; color: white">
            <div class="card-title d-flex justify-content-center">
                <a href="index.php"><img class="logo fade-in" src="src/favicon.svg" alt="asd"></a>
            </div>
            <div class="card-body">
                <h1 class="text-center" style="opacity:0.6">Dynamic Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card m-3 cb1">
                    <div class="card-header text-center">
                        <strong><?php echo "Alarme de Segurança: " . " On" ?></strong>
                    </div>
                    <div class="card-body">
                        <img src="src/Alarm-on.png" class="image">
                    </div>
                    <div class="card-footer text-center">
                        <?php echo date("d/m/y") . "   " . date("H:i:s") . " - "; ?>
                        <a href="#">Historico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card m-3 cb1">
                    <div class="card-header text-center">
                        <strong><?php echo 'Temperatura' . ": " . $value_temperature . "ºC" ?></strong>
                    </div>
                    <div class="card-body">
                        <img class="image" src="src/humidity-high.png">
                    </div>
                    <div class="card-footer text-center">
                        <?php echo date("d/m/y") . "   " . date("H:i:s") . " - "; ?>
                        <a href="#">Historico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card m-3 cb1">
                    <div class="card-header text-center">
                        <strong><?php echo "Led Arduino: " . "On" ?></strong>
                    </div>
                    <div class="card-body">
                        <img class="image" src="src/light-on.png">
                    </div>
                    <div class="card-footer text-center">
                        <?php echo date("d/m/y") . "   " . date("H:i:s") . " - "; ?>
                        <a href="#">Historico</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script>
        const list = document.querySelectorAll('.list');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('active'));
            this.classList.add('active');
        }
        var fadeInImage = document.querySelector(".fade-in");
        fadeInImage.classList.add("loaded");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>