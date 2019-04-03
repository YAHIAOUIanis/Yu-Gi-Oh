<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeckRepository")
 * @UniqueEntity("deckName")
 */
class Deck
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(min="2", minMessage="L'indentifiant doit faire au moins 2 caractères")
     */
    private $deckName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\ManyToMany(targetEntity="Cards")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     */
    private $card;

    /**
     * @ORM\Column(type="boolean")
     */
    private $posted;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="deck", orphanRemoval = true)
     */
    private $likes;

    public function __construct() {
        $this->card = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeckName(): ?string
    {
        return $this->deckName;
    }

    public function setDeckName(string $name): self
    {
        $this->deckName = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     *
     */
    public function getCardLength()
    {
        return $this->card->count();
    }

    /**
     * @param mixed $card
     */
    public function setCard($card): void
    {
        $this->card = $card;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function addCard(Cards $c): self
    {
        if(!$this->card->contains($c) && count($this->card) < 20) {
            $this->card->add($c);
        }
        return $this;
    }

    public function removeCard(Cards $c): self
    {
        if($this->card->contains($c))
        {
            $this->card->removeElement($c);
        }
        return $this;
    }

    public function getPosted(): ?bool
    {
        return $this->posted;
    }

    public function setPosted(bool $choice): self
    {
        $this->posted = $choice;
        return $this;
    }

    public function setMustReach(int $must_reach): self
    {
        $this->must_reach = $must_reach;
        return $this;
    }

    public function getMustReach(): ?int
    {
        return $this->must_reach;
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
            $like->setDeck($this);
        }

        return $this;
    }

    public function removeLike(PostLike $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getDeck() === $this) {
                $like->setDeck(null);
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @return bool|null
     * Lets you know if this deck is liked by a user
     */

    public function isLikedByUser(User $user): ?bool
    {
        foreach($this->likes as $like) {
            if($like->getUser() == $user) {
                return true;
            }
        }
        return false;
    }
}
