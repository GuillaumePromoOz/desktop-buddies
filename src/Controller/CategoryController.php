<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * Get one category and its associated products
     * 
     * @Route("/categories/{id<\d+>}", name="categories_read", methods="GET")
     */
    public function read(Category $category = null, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        $products = $productRepository->findby([]);

        return $this->render('category/read.html.twig', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
        ]);
    }
}
