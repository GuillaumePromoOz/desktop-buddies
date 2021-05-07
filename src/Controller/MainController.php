<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(CategoryRepository $categoryRepository): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        $newProducts = $categoryRepository->findToysByCategoryId(1);

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
