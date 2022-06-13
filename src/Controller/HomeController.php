<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Data\CheckData;
use App\Form\SearchType;
use App\Form\CheckType;
use App\Repository\AmbianceRepository;
use App\Repository\CategoryRepository;
use App\Repository\ResourceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $category, AmbianceRepository $ambiance, ResourceRepository $resource, Request $request): Response
    {
        $data = new CheckData();
        $formCheck = $this->createForm(CheckType::class, $data);
        $formCheck->handleRequest($request);

        $resourcesCheck = $resource->findCheck($data);

        if ($request->get('ajax') == 1) {
            if(isset($_GET['q'])){
                $dataSearch = $_GET['q'];
                $resourcesSearch = $resource->findSearch($dataSearch);

                return new JsonResponse([
                    'content' =>  $this->renderView('home/_resource.html.twig', ['resources' => $resourcesSearch])
                ]);
            }
        }

        if ($request->get('ajax') == 2) {
            return new JsonResponse([
                'content' => $this->renderView('home/_resource.html.twig', ['resources' => $resourcesCheck,])
            ]);
        }

        return $this->render('home/index.html.twig', [
            'categories' => $category->findAll(),
            'ambiances' => $ambiance->findAll(),
            'resources' => $resource->findAll(),
            'formCheck' => $formCheck->createView(),
        ]);
    }

    public function searchBar(ResourceRepository $resource, Request $request)
    {
        $data = new SearchData();
        
        $form = $this->createForm(SearchType::class, $data);
        
        $form->handleRequest($request);

        return $this->render('home/_search.html.twig', [
            'formSearch' => $form->createView(),
        ]);
    }
}