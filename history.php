<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="css/history.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="src/favicon.svg">
    <title>Document</title>
</head>
<body>
<div class="bg" alt="Blue and Purple Waves"></div>
    <div class="desktopnav d-xl-flex">
        <div>
            <a href="dashboard.php">
                <img class="navlogo" src="src/favicon.svg" alt="Company Logo">
                <h1>Warehouse</h1>
            </a>
            <a href="dashboard.php">
                <span><ion-icon class="icon" name="home-outline"></ion-icon></span>
                <span class="pagename">Home</span>
            </a>
            <a class="actualpage" href="history.php">
                <span><ion-icon class="icon" name="time-outline"></ion-icon></span>
                <span class="pagename">History</span>
            </a>
            <a href="logout.php">
                <span><ion-icon class="icon" name="exit-outline"></ion-icon></span>
                <span class="pagename">Exit</span>
            </a>
        </div>

        <div class="userdiv">
            <span><ion-icon class="icon" name="person-outline"></ion-icon></span>
            <div class="dropup-center dropup">
                <button class="btn btn-secondary dropdown-toggle dropupstyle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['username'] ?>
                </button>
                <div class="dropdown-menu" data-bs-theme="dark">
                    <a class="dropdown-item logoutbtn" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-top-margin d-xl-none"></div>

    <div class="mobilenav d-xl-none">
        <div  class="pagesdiv">
            <a href="dashboard.php">
                <img class="navlogo" src="src/favicon.svg" alt="Company Logo">
                <h1 class="d-md-flex">Warehouse</h1>
            </a>
            <a href="dashboard.php">
                <ion-icon class="icon" name="home-outline"></ion-icon>
                <span class="pagename d-sm-flex">Home</span>
            </a>
            <a class="actualpage" href="history.php">
                <ion-icon class="icon" name="time-outline"></ion-icon>
                <span class="pagename d-sm-flex">History</span>
            </a>
            <a href="logout.php">
                <ion-icon class="icon" name="exit-outline"></ion-icon>
                <span class="pagename d-sm-flex">Exit</span>
            </a>
        </div>

        <div class="userdiv">
            <ion-icon class="icon" name="person-outline"></ion-icon>
            <div class="dropdown-center dropdown">
                <button class="btn btn-secondary dropdown-toggle dropdownstyle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['username'] ?>
                </button>
                <div class="dropdown-menu" data-bs-theme="dark">
                    <a class="dropdown-item logoutbtn" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>