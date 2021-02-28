<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\Table(name="customers")
 */
class Customer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\ManyToOne(targetEntity="CustomerGroup", inversedBy="customers")
     * @ORM\JoinColumn(name="id", referencedColumnName="customer_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "Este campo no puede estar vacío")
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El nombre puede tener hasta {{ limit }} caracteres"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "Este campo no puede estar vacío")
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El apellido puede tener hasta {{ limit }} caracteres"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "Este campo no puede estar vacío")
     * @Assert\Email(message = "El email '{{ value }}' no es válido.")
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El email puede tener hasta {{ limit }} caracteres"
     * )
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="CustomerGroup", mappedBy="customers")
     */
    private $groups;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      max = 2000,
     *      maxMessage = "Las observaciones pueden ser de hasta {{ limit }} caracteres"
     * )
     */
    private $observations;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName ?? '';
    }

    public function setFirstName($value): void
    {
        $this->firstName = $value;
    }

    public function getLastName(): string
    {
        return $this->lastName ?? '';
    }

    public function setLastName($value): void
    {
        $this->lastName = $value;
    }

    public function getEmail(): string
    {
        return $this->email ?? '';
    }

    public function setEmail($value): void
    {
        $this->email = $value;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function getObservations(): string
    {
        return $this->observations ?? '';
    }

    public function setObservations(string $value = null): void
    {
        $this->observations = $value;
    }
}