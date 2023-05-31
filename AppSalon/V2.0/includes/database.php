<?php
use Dotenv\Dotenv;

function connection() : mysqli
{
    $dotenv = Dotenv::createImmutable('..');
    $dotenv->load();
    
    try {
        $db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
        mysqli_set_charset($db, 'utf8');
    }
    catch (mysqli_sql_exception $e) {
        mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
        echo "Error: Could not connect to MySQL.";
        echo " | debug error: " . mysqli_connect_errno();
        echo " | debug error: " . mysqli_connect_error();
        exit;
    }
    return $db;
}