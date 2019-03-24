<?php

namespace App\Controller;

use App\Repository\DeckRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Deck;




class DeckBuilderController extends AbstractController
{

    /**
     * @var DeckRepository
     */
    private $repo;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(DeckRepository $repo, ObjectManager $manager)
    {
        $this->repo = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/deckBuilder", name="deckBuilder")
     */
    public function createDeck(Request $request, ObjectManager $manager)
    {
        $deck = new Deck();

        $form = $this->createFormBuilder($deck)
                     ->add('deckName')
                     ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$deck->getId()){
                $deck->setUser($this->getUser());
                $deck->setCreatedAt(new \DateTime());
            }
            $manager->persist($deck);
            $manager->flush();
        }

        //recover current user's decks
        $this->repo = $this->getDoctrine()->getRepository(Deck::class);
        $decks = $this->repo->findAll();
        $decksOfUserCurrent=array();
        foreach ($decks as $d){
            if($d->getUser() == $this->getUser()){
                $decksOfUserCurrent[]=$d;
            }
        }

        return $this->render('deckBuilder/deckBuilder.html.twig', [
            'formDeckBuilder' => $form->createView(),
            'decks' => $decksOfUserCurrent
        ]);
    }


    /**
     * @Route("/deckBuilder{id}", name="deckBuilder.show")
     */
    public function show($id)
    {
        $d = $this->repo->find($id);
        return $this->render('deckBuilder/deckBuilder.html.twig', [
            'deck' => $d
        ]);
    }

}
