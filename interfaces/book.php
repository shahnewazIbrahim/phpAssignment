<?php

interface Book {
    public function getPages(): int;
    public function setName(): string;
}

class Library implements Book {

    public int $pages = 0;
    public function getPages():int{
        return 0;
    }
    public function setName(): string{
        
        return "0";
    }
}