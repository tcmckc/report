<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Share;
use App\Entity\Cloud;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ShareRepository;
use App\Repository\CloudRepository;

class ProjectController extends AbstractController
{
    #[Route("/proj", name: "project")]
    public function showShare(
        ShareRepository $ShareRepository,
        CloudRepository $cloudRepository
    ): Response {
        $share = $ShareRepository->findAll();

        $aws = new Cloud();
        $aws->setShare(32);
        $aws->setLaunch(2006);
        $aws->setOwner('Amazon');
        $aws->setRevenue(80);
        $aws->setPricing(69);
        $aws->setStorage('Elastic File System');
        $aws->setVn('Amazon VPC');
        $aws->setApi('Amazon API Gateway');
        $cloudRepository->saveCloud($aws);

        $azure = new Cloud();
        $azure->setShare(22);
        $azure->setLaunch(2010);
        $azure->setOwner('Microsoft');
        $azure->setRevenue(34);
        $azure->setPricing(70);
        $azure->setStorage('AzureFiles');
        $azure->setVn('Azure Virtual Network');
        $azure->setApi('Azure API Management');
        $cloudRepository->saveCloud($azure);

        $gcp = new Cloud();
        $gcp->setShare(11);
        $gcp->setLaunch(2008);
        $gcp->setOwner('Google');
        $gcp->setRevenue(26.3);
        $gcp->setPricing(52);
        $gcp->setStorage('Cloud Filestore');
        $gcp->setVn('VPC');
        $gcp->setApi('Apigee');
        $cloudRepository->saveCloud($gcp);

        return $this->render('project/home.html.twig', [
            'constoller_name' => "ShareController",
            'share' => $share,
            'aws' => $aws,
            'azure' => $azure,
            'gcp' => $gcp,
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