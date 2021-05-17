<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add", name="cart_add", methods={"POST"})
     */
    public function add(ProductRepository $productRepository, Product $product = null, Request $request, SessionInterface $session): Response
    {
        // GET parameter (product's id) to be fetched
        $id = $request->request->get('id');

        // 404 if product not found
        $product = $productRepository->find($id);
        //dd($product);

        if (null === $product) {
            throw $this->createNotFoundException('Product not found.');
        }

        // We fetch the cart that's in session
        // We create a key "cart" and an empty array to store our products data
        $cart = $session->get('cart', []);

        // The product's ID will be the array's INDEX
        // If the ID/INDEX does not exists... 
        //... the array's value will equal the quantiy of products for this ID

        $productId = $product->getId();
        //dd($productId);

        if (!array_key_exists($productId, $cart)) {
            // New Product ?
            // Ok, let's add the product's id and set the value/quantity to 1
            $cart[$productId] = 1;
        } else {
            // Product already in cart ?
            // Great ! Let's add 1 to the value/quantity of this product
            $cart[$productId]++;
        }

        // Let's now put the cart BACK in session
        // It's the same cart to which we've add MORE data and reinjected BACK into the session
        $session->set('cart', $cart);

        //dd($session->all());

        $this->addFlash('success', 'Product has been added to cart');

        return $this->redirectToRoute('cart_list');
    }

    /**
     * @Route("/cart", name="cart_list", methods={"GET"})
     */
    public function list(SessionInterface $session, ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        //dd($session->get('cart', []));

        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        $cart = $session->get('cart', []);
        //sdd($cart);

        $products = $productRepository->findAll();
        //dd($products);

        return $this->render('cart/list.html.twig', [
            'cart' => $cart,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Remove cart content
     * 
     * @Route("/cart/remove", name="cart_remove", methods={"POST"})
     */
    public function remove(SessionInterface $session)
    {
        // We remone the cart attribute/key in the session
        $session->remove('cart');

        $this->addFlash('success', 'Cart cleared.');

        return $this->redirectToRoute('cart_list');
    }
}
