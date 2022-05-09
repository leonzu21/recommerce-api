<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Product;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

// SECURITY:
// @ApiResource(
// collectionOperations: [
//      "get",
//      "post" => ["security" => "is_granted('ROLE_ADMIN')"],
// ]
//)


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
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Product[] $mobiles ;
     * @ORM\OneToMany(targetEntity="Product", mappedBy="order")
     */
    private $mobiles;


    /**
     * @ORM\Column(name="customer_email", type="string", length=255)
     */
    private $customerEmail;

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
        return $this->customerEmail;
    }

    public function setCustomerEmail(string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * @return Product[]
     */
    public function getMobiles()
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

    /**
     * Prepersist gets triggered on Insert
     * Generates createdAt timestamp for order
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if ($this->created == null) {
            $this->created = new \DateTime('now');
        }
    }


    public function __toString()
    {
        return $this->customerEmail;
    }
}
