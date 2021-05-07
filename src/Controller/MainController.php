<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        // Finds a product by its status for home page (3=new)
        $newProducts = $productRepository->findProductByStatus(3);

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'newProducts' => $newProducts,
        ]);
    }
}
