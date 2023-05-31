<?php
namespace Controllers;

use Model\ServicesModel as Services;
use Router\Router;

class APIController
{
    public function index()
    {
        $services = new Services();
        return json_response(["message"=>$services->all()]);
    }
}