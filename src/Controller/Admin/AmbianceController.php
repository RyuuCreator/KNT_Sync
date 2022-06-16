<?php

namespace App\Controller\Admin;

use App\Entity\Ambiance;
use App\Form\AmbianceType;
use App\Repository\AmbianceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/ambiance')]
class AmbianceController extends AbstractController
{
    #[Route('/', name: 'app_admin_ambiance_index', methods: ['GET'])]
    public function index(AmbianceRepository $ambianceRepository): Response
    {
        return $this->render('/admin/ambiance/index.html.twig', [
            'ambiances' => $ambianceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_ambiance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AmbianceRepository $ambianceRepository): Response
    {
        $ambiance = new Ambiance();
        $form = $this->createForm(AmbianceType::class, $ambiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('picture')->getData();
            $path = $pictureFile;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $ambiance->setPicture($base64);

            $ambianceRepository->add($ambiance, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/ambiance/new.html.twig', [
            'ambiance' => $ambiance,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_admin_ambiance_show', methods: ['GET'])]
    public function show(Ambiance $ambiance): Response
    {
        return $this->render('/admin/ambiance/show.html.twig', [
            'ambiance' => $ambiance,
        ]);
    }

    #[Route('/edit/{slug}', name: 'app_admin_ambiance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ambiance $ambiance, AmbianceRepository $ambianceRepository): Response
    {
        $form = $this->createForm(AmbianceType::class, $ambiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ambianceRepository->add($ambiance, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/ambiance/edit.html.twig', [
            'ambiance' => $ambiance,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_admin_ambiance_delete', methods: ['POST'])]
    public function delete(Request $request, Ambiance $ambiance, AmbiancesRepository $ambianceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ambiance->getId(), $request->request->get('_token'))) {
            $ambianceRepository->remove($ambiance, true);
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
