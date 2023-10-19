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
    }

    public function testGetBankerHand()
    {
        $game = new Game();

        $res = $game->getBankerHand();
        $this->assertEmpty($res);
    }

    public function testPrepareGame()
    {
        $game = new Game();

        $res = $game->prepareGame();
        $this->assertNotEmpty($res);
    }

    public function testDrawCardForPlayer()
    {
        $game = new Game();

        $res = $game->drawCardForPlayer();
        $this->assertNotEmpty($res);
    }

    public function testPlayBanker()
    {
        $game = new Game();

        $res = $game->playBanker();
        $this->assertNotEmpty($res);
    }

    public function testGetScore()
    {
        $game = new Game();

        $res = $game->getScore("player");
        $this->assertIsInt($res);
    }
}