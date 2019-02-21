<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    private $id;

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(min = 8, max = 20)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(min = 8, max = 20)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min = 11, max = 30)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
