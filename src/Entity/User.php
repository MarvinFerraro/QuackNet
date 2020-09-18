<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=180, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Regex("/^\w+/")
     */
    private $password;

    /**
     * @ORM\Column(type="string", nullable=false, length= 255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", nullable=false, length= 255)
     */

    private $firstname;

    /**
     * @ORM\Column(type="string", nullable=false, length= 255)
     */
    private $duckname;

    /**
     * @ORM\Column (type = "string", length= 255, nullable=true)
     *
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity=Quack::class, mappedBy="user")
     *
     */
    private $quacks;


    public function __construct()
    {
        $this->quacks = new ArrayCollection();
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img): void
    {
        $this->img = $img;
    }


    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(): void
    {
        $this->roles;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {

    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getDuckname()
    {
        return $this->duckname;
    }

    /**
     * @param mixed $duckname
     */
    public function setDuckname($duckname): void
    {
        $this->duckname = $duckname;
    }

    /**
     * @return Collection|Quack[]
     */
    public function getQuacks(): Collection
    {
        return $this->quacks;
    }

    public function addQuack(Quack $quack): self
    {
        if (!$this->quacks->contains($quack)) {
            $this->quacks[] = $quack;
            $quack->setUser($this);
        }

        return $this;
    }

    public function removeQuack(Quack $quack): self
    {
        if ($this->quacks->contains($quack)) {
            $this->quacks->removeElement($quack);
            // set the owning side to null (unless already changed)
            if ($quack->getUser() === $this) {
                $quack->setUser(null);
            }
        }

        return $this;
    }

}
