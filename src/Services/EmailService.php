<?php
namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\User;
use Twig\Environment;

class EmailService
{
    private $mailer;
    
    private $twig;
    
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;        
    }
    
    public function sendEmail(string $to, string $subject, string $message): void
    {
        $email = (new Email())
        ->from('your_email@example.com')
        ->to($to)
        ->subject($subject)
        ->html($message);
        
        $this->mailer->send($email);
    }
    
    public function sendRegEmail(User $user) : void
    {
        $email = (new Email())
        ->from('noreply@symfonyContacts.test')
        ->to($user->getEmail())
        ->subject("Confirm your email")
        ->html($this->twig->render('email\confirmEmail.html.twig', [
            'subject' => 'Confirm your email',
            'user' => $user,
        ]));
        
        $this->mailer->send($email);
    }
}

