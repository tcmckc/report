<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateGame()
    {
        $game = new Game();

        $res = $game->getGameDeck();
        $this->assertNotEmpty($res);
    }

    public function testGetPlayerHand()
    {
        $game = new Game();

        $res = $game->getPlayerHand();
        $this->assertEmpty($res);
        $this->assertIsArray($res);
    }

    public function testGetBankerHand()
    {
        $game = new Game();

        $res = $game->getBankerHand();
        $this->assertEmpty($res);
        $this->assertIsArray($res);
    }

    public function testPrepareGame()
    {
        $game = new Game();

        $res = $game->prepareGame();
        $this->assertNotEmpty($res);
        $this->assertIsArray($res);
    }

    public function testDrawCardForPlayer()
    {
        $game = new Game();

        $res = $game->drawCardForPlayer();
        $this->assertNotEmpty($res);
        $this->assertIsArray($res);
    }

    public function testPlayBanker()
    {
        $game = new Game();

        $res = $game->playBanker();
        $this->assertNotEmpty($res);
        $this->assertIsArray($res);
        $this->assertArrayHasKey("banker_hand", $res);
    }

    public function testGetScore()
    {
        $game = new Game();

        $res = $game->getScore("player");
        $this->assertIsInt($res);
        $this->assertGreaterThanOrEqual(0, $res);
    }

    public function testDetermineWinner()
    {
        $game = new Game();

        $res = $game->determineWinner(10, 20);
        $this->assertIsString($res);
        $this->assertEquals("Banker wins! Banker got more points than you.", $res);
    }
}