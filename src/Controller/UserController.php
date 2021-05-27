<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        // Finds all categories for navbar
        $categories = $categoryRepository->findAll();

        return $this->render('user/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/user/register", name="user_register", methods={"GET","POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // C'est là qu'on encode le mot de passe du User (qui se trouve dans $user)
            $hashedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            // On réassigne le mot passe encodé dans le User
            $user->setPassword($hashedPassword);

            $role = $user->getRoles();
            $user->setRoles($role);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //$this->addFlash('success', 'Vous êtes enregistré. Vous pouvez maintenant vous connecter.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
