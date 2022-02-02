<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservation;
use App\Form\Reservation1Type;
use App\Repository\UserRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    //la liste des réservations éffetués par les clients peut être vu que par l'admin
    #[Route('/admin', name: 'reservation_index', methods: ['GET'])]
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
       
        $reservationPasses=$reservationRepository->findReservationsPasses();
        $reservationFuture=$reservationRepository->findReservationsFuture();

        return $this->render('reservation/index.html.twig', 
        ['reservations' => $reservationRepository->findAll(),
        'reservationsFuture' =>$reservationFuture,
        'reservationsPasses' =>$reservationPasses,
        ]
    );
    }




    #[Route('/new', name: 'reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request,\Swift_Mailer $mailer, UserRepository $userrepo): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(Reservation1Type::class, $reservation, ["user"=>$this->getUser() ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            //on peut récuperer les infos de form de reservation envoyer mais erreur => les infos de entité reservation ne peut pas etre array ....
            $donnees = $form->getData();
            // $user = $userrepo->findOneByEmail($donnees['email']);

            //donc on récup l'user connecter
            
            $user = $this->getUser();
            $reservation->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
            $this->addflash(
                'info','✅Nous avons bien reçu votre réservation, merci.'
            );
          

            $message = new \Swift_Message('Réservation chez le Café Gourmand');
            $message ->setFrom("lydia@gmail.com")
                    ->setTo($user->getEmail())// ici on peut récup l'email de l'user connecter 
                    ->setBody(
                        $this->renderView('email/reservation.html.twig', ["donnees"=>$donnees]),"text/html"
                    );
                
            $mailer->send($message);

            // return $this->redirectToRoute('mes_reservations');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }





    #[Route('/{id}', name: 'reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation, UserRepository $repoUser): Response
    {
         //poser une condtion que seul un admin peut consulter la réservation d'un client(blog)
        //ou récuperer l'user connecter et seul lui peut consulter sa réservation
       
        $user = $this->getUser();
        // dd($user);
         if($this->isGranted("ROLE_ADMIN") || $this->getUser() == $user){
            return $this->render('reservation/show.html.twig', [
                'reservation' => $reservation,
                // 'user' =>$user
            ]);
        }
        throw $this->createAccessDeniedException();
   
    }

    #[Route('/{id}/edit/', name: 'reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation
    ): Response
    {
     
        $user = $this->getUser();
        // $email = $user->getEmail();

        // if($this->isGranted("ROLE_ADMIN") || $this->getUser() == $user ){
            $form = $this->createForm(Reservation1Type::class, $reservation,);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('reservation_index');
            }
    
            return $this->render('reservation/edit.html.twig', [
                'reservation' => $reservation,
                'form' => $form->createView(),
            ]);
        // }
        // throw $this->createAccessDeniedException();
       
    }

    #[Route('/{id}', name: 'reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation): Response
    {
        // if($this->isGranted("ROLE_ADMIN")){
            if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($reservation);
                $entityManager->flush();
            }
    
            return $this->redirectToRoute('reservation_index');
        // }
        // throw $this->createAccessDeniedException();
    }
}
