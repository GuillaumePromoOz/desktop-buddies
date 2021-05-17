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
     * @Route("/", name="home")
     */
    public function home(CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        // Le paramètre GET à récupérer
        $search = $request->query->get('search');
        // Tous les films par ordre alphabétique
        // $movies = $movieRepository->findBy([], ['title' => 'ASC']);
        $products = $productRepository->findAllOrderedByNameAsc($search);

        // Finds a product by its status for home page (3=new)
        $newProducts = $productRepository->findProductByStatus(3);

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'products' => $products,
            'newProducts' => $newProducts,
        ]);
    }
}
