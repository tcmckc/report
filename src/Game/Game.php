<?php

namespace App\Game;

use App\Game\Deck;
use App\Game\Score;

class Game
{
    private Deck $deck;
    private $player;
    private $banker;
    private Score $score;

    public function __construct()
    {
        $this->deck = new Deck();
        $this->deck->shuffleDeck();
        $this->player = [];
        $this->banker = [];
        $this->score = new Score();
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
        $player_hand = $this->getPlayerHand();
        $banker_hand = $this->getBankerHand();

        $player_score = empty($player_hand) ? 0 : $this->getScore("player");
        $banker_score = empty($banker_hand) ? 0 : $this->getScore("banker");

        return [
            "game_deck" => $this->getGameDeck(),
            "player_hand" => $player_hand,
            "player_score" => $player_score,
            "banker_hand" => $banker_hand,
            "banker_score" => $banker_score,
            "result" => null,
        ];
    }

    public function drawCardForPlayer(): array
    {
        $drawn_card = $this->deck->drawCard();
        $this->player = $this->addCard($drawn_card, "player");
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
        } else {
            $this->banker[] = $card;
            return $this->banker;
        }
    }

    public function playBanker(): array
    {
        $game_deck = $this->getGameDeck();
        $banker_hand = $this->getBankerHand();
        $banker_score = $this->getScore("banker");

        while ($banker_score < 17) {
            $drawn_card = $game_deck->drawCard();
            $banker_hand = $this->addCard($drawn_card, "banker");
            $banker_score = $this->getScore("banker");
        }

        return [
            "banker_hand" => $banker_hand,
            "banker_score" => $banker_score,
        ];

    }

    public function getScore($who)
    {
        $hand = ($who === 'player') ? $this->player : $this->banker;

        $score = 0;

        foreach ($hand as $card) {
            $value = $card['value'];

            if (is_numeric($value)) {
                $score += (int)$value;
            } elseif ($value === 'A') {
                $score += 1;
            } elseif ($value === 'J') {
                $score += 11;
            } elseif ($value === 'Q') {
                $score += 12;
            } elseif ($value === 'K') {
                $score += 13;
            } else {
                $score += 10;
            }
        }

        return $score;
    }

}
