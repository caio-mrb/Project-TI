<?php
    $valor_temperatura = file_get_contents("src/valor.txt");
    $hora_temperatura = file_get_contents("src/hora.txt");
    $nome_temperatura = file_get_contents("src/nome.txt");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <link href="css/dbpage.css" rel="stylesheet">
    <img src="src/layered-waves-haikei.svg" alt="Pink and Orange Waves">
    <div class="container">
        <div class="row">
                <div class="card m-3">
                    <div class="card-title">
                        <h1 class="text-center"><strong>Armazém</strong></h1>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center">Dashboard Dinâmico</h5>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card m-3 cb1">           
                    <div class="card-header text-center">
                        <strong><?php echo $nome_temperatura . ": ". $valor_temperatura."ºC" ?></strong>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, delectus molestiae est sunt necessitatibus at aliquid earum ab, error doloribus magni, atque eveniet aut voluptatibus incidunt excepturi vero provident corrupti?    
                    </div>
                    <div class="card-footer">
                        06/04/2023
                    </div>
                </div>               
            </div>
            <div class="col-sm-4">
                <div class="card m-3 cb1">           
                    <div class="card-header text-center">
                        <strong><?php echo $nome_temperatura . ": ". $valor_temperatura."ºC" ?></strong>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui tenetur accusamus corrupti laborum sapiente in est autem mollitia quaerat natus fugit ducimus assumenda quisquam rerum, ratione, labore, quas debitis iusto!    
                    </div>
                    <div class="card-footer">
                        06/04/2023
                    </div>
                </div>
            </div>               
            <div class="col-sm-4">
                <div class="card m-3 cb1">           
                    <div class="card-header text-center">
                        <strong><?php echo $nome_temperatura . ": ". $valor_temperatura."ºC" ?></strong>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi odio delectus rerum quia? Consectetur commodi laboriosam quae adipisci deleniti totam nemo? Ipsa exercitationem iusto fuga perferendis saepe quas sit veniam?
                    </div>
                    <div class="card-footer">
                        06/04/2023
                    </div>
                </div>               
            </div> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>