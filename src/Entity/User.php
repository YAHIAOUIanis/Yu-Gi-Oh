<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe doit correspondre")
     */
    private $confirm_password;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(min="8", minMessage="L'indentifiant doit faire 8 caractères")
     *
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Le mot de passe doit faire 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min="12", minMessage="Entrez un email correct")
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getConfirmpassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setConfirmpassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
