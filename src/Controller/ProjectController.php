<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route("/proj/api/aws", name: "project-api-aws", methods: ['GET'])]
    public function getAPIAws(
        CloudRepository $cloudRepository
    ): JsonResponse {
        $awsData = $cloudRepository->findOneBy(['owner' => 'Amazon']); // Assuming 'owner' is the field name in your Cloud entity
        if (!$awsData) {
            return new JsonResponse(['error' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'share' => $awsData->getShare(),
            'launch' => $awsData->getLaunch(),
            'owner' => $awsData->getOwner(),
            'revenue' => $awsData->getRevenue(),
            'pricing' => $awsData->getPricing(),
            'storage' => $awsData->getStorage(),
            'vn' => $awsData->getVn(),
            'api' => $awsData->getApi(),
        ];

        return new JsonResponse($data);
    }

    #[Route("/proj/api/azure", name: "project-api-azure", methods: ['GET'])]
    public function getAPIAzure(
        CloudRepository $cloudRepository
    ): JsonResponse {
        $azureData = $cloudRepository->findOneBy(['owner' => 'Microsoft']); // Assuming 'owner' is the field name in your Cloud entity for Azure
        if (!$azureData) {
            return new JsonResponse(['error' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'share' => $azureData->getShare(),
            'launch' => $azureData->getLaunch(),
            'owner' => $azureData->getOwner(),
            'revenue' => $azureData->getRevenue(),
            'pricing' => $azureData->getPricing(),
            'storage' => $azureData->getStorage(),
            'vn' => $azureData->getVn(),
            'api' => $azureData->getApi(),
        ];

        return new JsonResponse($data);
    }
    #[Route("/proj/api/gcp", name: "project-api-gcp", methods: ['GET'])]
    public function getAPIGCP(
        CloudRepository $cloudRepository
    ): JsonResponse {
        $gcpData = $cloudRepository->findOneBy(['owner' => 'Google']); // Assuming 'owner' is the field name in your Cloud entity for GCP
        if (!$gcpData) {
            return new JsonResponse(['error' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'share' => $gcpData->getShare(),
            'launch' => $gcpData->getLaunch(),
            'owner' => $gcpData->getOwner(),
            'revenue' => $gcpData->getRevenue(),
            'pricing' => $gcpData->getPricing(),
            'storage' => $gcpData->getStorage(),
            'vn' => $gcpData->getVn(),
            'api' => $gcpData->getApi(),
        ];

        return new JsonResponse($data);
    }

    #[Route("/proj/api/all", name: "project-api-all", methods: ['GET'])]
    public function getAPICloud(
        CloudRepository $cloudRepository
    ): JsonResponse {
        $providers = ['Amazon', 'Microsoft', 'Google'];
        $data = [];

        foreach ($providers as $provider) {
            $providerData = $cloudRepository->findOneBy(['owner' => $provider]);

            if (!$providerData) {
                return new JsonResponse(['error' => "$provider data not found"], Response::HTTP_NOT_FOUND);
            }

            $data[$provider] = [
                'share' => $providerData->getShare(),
                'launch' => $providerData->getLaunch(),
                'owner' => $providerData->getOwner(),
                'revenue' => $providerData->getRevenue(),
                'pricing' => $providerData->getPricing(),
                'storage' => $providerData->getStorage(),
                'vn' => $providerData->getVn(),
                'api' => $providerData->getApi(),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route("/proj/api/aws/update", name: "project-api-aws-update", methods: ["POST", "GET"])]
    public function updateAPIAWS(
        Request $request,
        CloudRepository $cloudRepository,
        ManagerRegistry $doctrine
    ): JsonResponse {
        $newShareValue = $request->request->get('new');

        if ($newShareValue !== null) {
            $entityManager = $doctrine->getManager();
            $aws = $cloudRepository->findOneBy(['owner' => 'Amazon']);
    
            $aws->setShare($newShareValue);
            $entityManager->flush();

            $awsData = $cloudRepository->findOneBy(['owner' => 'Amazon']);

            $data = [
                'share' => $awsData->getShare(),
                'launch' => $awsData->getLaunch(),
                'owner' => $awsData->getOwner(),
                'revenue' => $awsData->getRevenue(),
                'pricing' => $awsData->getPricing(),
                'storage' => $awsData->getStorage(),
                'vn' => $awsData->getVn(),
                'api' => $awsData->getApi(),
            ];
    
            return new JsonResponse($data);
        }
        return new JsonResponse(['error' => 'Invalid data provided'], JsonResponse::HTTP_BAD_REQUEST);
    }
}