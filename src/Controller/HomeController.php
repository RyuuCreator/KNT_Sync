<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\AmbianceRepository;
use App\Repository\CategoryRepository;
use App\Repository\ResourceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $category, AmbianceRepository $ambiance, ResourceRepository $resource, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        $resources = $resource->findSearch($data);

        return $this->render('home/index.html.twig', [
            'categories' => $category->findAll(),
            'ambiances' => $ambiance->findAll(),
            'resourcesSearch' => $resources,
            'formSearch' => $form->createView(),
        ]);
    }
}