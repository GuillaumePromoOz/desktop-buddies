<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     */
    public function home(CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        // GET parameter to be fetched by search bar
        $search = $request->query->get('search');
        // All products by alphabetical order for search bar
        $products = $productRepository->findAllOrderedByNameAsc($search);

        // Finds a product by its status for home page
        // 3=new, 4=best-seller
        $statusNew = $productRepository->findProductByStatus(3);
        $statusTop = $productRepository->findProductByStatus(4);

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'products' => $products,
            'newProducts' => $statusNew,
            'topProducts' => $statusTop,
        ]);
    }
}
