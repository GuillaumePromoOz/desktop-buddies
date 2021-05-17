<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
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
    public function read(Product $product, $id, ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        // Find product by id for cart (button "add to cart")
        $product = $productRepository->find($id);

        return $this->render('product/read.html.twig', [
            'product' => $product,
            'id' => $id,
            // for navbar only
            'categories' => $categories,
        ]);
    }
}
