<?php

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!file_exists( "files/" . $_POST['name']) && !is_dir( "files/" . $_POST['name']) && isset($_POST['name']))
    {
        echo "<h1> Not Found </h1><p>The requested URL was not found on this server.</p>";
        http_response_code(404);
    }
    elseif (isset($_POST['name']) && isset($_POST['value']) && isset($_POST['time'])) {
        file_put_contents("files/" . $_POST['name'] . "/value.txt", $_POST['value']);
        file_put_contents("files/" . $_POST['name'] . "/time.txt", $_POST['time']);
        file_put_contents("files/" . $_POST['name'] . "/log.txt", $_POST['time'] . ";" . $_POST['value'] . PHP_EOL, FILE_APPEND);
    } else {
        echo "Missing parameters";
        http_response_code(400);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    if(!file_exists( "files/" . $_GET['name']) && !is_dir( "files/" . $_GET['name']) && isset($_GET['name']))
    {
        echo "<h1> Not Found </h1><p>The requested URL was not found on this server.</p>";
        http_response_code(404);
    }
    if (isset($_GET['name']))
        echo file_get_contents("files/" . $_GET['name'] . "/value.txt");
    else
    {
        echo "Missing parameters";
        http_response_code(400);
    }
} else
{
    echo "Unauthorized method\n";
    http_response_code(403);
}
