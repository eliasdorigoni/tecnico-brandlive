<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observations;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName($value): void
    {
        $this->firstName = $value;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName($value): void
    {
        $this->lastName = $value;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail($value): void
    {
        $this->email = $value;
    }

    public function getObservations()
    {
        return $this->observations;
    }

    public function setObservations($value): void
    {
        $this->observations = $value;
    }
}