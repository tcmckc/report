<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Library;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;

class LibraryController extends AbstractController
{
    #[Route("/library", name: "library")]
    public function showAllLibrary(
        LibraryRepository $libraryRepository
    ): Response {
        $library = $libraryRepository
            ->findAll();

        return $this->render('library/home.html.twig', [
            'constoller_name' => 'LibraryController',
            'library' => $library
        ]);
    }

    #[Route("/library/add", name: "library_add", methods: ["GET"])]
    public function addLibrary(): Response
    {
        return $this->render('library/add.html.twig', [
            'controller_name' => 'LibraryController'
        ]);
    }

    #[Route("/library/add", name: "library_add_post", methods: ["POST"])]
    public function addLibraryPost(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        $library = new Library();
        $library->setTitle($request->request->get('title'));
        $library->setAuthor($request->request->get('author'));
        $library->setIsbn($request->request->get('isbn'));
        $library->setImage($request->request->get('image'));

        $entityManager->persist($library);
        $entityManager->flush();

        return $this->redirectToRoute("library");
    }

    #[Route("/library/{id}", name: "library_detail")]
    public function detailLibraryById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $library = $libraryRepository->find($id);

        return $this->render('library/detail.html.twig', [
            'controller_name' => 'LibraryController',
            'library' => $library
        ]);
    }

    #[Route("/library/delete/{id}", name: "library_delete")]
    public function deleteLibraryById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $entityManager->getRepository(Library::class)->find($id);

        if (!$library) {
            throw $this->createNotFoundException(
                'No item found!'
            );
        }

        $entityManager->remove($library);
        $entityManager->flush();

        return $this->redirectToRoute('library');
    }

    #[Route("/library/update/{id}", name: "library_update", methods: ["GET"])]
    public function updateLibrary(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $entityManager->getRepository(Library::class)->find($id);

        if (!$library) {
            throw $this->createNotFoundException(
                'No item found!'
            );
        }

        return $this->render('library/update.html.twig', [
            'library' => $library
        ]);
    }

    #[Route("/library/update/{id}", name: "library_update_post", methods: ["POST"])]
    public function updateLibraryPost(
        ManagerRegistry $doctrine,
        int $id,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        $library = $entityManager->getRepository(Library::class)->find($id);

        if (!$library) {
            throw $this->createNotFoundException(
                'No library found!'
            );
        }

        $library->setTitle($request->request->get('title'));
        $library->setAuthor($request->request->get('author'));
        $library->setIsbn($request->request->get('isbn'));
        $library->setImage($request->request->get('image'));

        $entityManager->flush();

        return $this->redirectToRoute("library");
    }
}

