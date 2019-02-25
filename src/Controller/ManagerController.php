<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cards;

class ManagerController extends AbstractController
{
    /**
     * @Route("/manager", name="manager")
     */
    public function manager()
    {
        $repo = $this->getDoctrine()->getRepository(Cards::class);
        $cards = $repo->findByName();

        return $this->render('manager/manager.html.twig', [
            'cards' => $cards,
            'title' => 'Card list Yu-Gi-Oh!'
        ]);
    }
}
