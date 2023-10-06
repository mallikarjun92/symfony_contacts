<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DefaultController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/index", name="app_index")
     */
    public function index(): Response
    {
        if ($this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
            // The user is logged in, handle accordingly
            return $this->redirectToRoute('dashboard'); // Redirect to a dashboard or other authenticated route
        }
        elseif($this->security->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return $this->redirectToRoute('login');
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'isLoggedIn' => $this->security->isGranted('IS_AUTHENTICATED_REMEMBERED'),
        ]);
    }
}
