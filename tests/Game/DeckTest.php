<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDeck()
    {
        $deck = new Deck();
        $res = $deck->shuffleDeck();
        $originalDeck = $deck->getRemainingCards();
        $this->assertNotEquals($originalDeck, $res);
    }

    public function testDrawCard()
    {
        $deck = new Deck();
        $res = $deck->drawCard();
        $this->assertNotEmpty($res);
    }
}