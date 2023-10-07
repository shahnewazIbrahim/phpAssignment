<?php

namespace App\Database\MySQL;

class Connection
{
    public function __construct(private string $databaseUrl = "mysql:db:3302")
    {
    }
}
