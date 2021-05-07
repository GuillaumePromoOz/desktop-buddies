<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * Get one product
     * 
     * @Route("/products/{id<\d+>}", name="products_read", methods="GET")
     */
    public function read(Product $product, CategoryRepository $categoryRepository): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        return $this->render('product/read.html.twig', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }
}
