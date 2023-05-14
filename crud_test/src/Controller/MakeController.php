<?php

namespace App\Controller;

use App\Entity\Make;
use App\Form\MakeType;
use App\Repository\MakeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/make')]
class MakeController extends AbstractController
{
    #[Route('/', name: 'app_make_index', methods: ['GET'])]
    public function index(MakeRepository $makeRepository): Response
    {
        return $this->render('make/index.html.twig', [
            'makes' => $makeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_make_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MakeRepository $makeRepository): Response
    {
        $make = new Make();
        $form = $this->createForm(MakeType::class, $make);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $makeRepository->save($make, true);

            return $this->redirectToRoute('app_make_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('make/new.html.twig', [
            'make' => $make,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_make_show', methods: ['GET'])]
    public function show(Make $make): Response
    {
        return $this->render('make/show.html.twig', [
            'make' => $make,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_make_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Make $make, MakeRepository $makeRepository): Response
    {
        $form = $this->createForm(MakeType::class, $make);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $makeRepository->save($make, true);

            return $this->redirectToRoute('app_make_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('make/edit.html.twig', [
            'make' => $make,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_make_delete', methods: ['POST'])]
    public function delete(Request $request, Make $make, MakeRepository $makeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$make->getId(), $request->request->get('_token'))) {
            $makeRepository->remove($make, true);
        }

        return $this->redirectToRoute('app_make_index', [], Response::HTTP_SEE_OTHER);
    }
}
