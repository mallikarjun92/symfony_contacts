<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType; // Import PasswordType
use Symfony\Component\Form\Extension\Core\Type\TextType; // Import TextType
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use App\Entity\User;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class) // Use PasswordType for password field
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
//             'data_class' => User::class,
            'data_class' => null,
        ]);
    }
    
    public function getName()
    {
        // Set your custom form name here
        return 'login_form';
    }
}


?>