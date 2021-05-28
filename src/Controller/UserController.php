<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
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
     * @Route("/register", name="user_register", methods={"GET","POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hashes User password 
            $hashedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            // Reassignes password to User
            $user->setPassword($hashedPassword);

            // Assigns default ROLE_USER to new User
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

    /**
     * @Route("/edit/{id}", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        // Le mot de passe du $user va être écrasé par $request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Si le mot de passe du form n'est pas vide
            // c'est qu'on veut le changer !
            if ($form->get('password')->getData() !== '') {
                // C'est là qu'on encode le mot de passe du User (qui se trouve dans $user)
                $hashedPassword = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
                // On réassigne le mot passe encodé dans le User
                $user->setPassword($hashedPassword);
            }

            $this->getDoctrine()->getManager()->flush();

            // Flash
            //$this->addFlash('success', 'Vous êtes enregistré. Vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('home');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user, $id): Response
    {

        //!\ We need to clear current User's session BEFORE removing User and redirecting
        $currentUserId = $this->getUser()->getId();

        if ($currentUserId == $id) {
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
        }

        // User Removal
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_logout');
    }
}
