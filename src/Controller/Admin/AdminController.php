<?php

namespace App\Controller\Admin;

use App\Repository\AmbianceRepository;
use App\Repository\CategoryRepository;
use App\Repository\ResourceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(CategoryRepository $category, AmbianceRepository $ambiance, ResourceRepository $resource): Response
    {
        return $this->render('admin/index.html.twig', [
            'categories' => $category->findAll(),
            'ambiances' => $ambiance->findAll(),
            'resources' => $resource->findAll(),
        ]);
    }
}
