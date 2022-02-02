<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Categorie;
use App\Form\ContactType;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\MenuRepository;
use App\Repository\UserRepository;
use App\Repository\CategorieRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    //1->route de la page d'acceuil
    #[Route('/', name: 'front')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }


    //2->route pour afficher les categories: boissons, plats, entrée....

    /**
    * @Route("/menu", name="front_menu", methods={"GET"})
    */
    public function categorie(CategorieRepository $categorieRepository): Response
    {
        return $this->render('front/categorie.html.twig', [
                'categories' => $categorieRepository->findAll(),
        ]);
    }
    //3->route pour afficher les plats par leur categorie

    /**
     * @Route("/menu/{id}", name="show_menu", methods={"GET"})
     */
    public function menu(MenuRepository $menuRepository, Categorie $categorie): Response
    {
        return $this->render('front/menu.html.twig', [
                'menus' => $menuRepository->findAll(),
                'categorie'=>$categorie
        ]);
    }
    //4->route pour afficher les détails d'un plat

    /**
     * @Route("/menu_show/{id}", name="show_menu_detail", methods={"GET"})
     */
    public function show(Menu $menu): Response
    {
        return $this->render('front/show_menu.html.twig', [
            'menu' => $menu,
        ]);
    }


    //5->route pour le compte d'utlisateur connecter

    /**
     * @Route("/mon_compte", name="mon_compte")
     */
    public function compte(UserRepository $userRepository){
       
        $user = $this->getUser();

        return $this->render('front/monCompte.html.twig', [
            'user' => $userRepository->findby(['nom'=> $user] ),
        ]);
  
    }


    //6->route pour récupérer les reservations effectué par un email 


     /**
     * @Route("/mes_reservations", name="mes_reservations")
     */
    public function reservation_user(UserRepository $user,ReservationRepository $repoReservation){

        $user = $this->getUser();
   
      $reservation = $repoReservation->findBy(['user'=>$user]);
    //   dump($reservation); 

      return $this->render('front/reservation.html.twig',[
          'user'=>$user,
          'reservations'=>$reservation
      ]);
    }


 
    
        #[Route('/', name: 'adresse_voir', methods: ['GET'])]
        public function adress(AdresseRepository $adresseRepository, User $user): Response
        {
           $user = $this->getUser() ;
            return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findBy(),['user'=>$user]
        ]);
    
        }

//7->route pour un formulaire de contact
    /**
     *@Route("/contact", name="contact", methods= {"GET", "POST"} )
    */
    public function contact(Request $req, \Swift_Mailer $mailer){

        //création du formulaire
        $form =$this->createForm(ContactType::class, null );
        //traiter le formualire
        $form->handleRequest($req);

        //Validation du formulaire :
        if($form->isSubmitted() && $form->isValid()){

            //récuperer les contenus des champs 
            $data=($form->getData());
            $email= $data['email'];
            // dd($email);

            //Créer un email:
            $message = new \Swift_Message("Demande de contact");
            $message->setFrom($email) 
                    ->setTo(["lydia@gmail.com"])
                    ->setBody(
                        $this->renderView('email/contact.html.twig', [
                            "data"=>$data     
                        ]), "text/html"
                    );
                $mailer->send($message);
                //message de notification sur le navigateur(les messages flash)
                $this->addflash(
                    'info',
                    'Nous avons bien reçu votre message, nous allons vous répondre bientôt.'
                );

                //intercepter la redirection pour vérifier le fonctionnement d'envoie d-email
                // return $this->redirectToRoute("front");
        }

        return $this->render("front/contact.html.twig", [
            "form"=>$form->createView()
        ]);

    }
}
