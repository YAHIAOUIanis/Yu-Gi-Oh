<?php

namespace App\Controller;

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

    /**
     * DeckBuilderController constructor.
     * @param DeckRepository $repo
     * @param ObjectManager $manager
     * @param CardsRepository $cards_repo
     * @param PostLikeRepository $like_repo
     */
    public function __construct(DeckRepository $repo, ObjectManager $manager, CardsRepository $cards_repo, PostLikeRepository $like_repo)
    {
        $this->repo = $repo;
        $this->manager = $manager;
        $this->cards_repo = $cards_repo;
        $this->like_repo = $like_repo;
    }

    /**
     * createDeck allows to create a deck and display the decks created by the current user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
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
     * recovering the deck corresponds to the identifier passed in parameter
     * @Route("/deck{id}", name="deckBuilder.show")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
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
     * add a card to a deck
     * @Route("/addCard{id}", name="addCard")
     * @param int $id
     * @param Request $query
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     * remove a card from a deck
     * @Route("/removeCard{i}-{idd}", name="deckBuilder.removeCard")
     * @param int $i
     * @param int $idd
     * @return \Symfony\Component\HttpFoundation\Response
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
     * remove a like from a deck
     * @Route("/deleteDeck{id}", name="deckBuilder.delete")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     * rename a deck
     * @Route("/rename{idDeck}", name="deckBuilder.rename")
     * @param int $idDeck
     * @param Request $query
     * @return \Symfony\Component\HttpFoundation\Response
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
     * make the deck private
     * @Route("/retrieve{id}", name="retrieve")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     * like a deck
     * @Route("like{idDeck}", name="like")
     * @param int $idDeck
     * @param PostLikeRepository $like_repo
     * @return \Symfony\Component\HttpFoundation\JsonResponse
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