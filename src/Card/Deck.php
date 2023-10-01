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
        //$this->deck = [];
        $deck = [];

        foreach ($this->marks as $mark) {
            foreach ($this->values as $value) {
                $deck[] = [
                    "mark" => $mark,
                    "value" => $value,
                ];
            }
        }

        // for ($i = 0; $i < count($this->marks); $i++) {
        //     for ($ii = 0; $ii < count($this->values); $ii++) {
        //         $item = $card->setCard($this->marks[$i], $this->values[$ii]);

        //         array_push($this->deck, $item);
        //     }
        // }
        //return $this->deck;
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

        for ($i = 0; $i < $num; $i++) {
            if ($this->countCards() == 0) {
                break;
            } else {
                $item = array_shift($this->deck);
                array_push($cards, $item);
            }
        }

        return $cards;
    }

    public function countCards()
    {
        $counter = count($this->deck);

        return $counter;
    }
}
