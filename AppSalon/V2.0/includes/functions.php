<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escape / Sanitize the HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function json_response($array, $code = 200)
{
    header("Content-Type: application/json; charset=UTF-8");
    http_response_code($code);
    return exit(json_encode($array));
}

function method()
{
    return $_SERVER['REQUEST_METHOD'];
}

function PUT()
{
    parse_str(file_get_contents('php://input'), $_PUT);
    return $_PUT;
}

function DELETE()
{
    parse_str(file_get_contents('php://input'), $_DELETE);
    return $_DELETE;
}