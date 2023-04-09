<?php
    session_start();

    $valor_temperatura = file_get_contents("src/valor.txt");
    $hora_temperatura = file_get_contents("src/hora.txt");
    $nome_temperatura = file_get_contents("src/nome.txt");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--<meta http-equiv="refresh" content="5">-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    <link href="css/dbpage.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="src/favicon.svg">
    <title>Dashboard</title>
</head>
<body>
    <img class="bg" src="src/layered-waves-haikei.svg" alt="Pink and Orange Waves">
    <div class="nav">    
        <ul>
            <li class="list">
                <a href="#">    
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title">Home</span>
                </a> 
            </li>
            <li class="list">
                <a href="#">    
                    <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                    <span class="title">Sair</span>
                </a> 
            </li>
        </ul>
    </div>
    <!--<img class ="bg" src="src/layered-waves-haikei.svg" alt="Pink and Orange Waves">-->
    <div class="container">
        <div class="card m-3">
            <div class="card-title">
                <h1 class="text-center"><strong>Armazém</strong></h1>
            </div>
            <div class="card-body">
              <h5 class="text-center">Dashboard Dinâmico</h5>
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
                        <strong><?php echo $nome_temperatura . ": ". $valor_temperatura."ºC" ?></strong>
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
                        <strong><?php echo "Led Arduino: ". "On" ?></strong>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        const list = document.querySelectorAll('.list');
        function activeLink(){
            list.forEach((item) =>
                item.classList.remove('active'));
                this.classList.add('active');
        }
            list.forEach((item) =>
                item.addEventListener('mouseover', activeLink));
    </script>
</body>
</html>