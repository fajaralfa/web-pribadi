<?php

namespace App\Model;

use App\Helper;

abstract class Model
{
    public \PDO $db;

    public function __construct()
    {
        $this->db = db();
    }
}
