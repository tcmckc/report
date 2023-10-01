<?php

namespace App\Game;

class Hand
{
    private array $cards = [];

    public function __construct()
    {
        $this->cards = [];

    }


    public function addCard(array $card)
    {
        array_push($card);
    }

}
