<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\SymfAppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Services\EmailService;

class RegistrationController extends AbstractController
{
    private $emailService;
    
    private $em;
    
    public function __construct(EmailService $emailService, EntityManagerInterface $em) {
        $this->emailService = $emailService;
        $this->em = $em;
    }
    
    function generateConfirmToken($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $characterLength - 1)];
        }
        
        return $randomString;
    }
    
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, SymfAppAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $user->setConfirmToken($this->generateConfirmToken());
            
            $this->em->persist($user);
            
            $this->em->flush();
            
            // do anything else you need here, like send an email
            $this->emailService->sendRegEmail($user);
            $user->setRegStatus(User::REG_EMAIL_SENT);
            
            $this->em->flush();
            
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/register/confirm/{user}/{confirmToken}", name="app_email_confirm")
     */
    public function confirmEmail(User $user, string $confirmToken)
    {
        if ($user->getRegStatus() != User::REG_EMAIL_CONFIRMED && $user->getRegStatus() === User::REG_EMAIL_SENT)
        {
            if($user->getConfirmToken() === $confirmToken) {
                $user->setRegStatus(User::REG_EMAIL_CONFIRMED);
                
//                 $this->em->persist($user);
                $this->em->flush();
                
                $this->addFlash('success', 'Your email has been confirmed!');
                
                return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
            }
        }
        else {
            echo "There is a problem!";
            exit;
        }
    }
}
