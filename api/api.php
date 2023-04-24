<?php

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!isset($_POST['type']) || !isset($_POST['name']) || !isset($_POST['value']) || !isset($_POST['time'])){
        
        http_response_code(400);
        die("Missing parameters");
    }

    $timearray = str_split($_POST['time']);

    if($timearray[4] != "/" || $timearray[7] != "/" || $timearray[10] != " " || $timearray[11] != "-" || $timearray[12] != " " || $timearray[15] != ":" || $timearray[18] != ":")
    {
        http_response_code(422);
        die("Unsupported time format");
    }
    
    $year = intval($timearray[0] . $timearray[1] . $timearray[2] . $timearray[3],10);

    $month = intval($timearray[5] . $timearray[6],10);

    $day = intval($timearray[8] . $timearray[9],10);

    $hour = intval($timearray[13] . $timearray[14],10);

    $minute = intval($timearray[16] . $timearray[17],10);

    $seconds = intval($timearray[19] . $timearray[20],10);

    if(!checkdate($month,$day,$year) || $hour < 0 || $hour > 24 || $minute < 0 || $minute > 59 || $seconds <0 || $seconds > 59)
    {
        http_response_code(422);
        die("Invalid time");
    }


    $_POST['name'] = strtolower($_POST['name']);

    foreach (new DirectoryIterator('./files/') as $apifiles) {
        if(strcmp(substr($apifiles, 1),$_POST['type']) == 0)
        {
            $typedirectory = $apifiles->getBasename();
            break;
        }
    }

    if(!isset($typedirectory) || (!file_exists("files/". $typedirectory . "/" . $_POST['name']) && !is_dir("files/". $typedirectory . "/" . $_POST['name'])))
    {
        http_response_code(404);
        die("<h1> Not Found </h1><p>The requested URL was not found on this server.</p>"); 
    }

    $value = file_get_contents("files/". $typedirectory . "/" . $_POST['name'] . "/value.txt");

    if(is_numeric($value) xor is_numeric($_POST['value']))
    {
        http_response_code(422);
        die("Unsupported value");
    }

    if(!is_numeric($_POST['value']) == $value)
    {
        http_response_code(208);
        die("Already set");
    }

    if(is_numeric($_POST['value']) && $_POST['value'] == $value && strcmp(file_get_contents("files/". $typedirectory . "/" . $_POST['name'] . "/time.txt"),$_POST['time']) == 0)
    {
        http_response_code(208);
        die( "Already set");
    }
    
    $range = file("files/". $typedirectory . "/" . $_POST['name'] . "/range.txt", FILE_IGNORE_NEW_LINES);

    if(is_numeric($_POST['value']) && ($_POST['value'] < $range[0] || $_POST['value'] > $range[1]))
    {
        http_response_code(416);
        die( "Value exceeds the range");
    }

    if(!is_numeric($_POST['value']) &&
        strcmp($_POST['value'],"on") !=0 &&
        strcmp($_POST['value'],"off") !=0 &&
        strcmp($_POST['value'],"open") !=0 &&
        strcmp($_POST['value'],"close") !=0 &&
        strcmp($_POST['value'],"yes") !=0 &&
        strcmp($_POST['value'],"no") !=0)
    {
        http_response_code(422);
        die ("Unsupported value");
    }    

    file_put_contents("files/" . $typedirectory . "/" . $_POST['name'] . "/value.txt", $_POST['value']);
    file_put_contents("files/" . $typedirectory . "/" . $_POST['name'] . "/time.txt", $_POST['time']);
    file_put_contents("files/" . $typedirectory . "/" . $_POST['name'] . "/log.txt", $_POST['time'] . "; " . $_POST['value'] . PHP_EOL, FILE_APPEND);
    
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (!isset($_GET['type']) || !isset($_GET['name'])){
        
        http_response_code(400);
        die("Missing parameters");
    }

    $_GET['name'] = strtolower($_GET['name']);

    foreach (new DirectoryIterator('./files/') as $apifiles) {
        if(strcmp(substr($apifiles, 1),$_GET['type']) == 0)
        {
            $typedirectory = $apifiles->getBasename();
            break;
        }
    }

    if(!isset($typedirectory) || (!file_exists("files/". $typedirectory . "/" . $_GET['name']) && !is_dir("files/". $typedirectory . "/" . $_GET['name'])))
    {
        http_response_code(404);
        die("<h1> Not Found </h1><p>The requested URL was not found on this server.</p>"); 
    }
    $value = file_get_contents("files/". $typedirectory . "/" . $_GET['name'] . "/value.txt");

    echo "Value: " . $value ."<br>";

    if (is_numeric($value))
    {
        $range = file("files/". $typedirectory . "/" . $_GET['name'] . "/range.txt", FILE_IGNORE_NEW_LINES);
        $measurement = file_get_contents("files/". $typedirectory . "/" . $_GET['name'] . "/measurement.txt", FILE_IGNORE_NEW_LINES);
        echo "Measurement: " . $measurement ."<br>";
        echo "Min-value: " . $range[0] ."<br>";
        echo "Max-value: " . $range[1] ."<br>";
    }
   
} else
{
    echo "Unauthorized method\n";
    http_response_code(403);
}
