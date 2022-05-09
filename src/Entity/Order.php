<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Product;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="`order`")
 * @ApiResource()
 */
class Order
{
    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    // create fields

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Product[] $mobiles ;
     * @ORM\OneToMany(targetEntity="Product", mappedBy="order")
     */
    private $mobiles;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customer_email;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    // generate getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customer_email;
    }

    public function setCustomerEmail(string $customer_email): self
    {
        $this->customer_email = $customer_email;

        return $this;
    }

    /**
     * @return Product[]
     */
    public function getMobiles(): array
    {
        return $this->mobiles;
    }

    /**
     * @param Product[] $mobiles
     */
    public function setMobiles(array $mobiles)
    {
        $this->mobiles = $mobiles;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
