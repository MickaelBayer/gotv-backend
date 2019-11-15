<?php

namespace App\Models;

class SerieCast
{
    public $id;
    public $character;
    public $name;
    public $profile_path;
    public $order;

    public function __construct(string $id, string $character, string $name, string $profile_path, string $order)
    {
        $this->id = $id;
        $this->character = $character;
        $this->name = $name;
        $this->profile_path = $profile_path;
        $this->order = $order;
    }
}
