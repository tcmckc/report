<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
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
        $this->assertIsArray($res);
        $this->assertArrayHasKey("suit", $res);
    }
}