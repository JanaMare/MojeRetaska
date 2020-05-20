<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductOrderRepository")
 */
class ProductOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     */
    private $priceForOne;

    /**
     * @ORM\Column(type="float")
     */
    private $priceForAll;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="productOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orders;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPriceForOne(): ?float
    {
        return $this->priceForOne;
    }

    public function setPriceForOne(float $priceForOne): self
    {
        $this->priceForOne = $priceForOne;

        return $this;
    }

    public function getPriceForAll(): ?float
    {
        return $this->priceForAll;
    }

    public function setPriceForAll(float $priceForAll): self
    {
        $this->priceForAll = $priceForAll;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): self
    {
        $this->orders = $orders;

        return $this;
    }
}
