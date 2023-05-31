<?php
namespace Model;

class ServicesModel extends ActiveRecord
{
    protected static $table = "services";
    protected static $column = [
        'id',
        'services_name',
        'services_price',
    ];

    public $id;
    public $services_name;
    public $services_price;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->services_name = $args['services_name'] ?? '';
        $this->services_price = $args['services_price'] ?? '';
    }
}