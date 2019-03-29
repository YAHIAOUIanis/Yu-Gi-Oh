<?php

namespace App\Controller;

use App\Repository\CardsRepository;
use App\Repository\DeckRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
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
     * @Route("/post{id}", name="post")
     */
    public function post($id)
    {
        $deck = $this->repo->find($id)->setPosted(true);
        $this->manager->persist($deck);
        $this->manager->flush();

        return $this->redirectToRoute('consult');
    }

    /**
     * @Route("/consult", name="consult")
     */
    public function consult()
    {
        return $this->render('consult/consult.html.twig', [
            'decks' => $this->repo->findAll()
        ]);
    }

}
