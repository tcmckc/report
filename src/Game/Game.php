<?php

namespace App\Game;

use App\Game\Deck;

class Game
{
    private Deck $deck;
    private $player;
    private $banker;

    public function __construct()
    {
        $this->deck = new Deck();
        $this->deck->shuffleDeck();
        $this->player = [];
        $this->banker = [];
    }

    public function getGameDeck()
    {
        return $this->deck;
    }

    public function getPlayerHand()
    {
        return $this->player;
    }

    public function getBankerHand()
    {
        return $this->banker;
    }

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

    public function addCard($card, $who)
    {
        if ($who === 'player') {
            $this->player[] = $card;
            return $this->player;
        }
        $this->banker[] = $card;
        return $this->banker;
    }

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

    public function getScore($who)
    {
        $hand = ($who === 'player') ? $this->player : $this->banker;

        $score = 0;

        foreach ($hand as $card) {
            $value = $card['value'];

            $score += (is_numeric($value)) ? (int) $value : (($value === 'A') ? 1 : (($value === 'J') ? 11 : (($value === 'Q') ? 12 : (($value === 'K') ? 13 : 10))));
        }

        return $score;
    }

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
