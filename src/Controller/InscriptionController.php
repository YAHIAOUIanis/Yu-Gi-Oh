<?php

namespace App\Controller;

use App\Entity\Users;
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

        //On setup un formulaire
        $form = $this->createFormBuilder($user)
            ->add('login')
            ->add('password', PasswordType::class)
            ->add('email')
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home/home.html.twig');
        }

        return $this->render('inscription/inscription.html.twig', [
            'formInscription' => $form->createView()
        ]);
    }
}
