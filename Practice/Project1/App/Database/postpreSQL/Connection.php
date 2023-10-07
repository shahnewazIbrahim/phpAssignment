<?php

namespace App\Database\postpreSQL;

class postpreSQL
{
    public function __construct(private string $databaseURL = "postSql:db:3033")
    {
    }
}
