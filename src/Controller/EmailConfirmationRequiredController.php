<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailConfirmationRequiredController extends AbstractController
{
    /**
     * @Route("/email/confirmation/required", name="app_email_confirmation_required")
     */
    public function index(): Response
    {
        return $this->render('email_confirmation_required/index.html.twig', [
            'controller_name' => 'EmailConfirmationRequiredController',
        ]);
    }
}
