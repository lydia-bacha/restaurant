<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null)
            ->add('prenom', null)
            ->add('email', EmailType::class)
            ->add('telephone')
            ->add('password', RepeatedType::class, [
                "type"=>PasswordType::class,
                "first_options"=>[
                    "label"=>"Votre mot de passe"
                ],
                "second_options"=>[
                    "label"=>"Confirmez votre mot de passe"
                ],
                "invalid_message"=>"Les deux mots de passe ne correspondent pas !!",
                "required"=>true,     
            ]);
        if($options["isAdmin"] == true ){

            $builder->add('roles', ChoiceType::class,[
            "choices"=>[
                "Rôle administrateur"=>"ROLE_ADMIN",
                "Rôle utilisateur"=>"ROLE_USER"
            ],
            
                "multiple"=>true,
                "expanded"=>true
            ]);
            //   ->add('roles', ChoiceType::class,[
            //     "choices"=>[
            //         "Rôle administrateur"=>"ROLE_ADMIN",
            //         "Rôle utilisateur"=>"ROLE_USER"
            //     ],
                
            //         "multiple"=>true,
            //         "expanded"=>true
            //     ])
        } 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'isAdmin'=>false
        ]);
    }
}
