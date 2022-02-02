<?php

namespace App\Form;

use App\Entity\Reservation;
// use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class Reservation1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $user = $options["user"];
    $builder
            ->add('nom',null, [
                "data"=> $user ? $user->getNom() : "" 
            ])
            ->add('prenom',null, [
                "data"=> $user ? $user->getPrenom() : "" 
            ])
            ->add('email', EmailType::class,[
                "data"=> $user ? $user->getEmail() : "" 
            ])
            ->add('telephone', TelType::class, [
                "data"=> $user ? $user->getTelephone() : "" 
            ])

            ->add('date', DateType::class,[ 
                'widget'=>'single_text'],
             )
            ->add('nombreDePersonnes', ChoiceType::class,[
                    
                    "choices"=>[
                        "1"=>"1",
                        "2"=>"2",
                        "3"=>"3",
                        "4"=>"4",
                        "5"=>"5",  
                        "6"=>"6", 
                        "7"=>"7",  
                        "8"=>"8",  
                        "9"=>"9",]],
            )      
            ->add('heure', ChoiceType::class,[
                "choices"=>[
                    "11.00"=>"1",
                    "11.30"=>"2",
                    "12.00"=>"3",
                    "12.30"=>"4",
                    "13.00"=>"5",
                    "13.30"=>"6",
                    "14.00"=>"7",
                    "18.00"=>"8",
                    "18.30"=>"9",
                    "19.00"=>"10",
                    "19.30"=>"11",
                    "20.00"=>"12",
                    "21.00"=>"13",
                    "22.00"=>"14",
                ]],
                )
                
                 ->add('message',TextareaType::class)
                //  ->remove('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            "user"=>null
        ]);
    }
}
