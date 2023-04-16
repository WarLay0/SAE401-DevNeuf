<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegisterType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface $entityManager,
                             MailerService $mailerService,
                             TokenGeneratorInterface $tokenGeneratorInterface): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(RegisterType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            // TOKEN GENERATOR
            $tokenRegistration = $tokenGeneratorInterface->generateToken();

            // User
            $utilisateur->setPassword(
                $userPasswordHasher->hashPassword(
                    $utilisateur,
                    $form->get('plainPassword')->getData(),
                )
            );


            // USER TOKEN
            $utilisateur->setTokenRegistration($tokenRegistration);

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // MAILER SEND

            $mailerService->send(
                $utilisateur->getUtilisateurEmail(),
                'Confirmation de votre compte',
                'register_confirmation.html.twig',
                [
                    'utilisateur' => $utilisateur,
                    'token' => $tokenRegistration,
                    'lifeTimeToken' => $utilisateur->getTokenRegistrationLifeTime()->format('d/m/y à H\hi'),
                ]
            );

            $this->addFlash('success', 'Votre compte a bien été créé !, Veuillez vérifier vos mails pour confirmer votre compte.');

            return $this->redirectToRoute('app_login');
        }


        return $this->render('register/index.html.twig', [
            'RegisterForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/{token}/{id<\d+>}', name: 'account_verify', methods: ['GET'])]
    public function verify (string $token, Utilisateur $utilisateur, EntityManagerInterface $em){

        if ($utilisateur->getTokenRegistration() !== $token) {
            throw new AccessDeniedException();
        }
        if ($utilisateur->getTokenRegistration() === null) {
            throw new AccessDeniedException();
        }
        if (new \DateTime('now') > $utilisateur->getTokenRegistrationLifeTime()) {
            throw new AccessDeniedException();
        }

        $utilisateur->setIsVerified(true);
        $utilisateur->setTokenRegistration(null);
        $em->flush();

        $this->addFlash('success', 'Votre compte a bien été vérifié !');

        return $this->redirectToRoute('app_login');
    }
}
