<?php

namespace App\Controller;

use App\Repository\CardsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use http\Env\Response;
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
    public function manager()
    {
        $this->repo = $this->getDoctrine()->getRepository(Cards::class);
        $cards = $this->repo->findAll();

        return $this->render('manager/manager.html.twig', [
            'cards' => $cards,
            'title' => 'Card list Yu-Gi-Oh!'
        ]);
    }

    /**
     * @Route("/cards", name="manager.show")
     */
    public function show($id = 2)
    {
        $c = $this->repo->find($id);
        return $this->render('description/description.html.twig', [
            'card' => $c
        ]);
    }
}
