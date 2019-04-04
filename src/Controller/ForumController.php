<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Topic;
use App\Repository\CommentRepository;
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

    /**
     * @var CommentRepository
     */
    private $comment_repo;

    public function __construct(TopicRepository $repo, ObjectManager $manager, CommentRepository $comment_repo)
    {
        $this->repo = $repo;
        $this->manager = $manager;
        $this->comment_repo = $comment_repo;
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
            'topics' => $this->repo->findAll(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/showTopic{id}", name="showTopic")
     */
    public function showTopic($id, Request $query)
    {
        $topic = $this->repo->find($id);

        $comment = new Comment();

        $form = $this->createFormBuilder($comment)
            ->add('component')
            ->getForm();

        $form->handleRequest($query);

        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setUser($this->getUser());
            $comment->setCreatedAt(new \DateTime());

            $topic->addComment($comment);

            $this->manager->persist($comment);
            $this->manager->flush();
        }

        return $this->render('showTopic/showTopic.html.twig', [
            'topic' => $topic,
            'comments' => $topic->getComment(),
            'formComments' => $form->createView(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/deleteComment{id}", name="deleteComment")
     */
    public function deleteComment($id)
    {
        $comment = $this->comment_repo->find($id);


        $this->manager->remove($comment);
        $this->manager->flush();


        return $this->redirectToRoute('forum');

    }

    /**
     * @Route("/deleteTopic{id}", name="deleteTopic")
     */
    public function deleteTopic($id)
    {
        $topic = $this->repo->find($id);

        $this->manager->remove($topic);
        $this->manager->flush();

        return $this->redirectToRoute('forum');
    }
}
