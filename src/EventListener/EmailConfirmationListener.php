<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class EmailConfirmationListener
{
    private $security;
    private $router;
    
    public function __construct(Security $security, RouterInterface $router)
    {
        $this->security = $security;
        $this->router = $router;
    }
    
    public function onKernelRequest(RequestEvent $event)
    {
        $user = $this->security->getUser();
        
        if (!$user) {
            return;
        }
        
//         Check if the email is not confirmed and the user is trying to access /contacts
        if (!$user->isEmailConfirmed() && $event->getRequest()->getPathInfo() === '/contact/') {
            $response = new RedirectResponse($this->router->generate('app_email_confirmation_required'));
            $event->setResponse($response);
        }
    }
}

