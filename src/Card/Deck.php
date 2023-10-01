<?php

namespace App\Card;

use App\Card\Card;

class Deck extends Card
{
    public array $deck = [];
    public array $shuffle = [];

    public array $marks = ["❤️", "♦️", "♠️", "♣️"];
    public array $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    /**
     * Constructor for initializing the Deck
     */
    public function __construct()
    {
        //$this->deck = [];
        $this->deck = $this->getDeck();
    }

    /**
     * Generate a new deck of cards
     *
     * @return array An array representing a standard deck of cards with "mark" and "value" keys
     */
    public function getDeck()
    {
        $deck = [];

        foreach ($this->marks as $mark) {
            foreach ($this->values as $value) {
                $deck[] = [
                    "mark" => $mark,
                    "value" => $value,
                ];
            }
        }
        return $deck;
    }

    public function getShuffle($deckToShuffle = null)
    {
        if ($deckToShuffle === null) {
            $deckToShuffle = $this->deck;
        }
        shuffle($deckToShuffle);
        return $deckToShuffle;

    }

    public function shuffleDeck()
    {
        shuffle($this->deck);
        return $this->deck;
    }

    public function drawCard(int $num = 1)
    {
        $cards = [];

        for ($i = 0; $i < $num && $this->countCards() > 0; $i++) {
            $item = array_shift($this->deck);
            array_push($cards, $item);
        }

        return $cards;
    }

    public function countCards()
    {
        $counter = count($this->deck);

        return $counter;
    }
}
