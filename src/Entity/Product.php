<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Brand;
use App\Entity\Order;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="product")
 * @ApiResource()
 */
class Product
{

    // create fields

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Brand $brand ;
     *
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     */
    private $brand;

    /**
     * @var Order $order ;
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="mobiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
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
}
