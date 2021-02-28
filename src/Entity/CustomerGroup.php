<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer_groups")
 */
class CustomerGroup
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="customer_groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $groupId;

    static $availableGroups = [
        [
            'id' => '0',
            'name' => 'Grupo A',
        ],
        [
            'id' => '1',
            'name' => 'Grupo B',
        ],
        [
            'id' => '2',
            'name' => 'Grupo C',
        ],
    ];

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function setGroupId($value)
    {
        $this->groupId = $value;
    }
}