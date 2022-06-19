<?php

namespace App\Controller\Admin;

use App\Entity\Resource;
use App\Form\ResourceType;
use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/resource')]
class ResourceController extends AbstractController
{
    #[Route('/', name: 'app_admin_resource_index', methods: ['GET'])]
    public function index(ResourceRepository $resourceRepository): Response
    {
        return $this->render('admin/resource/index.html.twig', [
            'resources' => $resourceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_resource_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ResourceRepository $resourceRepository): Response
    {
        $resource = new Resource();
        $form = $this->createForm(ResourceType::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coverFile = $form->get('cover')->getData();
            $path = $coverFile;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $resource->setCover($base64);

            $resourceRepository->add($resource, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/resource/new.html.twig', [
            'resource' => $resource,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_admin_resource_show', methods: ['GET'])]
    public function show(Resource $resource): Response
    {
        return $this->render('admin/resource/show.html.twig', [
            'resource' => $resource,
        ]);
    }

    #[Route('/edit/{slug}', name: 'app_admin_resource_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resource $resource, ResourceRepository $resourceRepository): Response
    {
        $form = $this->createForm(ResourceType::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coverFile = $form->get('cover')->getData();
            $path = $coverFile;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $resource->setCover($base64);

            $resourceRepository->add($resource, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/resource/edit.html.twig', [
            'resource' => $resource,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_admin_resource_delete', methods: ['POST'])]
    public function delete(Request $request, Resource $resource, ResourceRepository $resourceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resource->getId(), $request->request->get('_token'))) {
            $resourceRepository->remove($resource, true);
        }

        return $this->redirectToRoute('app_admin_resource_index', [], Response::HTTP_SEE_OTHER);
    }
}
