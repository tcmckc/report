<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuoteController extends AbstractController
{
    #[Route("/api/quote", name: "quote")]
    public function quote(): Response
    {
        $quote = [
            [
                "id" => 1,
                "author" => "Albert Einstein",
                "text" => "Imagination is more important than knowledge."
            ],
            [
                "id" => 2,
                "author" => "Maya Angelou",
                "text" => "I've learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel."
            ],
            [
                "id" => 3,
                "author" => "Nelson Mandela",
                "text" => "Education is the most powerful weapon which you can use to change the world."
            ],
            [
                "id" => 4,
                "author" => "Steve Jobs",
                "text" => "Innovation distinguishes between a leader and a follower."
            ],
            [
                "id" => 5,
                "author" => "Oprah Winfrey",
                "text" => "The biggest adventure you can ever take is to live the life of your dreams."
            ]
        ];

        $randomQuote = $quote[array_rand($quote)];

        $data = [
            'Date' => date('Y-m-d'),
            'Time' => date('H:i:s'),
            'Quote of the day' => $randomQuote,
        ];
        
        return new JsonResponse($data);
    }
}
