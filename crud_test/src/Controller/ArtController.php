<?php

namespace App\Controller;

use App\Entity\Art;
use App\Form\Art2Type;
use App\Repository\ArtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/art')]
class ArtController extends AbstractController
{
    #[Route('/', name: 'app_art_index', methods: ['GET'])]
    public function index(ArtRepository $artRepository): Response
    {
        return $this->render('art/index.html.twig', [
            'art' => $artRepository->findAll(),
            'userRoles' => $this->getUser()->getRoles()
        ]);
    }

    #[Route('/artlist', name: 'app_art_artlist', methods: ['GET'])]
    #[IsGranted('ROLE_CUSTOMER')]
    public function artlist(ArtRepository $artRepository): Response
    {
        $allArt = $artRepository->findAll();
        $artForSaleEvent = [];
        $saleEvet = '';
        foreach ($allArt as $art){
            foreach ($art->getSaleEventEntries() as $entry){
                if($entry->getSaleEvent()->getId() == $_GET["saleEventId"]){
                    $artForSaleEvent[] = $art;
                    $saleEvent = $entry->getSaleEvent()->getName();
                }
            }
        }

        return $this->render('art/artlist.html.twig', [
            'art' => $artForSaleEvent,
            'userRoles' => $this->getUser()->getRoles(),
            'saleEvent' => $saleEvent,
        ]);
    }

    #[Route('/new', name: 'app_art_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_SALES')]
    public function new(Request $request, ArtRepository $artRepository): Response
    {
        $art = new Art();
        $form = $this->createForm(Art2Type::class, $art);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artRepository->save($art, true);

            return $this->redirectToRoute('app_art_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('art/new.html.twig', [
            'art' => $art,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_art_show', methods: ['GET'])]
    public function show(Art $art): Response
    {
        return $this->render('art/show.html.twig', [
            'art' => $art,
            'userRoles' => $this->getUser()->getRoles(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_art_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_SALES')]
    public function edit(Request $request, Art $art, ArtRepository $artRepository): Response
    {
        $form = $this->createForm(Art2Type::class, $art);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artRepository->save($art, true);

            return $this->redirectToRoute('app_art_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('art/edit.html.twig', [
            'art' => $art,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_art_delete', methods: ['POST'])]
    #[IsGranted('ROLE_SALES')]
    public function delete(Request $request, Art $art, ArtRepository $artRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$art->getId(), $request->request->get('_token'))) {
            $artRepository->remove($art, true);
        }

        return $this->redirectToRoute('app_art_index', [], Response::HTTP_SEE_OTHER);
    }
}
