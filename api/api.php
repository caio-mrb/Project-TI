<?php

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //Verify if all parameters are set
    if (!isset($_POST['type']) || !isset($_POST['name']) || !isset($_POST['value']) || !isset($_POST['time'])){
        
        http_response_code(400);
        die("Missing parameters");
    }


    //Divide time into array to check validity of input

    $timearray = str_split($_POST['time']);

    if($timearray[4] != "/" || $timearray[7] != "/" || $timearray[10] != " " || $timearray[11] != "-" || $timearray[12] != " " || $timearray[15] != ":" || $timearray[18] != ":")
    {
        http_response_code(422);
        die("Unsupported time format");
    }

    //Set variables with respective values
    
    $year = intval($timearray[0] . $timearray[1] . $timearray[2] . $timearray[3],10);

    $month = intval($timearray[5] . $timearray[6],10);

    $day = intval($timearray[8] . $timearray[9],10);

    $hour = intval($timearray[13] . $timearray[14],10);

    $minute = intval($timearray[16] . $timearray[17],10);

    $seconds = intval($timearray[19] . $timearray[20],10);

    //Validate time

    if(!checkdate($month,$day,$year) || $hour < 0 || $hour > 24 || $minute < 0 || $minute > 59 || $seconds <0 || $seconds > 59)
    {
        http_response_code(422);
        die("Invalid time");
    }

    //Srt to low to parameters be compared

    $_POST['name'] = strtolower($_POST['name']);
    $_POST['type'] = strtolower($_POST['type']);

    //Search for a directory equal type input

    foreach (new DirectoryIterator('./files/') as $apifiles) {
        if(strcmp(substr($apifiles, 1),$_POST['type']) == 0)
        {
            $typedirectory = $apifiles->getBasename();
            break;
        }
    }

    //If not found a directory with same name, return a 'Not Found' error

    if(!isset($typedirectory) || (!file_exists("files/". $typedirectory . "/" . $_POST['name']) && !is_dir("files/". $typedirectory . "/" . $_POST['name'])))
    {
        http_response_code(404);
        die("<h1> Not Found </h1><p>The requested URL was not found on this server.</p>"); 
    }


    //Set value

    $value = file_get_contents("files/". $typedirectory . "/" . $_POST['name'] . "/value.txt");


    //Compare if the value in file are the same type (int or str), if not, return 'Unsuported value'
    //Validation made with xor because only when two values have the same type needs return an error
    if(is_numeric($value) xor is_numeric($_POST['value']))
    {
        http_response_code(422);
        die("Unsupported value");
    }

    //If its a binary type, dont need to update if have the same value as the previous one

    if(!is_numeric($_POST['value']) && strcmp($_POST['value'],$value) == 0)
    {
        http_response_code(208);
        die("Already set");
    }

    //If its a numeric type, when have same value and same date, the input is considered equal    

    if(is_numeric($_POST['value']) && $_POST['value'] == $value && strcmp(file_get_contents("files/". $typedirectory . "/" . $_POST['name'] . "/time.txt"),$_POST['time']) == 0)
    {
        http_response_code(208);
        die( "Already set");
    }
    
    //Set range

    $range = file("files/". $typedirectory . "/" . $_POST['name'] . "/range.txt", FILE_IGNORE_NEW_LINES);

    //Verify if value exceeds the range

    if(is_numeric($_POST['value']) && ($_POST['value'] < $range[0] || $_POST['value'] > $range[1]))
    {
        http_response_code(416);
        die( "Value exceeds the range");
    }

    //If its a binary type, verify if input are valid for each sensor, because a sensor that receive On or Off,
    //cant receive Open or Closed for example

    if (!is_numeric($_POST['value']))
    {
    $_POST['value'] = ucfirst(strtolower($_POST['value']));

    switch($_POST['value']){
        case 'On':
        case 'Off':
            if(strcmp($value,"On")!=0 && strcmp($value,"Off")!=0)
                goto error;
            break;

        case 'Open':
        case 'Closed':
            if(strcmp($value,"Open")!=0 && strcmp($value,"Closed")!=0)
                goto error;
            break;

        case 'Yes':
        case 'No':
            if(strcmp($value,"Yes")!=0 && strcmp($value,"No")!=0)
                goto error;
            break;
        
        default:
        error:
        http_response_code(422);
        die ("Unsupported value");
    }

    }  

    //If pass all conditions, update values and write into log file

    file_put_contents("files/" . $typedirectory . "/" . $_POST['name'] . "/value.txt", $_POST['value']);
    file_put_contents("files/" . $typedirectory . "/" . $_POST['name'] . "/time.txt", $_POST['time']);
    file_put_contents("files/" . $typedirectory . "/" . $_POST['name'] . "/log.txt", $_POST['time'] . "; " . $_POST['value'] . PHP_EOL, FILE_APPEND);
    
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

    //Verify if all parameters are set

    if (!isset($_GET['type']) || !isset($_GET['name'])){
        
        http_response_code(400);
        die("Missing parameters");
    }

    //Str to low to be compared

    $_GET['name'] = strtolower($_GET['name']);

    //Search for directory equal input value

    foreach (new DirectoryIterator('./files/') as $apifiles) {
        if(strcmp(substr($apifiles, 1),$_GET['type']) == 0)
        {
            $typedirectory = $apifiles->getBasename();
            break;
        }
    }

    //If isnt set or dont exist, return a 'Not Found' error

    if(!isset($typedirectory) || (!file_exists("files/". $typedirectory . "/" . $_GET['name']) && !is_dir("files/". $typedirectory . "/" . $_GET['name'])))
    {
        http_response_code(404);
        die("<h1> Not Found </h1><p>The requested URL was not found on this server.</p>"); 
    }

    //Set value
    $value = file_get_contents("files/". $typedirectory . "/" . $_GET['name'] . "/value.txt");

    //Print value
    echo "Value: " . $value ."<br>";

    //If is numeric, beyond value, also prints unit of measurement and min and max possible values
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
    //If been requested another method, return an error
    echo "Unauthorized method\n";
    http_response_code(403);
}
