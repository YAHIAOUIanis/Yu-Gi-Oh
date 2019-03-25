<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    public function __construct() {
        $this->card = new ArrayCollection();
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
        $count = 0;
        foreach($this->card as $cardd)
        {
            if($c->getId() == $cardd->getId()){
                $count++;
                break;
            }
        }

        if($count == 0) {
            $this->card[] = $c;
        }
        return $this;
    }
}
