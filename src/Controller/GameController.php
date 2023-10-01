<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Card\Card;
use App\Game\Deck;
use App\Game\Game;
use App\Game\Score;

class GameController extends AbstractController
{
    /**
     * @Route("/game/", name="game")
     *
     * Print out rule and start button
     */
    public function game(): Response
    {
        return $this->render('game/home.html.twig');
    }

    /**
     * @Route("/game/board", name="game-board")
     *
     * Prepare the game with a deck of cards, player and banker hands & scores
     */
    public function gameBoard(SessionInterface $session, Request $request): Response
    {
        $game = $session->get("game") ?? new Game();
        $session->set("game", $game);
        $data = $game->prepareGame();

        return $this->render('game/board.html.twig', $data);
    }

    /**
     * @Route("/game/draw-card", name="draw-card", methods={"POST"})
     *
     * Draw a card from the deck and add it to the player's hand
    */
    public function drawCard(SessionInterface $session, Request $request): Response
    {
        $game = $session->get("game");
        $data = $game->drawCardForPlayer();
        $result = ($data["player_score"] > 21) ? "Banker wins! You got more than 21 points." : null;
        $data["result"] = $result;

        return $this->render(($result ? "game/board-end.html.twig" : "game/board.html.twig"), $data);
    }

    /**
     * @Route("/game/stay", name= "stay", methods={"POST"})
     *
     */
    public function stay(SessionInterface $session, Score $score): Response
    {
        $game = $session->get("game");
        $bankerData = $game->playBanker();

        $player_score = $game->getScore("player");
        $banker_score = $bankerData["banker_score"];

        $result = $score->determineWinner($player_score, $banker_score);

        $data = [
            "player_hand" => $game->getPlayerHand(),
            "game_deck" => $game->getGameDeck(),
            "player_score" => $player_score,
            "banker_hand" => $bankerData["banker_hand"],
            "banker_score" => $banker_score,
            "result" => $result,
        ];

        return $this->render("game/board-end.html.twig", $data);
    }

    /**
     * @Route("/game/reset", name="game-reset")
     */
    public function reset(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute("game-board");
    }

    /**
     * @Route("/game/doc", name="game-doc")
     */
    public function gameDoc(): Response
    {
        return $this->render('game/doc.html.twig');
    }
}
