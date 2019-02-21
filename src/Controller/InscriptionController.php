<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\InscriptionType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, ObjectManager $manager)
    {
        $user = new Users();

        $form = $this->createForm(InscriptionType::class, $user)
        ->add('password', PasswordType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setAdmin(false);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('inscription/inscription.html.twig', [
            'formInscription' => $form->createView()
        ]);
    }
}
