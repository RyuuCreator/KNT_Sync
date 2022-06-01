<?php

namespace App\Controller;

use App\Repository\AmbianceRepository;
use App\Repository\CategoryRepository;
use App\Repository\ResourceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $category, AmbianceRepository $ambiance, ResourceRepository $resource): Response
    {
        return $this->render('home/index.html.twig', [
            'categories' => $category->findAll(),
            'ambiances' => $ambiance->findAll(),
            'resources' => $resource->findAll(),
        ]);
    }
}
