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
     * @Route("/deckBuilder", name="deckBuilder")
     */
    public function createDeck(Request $request, ObjectManager $manager, DeckRepository $repo)
    {
        $deck = new Deck();

        $form = $this->createFormBuilder($deck)
                     ->add('deckName')
                     ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$deck->getId()){
                $deck->setCreatedAt(new \DateTime());
            }

            $manager->persist($deck);
            $manager->flush();

        }
        dump($deck);

        return $this->render('deckBuilder/deckBuilder.html.twig', [
            'formDeckBuilder' => $form->createView()
        ]);
    }

}
