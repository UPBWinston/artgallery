<?php

namespace App\Controller;

use App\Entity\SaleEvent;
use App\Form\SaleEventType;
use App\Repository\SaleEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/sale/event')]
class SaleEventController extends AbstractController
{
    #[Route('/', name: 'app_sale_event_index', methods: ['GET'])]
    public function index(SaleEventRepository $saleEventRepository): Response
    {
        return $this->render('sale_event/index.html.twig', [
            'sale_events' => $saleEventRepository->findAll(),
            'userRoles' => $this->getUser()->getRoles(),
        ]);
    }

    #[Route('/new', name: 'app_sale_event_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_SALES')]
    public function new(Request $request, SaleEventRepository $saleEventRepository): Response
    {
        $saleEvent = new SaleEvent();
        $form = $this->createForm(SaleEventType::class, $saleEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $saleEventRepository->save($saleEvent, true);

            return $this->redirectToRoute('app_sale_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sale_event/new.html.twig', [
            'sale_event' => $saleEvent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sale_event_show', methods: ['GET'])]
    public function show(SaleEvent $saleEvent): Response
    {
        return $this->render('sale_event/show.html.twig', [
            'sale_event' => $saleEvent,
            'userRoles' => $this->getUser()->getRoles(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sale_event_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_SALES')]
    public function edit(Request $request, SaleEvent $saleEvent, SaleEventRepository $saleEventRepository): Response
    {
        $form = $this->createForm(SaleEventType::class, $saleEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $saleEventRepository->save($saleEvent, true);

            return $this->redirectToRoute('app_sale_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sale_event/edit.html.twig', [
            'sale_event' => $saleEvent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sale_event_delete', methods: ['POST'])]
    #[IsGranted('ROLE_SALES')]
    public function delete(Request $request, SaleEvent $saleEvent, SaleEventRepository $saleEventRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saleEvent->getId(), $request->request->get('_token'))) {
            $saleEventRepository->remove($saleEvent, true);
        }

        return $this->redirectToRoute('app_sale_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
