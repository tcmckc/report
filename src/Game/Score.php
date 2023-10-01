<?php

namespace App\Game;

class Score
{
    private int $score;

    public function __construct()
    {
        $this->score = 0;

    }

    public function determineWinner($playerScore, $bankerScore): string
    {
        if ($bankerScore > 21) {
            return "You win! Banker got more than 21 points.";
        } elseif ($playerScore > $bankerScore) {
            return "You win! You got more points than banker.";
        } elseif ($playerScore < $bankerScore) {
            return "Banker wins! Banker got more points than you.";
        } else {
            return "It's a tie! You and banker got the same points.";
        }
    }
}
