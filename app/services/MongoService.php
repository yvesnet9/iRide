<?php

namespace App\Services;

use MongoDB\Client;

class MongoService
{
    protected Client $client;
    protected $database;

    public function __construct()
    {
        $this->client = new Client(env('MONGO_URI'));
        $this->database = $this->client->selectDatabase(env('MONGO_DB'));
    }

    public function collection(string $name)
    {
        return $this->database->selectCollection($name);
    }
}
