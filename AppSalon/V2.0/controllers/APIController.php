<?php
namespace Controllers;

use Model\ServicesModel as Services;
use Model\QuotesModel as Quotes;
use Model\ServiceQuotesModel as ServiceQuotes;

class APIController
{
    public function index()
    {
        if(!isAuth()){
            return json_response(["message"=>"No autorizado"], 401);
        }
        $services = new Services();
        return json_response(["message"=>$services->all()]);
    }

    public function store()
    {
        if(!isAuth()){
            return json_response(["message"=>"No autorizado"], 401);
        }
        $quote = new Quotes(array_merge($_POST["quotes"], ["user_id"=>$_SESSION["user_id"]]));
        list("id"=>$quoteId) = $quote->save();
        foreach($_POST["quotes"]["services"] as $service){
            $serviceQuote = new ServiceQuotes([
                "quote_id" => $quoteId,
                "service_id" => $service["id"],
            ]);
            $serviceQuote->save();
        }
        return json_response(["message"=>"Cita creada correctamente", "status"=>"OK"]);
    }
}