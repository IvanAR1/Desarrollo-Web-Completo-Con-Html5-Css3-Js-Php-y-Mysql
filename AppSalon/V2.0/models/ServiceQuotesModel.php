<?php
namespace Model;

class ServiceQuotesModel extends ActiveRecord
{
    protected static $table = "services_quotes";
    protected static $columns = [
        'id',
        'services_id',
        'quotes_id',
    ];

    public $id;
    public $services_id;
    public $quotes_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->services_id = $args['service_id'] ?? '';
        $this->quotes_id = $args['quote_id'] ?? '';
    }
}