<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    #[Route("/api/", name: "api", methods: ['GET'])]
    public function api(): Response
    {
        $data = [
            'title' => 'API',
            'link_to_quote' => $this->generateUrl('quote'),
            'link_to_deck' => $this->generateUrl('api-deck'),
            'link_to_deck_shuffle' => $this->generateUrl('api-deck-shuffle')


        ];
        return $this->render('api/home.html.twig', $data);
    }

    #[Route("/api/deck", name: "api-deck")]
    public function deck(
        SessionInterface $session
    ): Response {
        $cardObj = new \App\Card\Card();
        $deckObj = new \App\Card\Deck();
        $session->set("deck", $deckObj);
        $data = [
            'title' => 'Deck',
            'deck' => $deckObj->getDeck($cardObj),
        ];
        return new JsonResponse($data);
    }

    #[Route('/api/deck/shuffle', name: 'api-deck-shuffle', methods: ['POST'])]
    public function shuffleDeck(
        Request $request,
        SessionInterface $session
    ): JsonResponse {
        $deck = $session->get('deck');

        return new JsonResponse([
            'title' => 'Shuffled deck',
            'deck' => $deck->getShuffle(),
        ]);
    }

    #[Route('/api/deck/draw', name: 'api-deck-draw', methods: ['POST'])]
    public function drawDeck(
        Request $request,
        SessionInterface $session
    ): JsonResponse {
        $deck = $session->get('deck');
        $drawedCard = $deck->drawCard();
        $counter = $deck->countCards();

        return new JsonResponse([
            'title' => 'Drawed deck',
            'draw' => $drawedCard,
            'counter' => $counter,
        ]);
    }

    #[Route('/api/deck/draw/:{num<\d+>}', name: 'api-deck-draw-many', methods: ['POST'])]
    public function drawDeckMany(
        Request $request,
        SessionInterface $session,
        int $num
    ): JsonResponse {
        if ($num > 51) {
            throw new \Exception("Can not drew so many cards!");
        }

        $deck = $session->get('deck');
        $drawedCard = $deck->drawCard($num);
        $counter = $deck->countCards();

        return new JsonResponse([
            'title' => 'Drawed deck',
            'draw' => $drawedCard,
            'counter' => $counter,
        ]);
    }
}
