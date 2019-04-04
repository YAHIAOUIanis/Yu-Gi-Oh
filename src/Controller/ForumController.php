<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Form\CreateTopicType;
use App\Repository\TopicRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{

    /**
     * @var TopicRepository
     */
    private $repo;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(TopicRepository $repo, ObjectManager $manager)
    {
        $this->repo = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/createTopic", name="createTopic")
     */
    public function createTopic(Request $query)
    {
        $new_topic = new Topic();

        $form = $this->createFormBuilder($new_topic)
                     ->add('Subject')
                     ->add('Title')
                     ->getForm();

        $form->handleRequest($query);

        if($form->isSubmitted() && $form->isValid())
        {
                $new_topic->setUser($this->getUser());
                $new_topic->setCreatedAt(new \DateTime());
                $new_topic->setReplies();

                $this->manager->persist($new_topic);
                $this->manager->flush();

        }

        return $this->render('createTopic/createTopic.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/forum", name="forum")
     */
    public function forum()
    {
        return $this->render('forum/forum.html.twig', [
            'topics' => $this->repo->findAll()
        ]);
    }

    /**
     * @Route("/showTopic{id}", name="showTopic")
     */
    public function showTopic($id)
    {
        $topic = $this->repo->find($id);

        return $this->render('showTopic/showTopic.html.twig', [
            'topic' => $topic
        ]);
    }

}
