<?php

namespace App\Game;

use App\Game\Deck;

class Game
{
    private Deck $deck;
    private $player;
    private $banker;

    /**
     * Constructor for initializing the Game
     */
    public function __construct()
    {
        $this->deck = new Deck();
        $this->deck->shuffleDeck();
        $this->player = [];
        $this->banker = [];
    }

    /**
     * Get the value of deck
     */
    public function getGameDeck()
    {
        return $this->deck;
    }

    /**
     * Get the value of player
     */
    public function getPlayerHand()
    {
        return $this->player;
    }

    /**
     * Get the value of banker
     */
    public function getBankerHand()
    {
        return $this->banker;
    }

    /**
     * Get the value of player
     */
    public function prepareGame(): array
    {
        $playerHand = $this->getPlayerHand();
        $bankerHand = $this->getBankerHand();

        $playerScore = empty($playerHand) ? 0 : $this->getScore("player");
        $bankerScore = empty($bankerHand) ? 0 : $this->getScore("banker");

        return [
            "game_deck" => $this->getGameDeck(),
            "player_hand" => $playerHand,
            "player_score" => $playerScore,
            "banker_hand" => $bankerHand,
            "banker_score" => $bankerScore,
            "result" => null,
        ];
    }

    /**
     * Get the value of player
     */
    public function drawCardForPlayer(): array
    {
        $drawnCard = $this->deck->drawCard();
        $this->player = $this->addCard($drawnCard, "player");
        return [
            "player_hand" => $this->player,
            "player_score" => $this->getScore("player"),
            "banker_hand" => $this->banker,
            "banker_score" => $this->getScore("banker"),
        ];
    }

    /**
     * Add card to player or banker hand
     */
    public function addCard($card, $who)
    {
        if ($who === 'player') {
            $this->player[] = $card;
            return $this->player;
        }
        $this->banker[] = $card;
        return $this->banker;
    }

    /**
     * Get the value of player
     */
    public function playBanker(): array
    {
        $gameDeck = $this->getGameDeck();
        $bankerHand = $this->getBankerHand();
        $bankerScore = $this->getScore("banker");

        while ($bankerScore < 17) {
            $drawnCard = $gameDeck->drawCard();
            $bankerHand = $this->addCard($drawnCard, "banker");
            $bankerScore = $this->getScore("banker");
        }

        return [
            "banker_hand" => $bankerHand,
            "banker_score" => $bankerScore,
        ];

    }

    /**
     * Get the value of player
     */
    // public function getScore($who)
    // {
    //     $hand = ($who === 'player') ? $this->player : $this->banker;

    //     $score = 0;

    //     foreach ($hand as $card) {
    //         $value = $card['value'];

    //         $score += (is_numeric($value)) ? (int) $value : (($value === 'A') ? 1 : (($value === 'J') ? 11 : (($value === 'Q') ? 12 : (($value === 'K') ? 13 : 10))));
    //     }

    //     return $score;
    // }
    public function getScore($who)
    {
        $hand = ($who === 'player') ? $this->player : $this->banker;

        $score = 0;
        $cardValues = [
            'A' => 1,
            '2' => 2, '3' => 3, '4' => 4, '5' => 5,
            '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
            'J' => 10, 'Q' => 10, 'K' => 10
        ];

        foreach ($hand as $card) {
            $value = $card['value'];

            $score += $cardValues[$value];
        }

        return $score;
    }

    /**
     * Determine who is the winner
     */
    public function determineWinner($playerScore, $bankerScore): string
    {
        if ($bankerScore > 21) {
            return "You win! Banker got more than 21 points.";
        } elseif ($playerScore > $bankerScore) {
            return "You win! You got more points than banker.";
        } elseif ($playerScore < $bankerScore) {
            return "Banker wins! Banker got more points than you.";
        }

        return "It's a tie! You and banker got the same points.";
    }

}
