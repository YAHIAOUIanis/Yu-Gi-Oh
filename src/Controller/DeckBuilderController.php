<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Entity\PostLike;
use App\Repository\CardsRepository;
use App\Repository\DeckRepository;
use App\Repository\PostLikeRepository;
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

    /**
     * @var PostLikeRepository
     */
    private $like_repo;


    public function __construct(DeckRepository $repo, ObjectManager $manager, CardsRepository $cards_repo, PostLikeRepository $like_repo)
    {
        $this->repo = $repo;
        $this->manager = $manager;
        $this->cards_repo = $cards_repo;
        $this->like_repo = $like_repo;
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
    public function show(int $id)
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
    public function add(int $id, Request $query)
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
    public function remove(int $i, int $idd)
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
    public function delete(int $id)
    {
        $d = $this->repo->find($id);

        $likes = $this->like_repo;
        foreach($likes as $like)
        {
            if($like->getDeck()->getId() == $id)
            {
                $this->manager->remove($like);
                $this->manager->flush();
            }
        }
        $this->manager->remove($d);
        $this->manager->flush();

        return $this->redirectToRoute('deckBuilder');
    }

    /**
     * @Route("/rename{idDeck}", name="deckBuilder.rename")
     */
    public function rename(int $idDeck, Request $query)
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
    public function retrieve(int $id)
    {
        $d = $this->repo->find($id);
        $d->setPosted(false);
        $this->manager->persist($d);
        $this->manager->flush();

        return $this->redirectToRoute('deckBuilder.show', [
            'id' => $id
        ]);
    }

    /**

     * @Route("like{idDeck}", name="like")
     */
    public function like(int $idDeck, PostLikeRepository $like_repo)
    {
        $user = $this->getUser();
        $deck = $this->repo->find($idDeck);
        if ($deck->isLikedByUser($user)) {
            $like = $like_repo->findOneBy([
                'deck' => $deck,
                'user' => $user
            ]);

            $this->manager->remove($like);
            $this->manager->flush();

            //I send informations to json in order to have the number of likes
            return $this->json([
                'code' => 200,
                'message' => 'Like deleted',
                'likes' => $like_repo->count(['deck' => $deck])
            ], 200);
        }

        $like = new PostLike();
        $like->setDeck($deck);
        $like->setUser($user);
        $this->manager->persist($like);
        $this->manager->flush();

        return $this->json([
            'code' => 200,
            'message' => 'Like added',
            'likes' => $like_repo->count(['deck' => $deck])
        ], 200);
    }

}