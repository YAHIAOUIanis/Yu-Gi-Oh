<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Repository\CardsRepository;
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

    /**
     * @var CardsRepository
     */
    private $cards_repo;

    public function __construct(DeckRepository $repo, ObjectManager $manager, CardsRepository $cards_repo)
    {
        $this->repo = $repo;
        $this->manager = $manager;
        $this->cards_repo = $cards_repo;
    }

    /**
     * @Route("/deckBuilder", name="deckBuilder")
     */
    public function createDeck(Request $request)
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
            $deck->setPosted(false);

            $this->manager->persist($deck);
            $this->manager->flush();
        }

        //recover current user's decks
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
     * @Route("/deck{id}", name="deckBuilder.show")
     */
    public function show($id)
    {
        $d = $this->repo->find($id);

        return $this->render('showDeck/showDeck.html.twig', [
            'deck' => $d,
            'cards' => $d->getCard(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @param Cards $c
     * @return mixed
     * @Route("/addCard{id}", name="addCard")
     */
    public function add($id, Request $query)
    {
        $d = $this->repo->find($query->request->get('choosenDeck'));
        $c = $this->cards_repo->find($id);
        $d->addCard($c);
        $this->manager->persist($c);
        $this->manager->flush();
        return $this->redirectToRoute('manager');
    }

    /**
     * @Route("/removeCard{i}-{idd}", name="deckBuilder.removeCard")
     */
    public function remove($i, $idd)
    {
        $d = $this->repo->find($idd);
        $c = $this->cards_repo->find($i);
        $d->removeCard($c);

        $this->manager->persist($d);
        $this->manager->flush();

        return $this->render('showDeck/showDeck.html.twig', [
            'deck' => $d,
            'cards' => $d->getCard(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/deleteDeck{id}", name="deckBuilder.delete")
     */
    public function delete($id)
    {
        $d = $this->repo->find($id);
        $this->manager->remove($d);
        $this->manager->flush();

        return $this->redirectToRoute('deckBuilder');
    }

    /**
     * @Route("/rename{idDeck}", name="deckBuilder.rename")
     */
    public function rename($idDeck, Request $query)
    {
        $d = $this->repo->find($idDeck);
        $d->setDeckName($query->request->get('rename'));
        $this->manager->persist($d);
        $this->manager->flush();

        return $this->render('showDeck/showDeck.html.twig', [
            'deck' => $d,
            'cards' => $d->getCard(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/retrieve{id}", name="retrieve")
     */
    public function retrieve($id)
    {
        $d = $this->repo->find($id);
        $d->setPosted(false);
        $this->manager->persist($d);
        $this->manager->flush();

        return $this->redirectToRoute('deckBuilder.show', [
            'id' => $id
        ]);

    }

}