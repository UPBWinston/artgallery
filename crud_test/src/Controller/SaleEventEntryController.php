<?php

namespace App\Controller;

use App\Entity\SaleEventEntry;
use App\Form\SaleEventEntryType;
use App\Repository\SaleEventEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_SALES')]

#[Route('/sale/evententry')]
class SaleEventEntryController extends AbstractController
{
    #[Route('/', name: 'app_sale_event_entry_index', methods: ['GET'])]
    public function index(SaleEventEntryRepository $saleEventEntryRepository): Response
    {
        return $this->render('sale_event_entry/index.html.twig', [
            'sale_event_entries' => $saleEventEntryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sale_event_entry_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SaleEventEntryRepository $saleEventEntryRepository): Response
    {
        $saleEventEntry = new SaleEventEntry();
        $form = $this->createForm(SaleEventEntryType::class, $saleEventEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $saleEventEntryRepository->save($saleEventEntry, true);

            return $this->redirectToRoute('app_sale_event_entry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sale_event_entry/new.html.twig', [
            'sale_event_entry' => $saleEventEntry,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sale_event_entry_show', methods: ['GET'])]
    public function show(SaleEventEntry $saleEventEntry): Response
    {
        return $this->render('sale_event_entry/show.html.twig', [
            'sale_event_entry' => $saleEventEntry,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sale_event_entry_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SaleEventEntry $saleEventEntry, SaleEventEntryRepository $saleEventEntryRepository): Response
    {
        $form = $this->createForm(SaleEventEntryType::class, $saleEventEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $saleEventEntryRepository->save($saleEventEntry, true);

            return $this->redirectToRoute('app_sale_event_entry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sale_event_entry/edit.html.twig', [
            'sale_event_entry' => $saleEventEntry,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sale_event_entry_delete', methods: ['POST'])]
    public function delete(Request $request, SaleEventEntry $saleEventEntry, SaleEventEntryRepository $saleEventEntryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saleEventEntry->getId(), $request->request->get('_token'))) {
            $saleEventEntryRepository->remove($saleEventEntry, true);
        }

        return $this->redirectToRoute('app_sale_event_entry_index', [], Response::HTTP_SEE_OTHER);
    }
}
