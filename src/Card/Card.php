<?php

namespace App\Card;

class Card
{
    private $card;

    /**
     * Set the card data with a mark and value.
     *
     * @param string $mark  The mark of the card (e.g., "❤️", "♦️").
     * @param string $value The value of the card (e.g., "A", "2", "K").
     *
     * @return array The card data as an associative array with "mark" and "value" keys.
     */
    public function setCard($mark, $value)
    {
        $this->card = array(
            "mark" => $mark,
            "value" => $value,
        );

        return $this->card;
    }
}
