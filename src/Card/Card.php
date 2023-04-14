<?php

namespace App\Card;

class Card
{
    private $card;

    public function setCard($mark, $value)
    {
        $this->card = array(
            "mark" => $mark,
            "value" => $value,
        );

        return $this->card;
    }
}
