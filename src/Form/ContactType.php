<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null,  ["attr"=>["placeholder"=>"Votre nom"]],
            ["required"=>true],  
           )

            ->add('prenom', null, ['attr' => ['placeholder' => 'Votre prénom '],"label"=>"Prénom"]  , 
            ["required"=>true],
         )

            ->add('email', EmailType::class,["attr"=>["placeholder"=>"Votre e-mail"]], ["required"=>false])
                
            
            ->add('telephone', TelType::class, ["attr"=>["placeholder"=>"Numéro de Téléphone"], "label"=>"Téléphone"] )

            ->add('message',TextareaType::class, ["attr"=>["placeholder"=>"Votre message"]],[ 
                "attr"=>[ //on peut limiter les ligne par 'rows' et caractére par 'cols' et lui donner une class pour le gérer dans css( donner un width)
                    "rows"=>10
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
