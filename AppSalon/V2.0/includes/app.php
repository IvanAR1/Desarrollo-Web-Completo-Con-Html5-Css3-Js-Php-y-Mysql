<?php 

require 'functions.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// Connecting to database
use Model\ActiveRecord;
ActiveRecord::setDB(connection());