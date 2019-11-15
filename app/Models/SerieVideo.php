<?php

namespace App\Models;

class SerieVideo
{
    public $id;
    public $key;
    public $name;
    public $type;

    public function __construct(string $id, string $key, string $name, string $type)
    {
        $this->id = $id;
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
    }
}
