<?php

namespace App\Controller;

use App\Entity\Product;
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
    public function read(Category $category = null, Product $product, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        // 404 
        if ($category === null) {
            throw $this->createNotFoundException('Page not found');
        }

        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        // Find any product by its ID
        $products = $productRepository->findby([]);

        // Finds a product by its status for category page (3=new)
        $status = $productRepository->findProductByStatus($product->getStatus());

        return $this->render('category/read.html.twig', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
            'status' => $status,
        ]);
    }
}
