<?php

namespace App\Controller;

use App\Entity\Intensity;
use App\Form\Intensity1Type;
use App\Repository\IntensityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/intensity')]
class IntensityController extends AbstractController
{
    #[Route('/', name: 'app_intensity_index', methods: ['GET'])]
    public function index(IntensityRepository $intensityRepository): Response
    {
        return $this->render('intensity/index.html.twig', [
            'intensities' => $intensityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_intensity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IntensityRepository $intensityRepository): Response
    {
        $intensity = new Intensity();
        $form = $this->createForm(Intensity1Type::class, $intensity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intensityRepository->save($intensity, true);

            return $this->redirectToRoute('app_intensity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intensity/new.html.twig', [
            'intensity' => $intensity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intensity_show', methods: ['GET'])]
    public function show(Intensity $intensity): Response
    {
        return $this->render('intensity/show.html.twig', [
            'intensity' => $intensity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_intensity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Intensity $intensity, IntensityRepository $intensityRepository): Response
    {
        $form = $this->createForm(Intensity1Type::class, $intensity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intensityRepository->save($intensity, true);

            return $this->redirectToRoute('app_intensity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intensity/edit.html.twig', [
            'intensity' => $intensity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intensity_delete', methods: ['POST'])]
    public function delete(Request $request, Intensity $intensity, IntensityRepository $intensityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intensity->getId(), $request->request->get('_token'))) {
            $intensityRepository->remove($intensity, true);
        }

        return $this->redirectToRoute('app_intensity_index', [], Response::HTTP_SEE_OTHER);
    }
}
