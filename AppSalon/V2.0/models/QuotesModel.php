<?php
namespace Model;

class QuotesModel extends ActiveRecord
{
    protected static $table = "quotes";
    protected static $columns = [
        'id',
        'user_name',
        'date_quote',
        'time_quote',
        'users_id',
    ];

    public $id;
    public $user_name;
    public $date_quote;
    public $time_quote;
    public $users_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user_name = $args['user_name'] ?? $args['name'] ?? '';
        $this->date_quote = $args['date_quote'] ?? $args['date'] ?? '';
        $this->time_quote = $args['time_quote'] ?? $args['time'] ?? '';
        $this->users_id = $args['user_id'] ?? null;
    }
}