<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Brand;
use App\Entity\Order;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="product")
 * @ApiResource(
 *   normalizationContext={"groups" = {"product:read"}},
 *   denormalizationContext={"groups" = {"product:write"}},
 * )
 */
class Product
{

    // create fields

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"product:write", "product:read"})
     */
    private $id;

    /**
     * @var Brand $brand ;
     *
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Groups({"product:write", "product:read"})
     */
    private $brand;

    /**
     * @var Order $order ;
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="mobiles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product:write", "product:read"})
     */
    private $order;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product:write", "product:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Groups({"product:write", "product:read"})
     */
    private $price;

    // generate getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \App\Entity\Brand
     */
    public function getBrand(): \App\Entity\Brand
    {
        return $this->brand;
    }

    /**
     * @param \App\Entity\Brand $brand
     */
    public function setBrand(\App\Entity\Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return \App\Entity\Order
     */
    public function getOrder(): \App\Entity\Order
    {
        return $this->order;
    }

    /**
     * @param \App\Entity\Order $order
     */
    public function setOrder(\App\Entity\Order $order)
    {
        $this->order = $order;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Prepersist gets triggered on Insert
     * Adds up the price of the product to the amount of the order
     * @ORM\PrePersist
     */
    public function updatedAmount()
    {
        $this->order->setAmount($this->order->getAmount() + $this->price);
    }
}
