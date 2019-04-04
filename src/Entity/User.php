<?php
// src/App/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="user")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Topic", mappedBy="user")
     */
    private $topics;


    public function __construct()
    {
        parent::__construct();
        $this->likes = new ArrayCollection();
        $this->topics = new ArrayCollection();
    }

    /**
     * @return Collection|PostLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(PostLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(PostLike $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }

    public function addTopic(Topic $topic): self
    {
        $this->topics[] = $topic;

        return $this;
    }

    public function removeTopic(Topic $topic): self
    {
        $this->topics->removeElement($topic);

        return $this;
    }


}