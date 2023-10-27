<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Share;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ShareRepository;

class ProjectController extends AbstractController
{
    #[Route("/proj", name: "project")]
    public function showShare(
        ShareRepository $ShareRepository
    ): Response {
        $share = $ShareRepository->findAll();

        return $this->render('project/home.html.twig', [
            'constoller_name' => "ShareController",
            'share' => $share
        ]);
    }
    // #[Route("/proj", name: "project")]
    // public function showShare(
    // ): Response {
        
    //     return $this->render('project.html.twig');
    // }
    #[Route("/proj/about", name: "project-about")]
    public function showAbout(): Response {

        return $this->render('project/about.html.twig');
    }

    #[Route("/proj/about/database", name: "project-db")]
    public function showAboutDb(
    ): Response {
        
        return $this->render('project/db.html.twig');
    }

    #[Route("/proj/api", name: "project-api")]
    public function showAPI(
    ): Response {
        
        return $this->render('project/api.html.twig');
    }

    #[Route("/proj/api/share", name: "project-api-share", methods: ['GET'])]
    public function getAPIShare(
        ShareRepository $ShareRepository
    ): Response {
        $data = $ShareRepository->findAll();
        return new JsonResponse($data);
    }
}