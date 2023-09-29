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
use App\Game\Hand;
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
     */
    public function gameBoard(SessionInterface $session, Request $request): Response 
    {
        $game = $session->get("game") ?? new Game();
        $session->set("game", $game);

        $game_deck = $game->getGameDeck();
        $player_hand = $game->getPlayerHand();

        $data = [
            "game_deck" => $game_deck,
            "player_hand" => $player_hand,
            "player_score" => 0,
            "result" => null,
        ];

        return $this->render('game/board.html.twig', $data);
    }

    /** 
     * @Route("/game/draw-card", name="draw-card", methods={"POST"})
    */
    public function drawCard(SessionInterface $session, Request $request): Response 
    {
        $game = $session->get("game");
        $game_deck = $game->getGameDeck();
        $drawn_card = $game_deck->drawCard();
        $player_hand = $game->addCard($drawn_card);

        $player_score = $game->getScore("player");

        if ($player_score > 21) {
            $data = [
                "player_hand" => $player_hand,
                "game_deck" => $game_deck,
                "player_score" => $player_score,
                "result" => "Banker wins! You got more than 21 points.",
            ];

            return $this->render("game/board-end.html.twig", $data);
        }

        $data = [
            "player_hand" => $player_hand,
            "game_deck" => $game_deck,
            "player_score" => $player_score,
            "result" => null,
        ];

        return $this->render("game/board.html.twig", $data);
        

        $data = [
            'player_cards' => $player_cards,
        ];

        return $this->redirectToRoute('game-board', $data);
    }

    /**
     * @Route("/game/reset", name="game-reset")
     */
    public function reset(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute("game-board");
    }

    #[Route("/game/doc", name: "game-doc")]
    public function gameDoc(): Response {
        return $this->render('game/doc.html.twig');
    }
}
