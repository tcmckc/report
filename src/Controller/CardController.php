<?php

namespace App\Controller;

use App\Card\Deck;
use App\Card\Card;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function home(): Response
    {
        return $this->render('card/home.html.twig');
    }

    #[Route("/card/deck", name: "card-deck")]
    public function deck(
        SessionInterface $session
    ): Response {
        $cardObj = new Card();
        $deckObj = new Deck();
        $session->set("deck", $deckObj);

        $data = [
            'title' => 'Deck',
            'deck' => $deckObj->getDeck($cardObj),
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "card-deck-shuffle")]
    public function shuffle(
        SessionInterface $session
    ): Response {
        $deck = $session->get('deck');

        $data = [
            'title' => 'Shuffle',
            'deck' => $deck->getShuffle(),
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/draw", name: "card-deck-draw")]
    public function drawOne(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session->get('deck');
        $drawedCard = $deck->drawCard();
        $counter = $deck->countCards();

        $data = [
            'title' => 'Draw',
            'draw' => $drawedCard,
            'counter' => $counter,
        ];

        return $this->render('card/deck-draw.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num}", name: "card-deck-draw-many")]
    public function drawMany(
        SessionInterface $session,
        int $num = 1
    ): Response {
        if ($num > 51) {
            throw new \Exception("You cannot draw so many cards!");
        }

        $deck = $session->get('deck');
        $drawedCard = $deck->drawCard($num);
        $counter = $deck->countCards();

        $data = [
            'draw' => $drawedCard,
            'counter' => $counter,
        ];

        return $this->render('card/deck-draw.html.twig', $data);
    }

}
