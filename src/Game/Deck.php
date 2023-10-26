<?php

namespace App\Game;

use App\Card\Card;

class Deck extends Card
{
    private array $cards;

    /**
     * Constructor for initializing the Deck
     */
    public function __construct()
    {
        $this->cards = [];

        $suits = ["❤️", "♦️", "♠️", "♣️"];
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {

                $score = ($value === 'A') ? 1 : (($value === 'J') ? 11 : (($value === 'Q') ? 12 : (($value === 'K') ? 13 : (int) $value)));

                $this->cards[] = [
                    "suit" => $suit,
                    "value" => $value,
                    "score" => $score,
                ];
            }
        }
    }

    public function shuffleDeck()
    {
        shuffle($this->cards);
    }

    public function drawCard()
    {
        $drawnCard = $this->cards[0];
        array_shift($this->cards);
        return $drawnCard;
    }

    public function getRemainingCards()
    {
        return $this->cards;
    }

}
