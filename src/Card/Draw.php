<?php

namespace App\Card;

class Draw extends Card
{
    public array $draw = [];
    public $counter = 52;

    public function getDraw(int $num=1)
    {
        $deck = new \App\Card\Deck();
        $deckArr = $deck->getDeck();
        $i = random_int(0, 51);
        $this->draw = $deckArr[$i];
        return $this->draw;
    }

    public function counter($count)
    {
        $cardsLeft = $count - 1;
        return $cardsLeft;
    }
}
