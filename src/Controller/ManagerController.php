<?php

namespace App\Controller;

use App\Entity\Cardsearch;
use App\Entity\Deck;
use App\Form\CardSearchType;
use App\Repository\CardsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cards;

class ManagerController extends AbstractController
{
    /**
     * @var CardsRepository
     */
    private $repo;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(CardsRepository $repo, ObjectManager $manager)
    {
        $this->repo = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/manager", name="manager")
     */
    public function manager(Request $request)
    {
        $search = new Cardsearch();
        $form = $this->createForm(CardSearchType::class, $search);
        $form->handleRequest($request);
        $cards = $this->repo->findAllCards($search);

        return $this->render('manager/manager.html.twig', [
            'cards' => $cards,
            'title' => 'Card list Yu-Gi-Oh!',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/card{id}", name="manager.show")
     */
    public function show($id)
    {
        $c = $this->repo->find($id);

        //recover current user's decks
        $decks = $this->getDoctrine()->getRepository(Deck::class)->findAll();
        $decksOfUserCurrent=array();
        foreach ($decks as $d){
            if($d->getUser() == $this->getUser()){
                $decksOfUserCurrent[]=$d;
            }
        }

        return $this->render('description/description.html.twig', [
            'card' => $c,
            'decks' => $decksOfUserCurrent
        ]);
    }
}
